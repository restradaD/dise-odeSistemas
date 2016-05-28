<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Settings;
use Wbc\AdministratorBundle\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Settings controller.
 *
 */
class SettingsController extends Controller
{
    /**
     * Lists all Settings entities.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('settings');
        $em = $this->getDoctrine()->getManager();

        $settings = $em->getRepository('WbcAdministratorBundle:Settings')->findAll();

        return $this->render('settings/index.html.twig', array(
            'settings' => $settings,
        ));
    }

    /**
     * Creates a new Settings entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('settings');

        $setting = new Settings();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\SettingsType', $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($setting);

            if($setting->getActive()){
                $all = $em->getRepository('WbcAdministratorBundle:Settings')
                    ->findAll();

                foreach($all as $each){
                    $each->setActive(false);
                }

                $setting->setActive(true);
            }

            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Settings created!'));

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('settings/new.html.twig', array(
            'setting' => $setting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Settings entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Settings $setting)
    {
        $this->get('Services')->setMenuItem('settings');
        $changes = $this->get('Services')->getLogsByEntity($setting);

        return $this->render('settings/show.html.twig', array(
            'setting' => $setting,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Settings entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Settings $setting)
    {
        $this->get('Services')->setMenuItem('settings');

        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\SettingsType', $setting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($setting);

            if($setting->getActive()){
                $all = $em->getRepository('WbcAdministratorBundle:Settings')
                    ->findAll();

                foreach($all as $each){
                    $each->setActive(false);
                }

                $setting->setActive(true);
            }

            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Settings updated!'));

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('settings/edit.html.twig', array(
            'setting' => $setting,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Settings entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Settings $setting)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($setting);
        $em->flush();

        $oneActive = $em->getRepository('WbcAdministratorBundle:Settings')
            ->findOneBy(array('active' => true));

        if(!$oneActive){
            $first = $em->getRepository('WbcAdministratorBundle:Settings')
                ->findOneBy(array('active' => false));

            if($first){
                $first->setActive(true);
                $em->flush();
            }else{
                $this->get('Services')->setFlash('danger', 'PLEASE, Create at least one Setting');
            }
        }

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Settings deleted!'));

        return $this->redirectToRoute('settings_index');
    }

}
