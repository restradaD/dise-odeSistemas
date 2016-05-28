<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wbc\AdministratorBundle\Entity\I18NResource;
use Wbc\AdministratorBundle\Form\I18NResourceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * I18NResource controller.
 *
 */
class I18NResourceController extends Controller
{
    /**
     * Lists all I18NResource entities.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('I18NResource');
        $em = $this->getDoctrine()->getManager();

        $i18NResources = $em->getRepository('WbcAdministratorBundle:I18NResource')->findAll();

        return $this->render('i18nresource/index.html.twig', array(
            'i18NResources' => $i18NResources,
        ));
    }

    /**
     * Creates a new I18NResource entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $locale = $request->getLocale();
        $this->get('Services')->setMenuItem('I18NResource');

        $i18NResource = new I18NResource();
        $i18NResource->setType('text');

        $em = $this->getDoctrine()->getManager();
        $localeFromDB = $em->getRepository('WbcAdministratorBundle:Locale')
            ->findOneBy(array('code' => $locale));

        if($localeFromDB){
            $i18NResource->setLocale($localeFromDB);
        }

        $form = $this->createForm('Wbc\AdministratorBundle\Form\I18NResourceType', $i18NResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($i18NResource);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('I18NResource created!'));

            return $this->redirectToRoute('i18nresource_index');
        }

        return $this->render('i18nresource/new.html.twig', array(
            'i18NResource' => $i18NResource,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a I18NResource entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(I18NResource $i18NResource)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('I18NResource');
        $changes = $this->get('Services')->getLogsByEntity($i18NResource);

        return $this->render('i18nresource/show.html.twig', array(
            'i18NResource' => $i18NResource,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing I18NResource entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, I18NResource $i18NResource)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('I18NResource');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\I18NResourceType', $i18NResource);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($i18NResource);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('I18NResource updated!'));

            return $this->redirectToRoute('i18nresource_index');
        }

        return $this->render('i18nresource/edit.html.twig', array(
            'i18NResource' => $i18NResource,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a I18NResource entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, I18NResource $i18NResource)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($i18NResource);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('I18NResource deleted!'));

        return $this->redirectToRoute('i18nresource_index');
    }

}
