<?php

namespace Wbc\AuthBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Validator\Constraints\UrlValidator;
use Wbc\AuthBundle\Entity\OAuthClient;
use Wbc\AuthBundle\Form\OauthClientType;

/**
 * OAuthClient controller.
 *
 */
class OAuthClientController extends Controller
{
    /**
     * Lists all OAuthClient entities.
     *
     */
    public function indexAction()
    {
        $this->get('services')->setMenuItem('Client');
        $em = $this->getDoctrine()->getManager();

        $user_id = $this->get('services')->getUserId();

        $clients = $em->getRepository('WbcAuthBundle:OAuthClient')
            ->findBy(array('user' => $user_id));

        return $this->render('oauth_client/index.html.twig', array(
            'clients' => $clients,
        ));
    }

    /**
     * Creates a new OAuthClient entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('services')->setMenuItem('Client');

        $client = new OAuthClient();
        $form = $this->createForm('Wbc\AuthBundle\Form\OAuthClientType', $client);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $name  = $client->getName();
            $urls  = $client->getUrl();
            $types = $client->getTypes();

            $separated_urls = explode(',', $urls);
            $validURLs = array();
            $invalidURLs = array();

            foreach($separated_urls as $url){
                if($this->get('services')->validateURL($url)){
                    $validURLs[] = $url;
                }else{
                    $invalidURLs[] = $url;
                }
            }

            $em->remove($client);

            $user = $this->get('services')->getUser();

            $clientManager = $this->get('fos_oauth_server.client_manager.default');
            $client = $clientManager->createClient();
            $client->setRedirectUris($validURLs);
            $client->setAllowedGrantTypes($types);
            $client->setName($name);
            $client->setUser($user);

            $clientManager->updateClient($client);

            $em->persist($client);
            $em->flush();

            $this->get('services')->addFlash('success', $this->get('translator')->trans('OAuth Client created!'));

            return $this->redirectToRoute('oauth_client_index');
        }

        return $this->render('oauth_client/new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     */
    public function editAction(Request $request, OAuthClient $client)
    {
        $client_user_id = $client->getUser()->getId();
        $actual_user_id = $this->get('services')->getUserId();

        if($client_user_id != $actual_user_id){
            //deny all
            throw $this->createAccessDeniedException('Access Denied to this App');
        }

        $this->get('Services')->setMenuItem('Client');

        $allowedTypes = $client->getAllowedGrantTypes();
        $client->setTypes($allowedTypes);

        $validURLsCommaSeparated = $client->getRedirectUris();
        $validURLs = implode(',', $validURLsCommaSeparated);
        $client->setUrl($validURLs);

        $editForm = $this->createForm('Wbc\AuthBundle\Form\OAuthClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $name  = $client->getName();
            $user  = $client->getUser();
            $urls  = $client->getUrl();
            $types = $client->getTypes();

            $separated_urls = explode(',', $urls);
            $validURLs = array();
            $invalidURLs = array();

            foreach($separated_urls as $url){
                if($this->get('services')->validateURL($url)){
                    $validURLs[] = $url;
                }else{
                    $invalidURLs[] = $url;
                }
            }

            $clientManager = $this->get('fos_oauth_server.client_manager.default');
            $client->setRedirectUris($validURLs);
            $client->setAllowedGrantTypes($types);
            $client->setName($name);
            $client->setUser($user);

            $clientManager->updateClient($client);

            $em->persist($client);
            $em->flush();


            $this->get('Services')->addFlash('success', $this->get('translator')->trans('OAuth Client updated!'));

            return $this->redirectToRoute('oauth_client_index');
        }

        return $this->render('oauth_client/edit.html.twig', array(
            'client' => $client,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a OAuthClient entity.
     *
     */
    public function deleteAction(Request $request, OAuth $client)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();

        $this->get('services')->setFlash('danger', $this->get('translator')->trans('OAuth Client deleted!'));

        return $this->redirectToRoute('client_index');
    }

}
