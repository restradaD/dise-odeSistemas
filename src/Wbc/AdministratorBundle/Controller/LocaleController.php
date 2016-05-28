<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Locale;
use Wbc\AdministratorBundle\Form\LocaleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Locale controller.
 *
 */
class LocaleController extends Controller
{
    /**
     * Lists all Locale entities.
     * @Security("has_role('ROLE_ADMIN')")
     *
     */
    public function indexAction()
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('locale');

        $em = $this->getDoctrine()->getManager();

        $locales = $em->getRepository('WbcAdministratorBundle:Locale')->findAll();

        return $this->render('locale/index.html.twig', array(
            'locales' => $locales,
        ));
    }

    /**
     * Creates a new Locale entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('locale');

        $locale = new Locale();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\LocaleType', $locale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locale);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Locale created!'));

            return $this->redirectToRoute('locale_index');
        }

        return $this->render('locale/new.html.twig', array(
            'locale' => $locale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Locale entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Locale $locale)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('locale');
        $changes = $this->get('Services')->getLogsByEntity($locale);

        return $this->render('locale/show.html.twig', array(
            'locale' => $locale,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Locale entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Locale $locale)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $this->get('Services')->setMenuItem('locale');

        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\LocaleType', $locale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locale);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Locale updated!'));

            return $this->redirectToRoute('locale_index');
        }

        return $this->render('locale/edit.html.twig', array(
            'locale' => $locale,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Locale entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Locale $locale)
    {
        $use_translations = $this->get('Services')->get('use_translations');

        if(!$use_translations){
            throw $this->createNotFoundException('Not a valid request');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($locale);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Locale deleted!'));

        return $this->redirectToRoute('locale_index');
    }

}
