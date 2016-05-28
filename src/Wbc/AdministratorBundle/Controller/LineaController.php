<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Linea;
use Wbc\AdministratorBundle\Form\LineaType;

/**
 * Linea controller.
 *
 */
class LineaController extends Controller
{
    /**
     * Lists all Linea entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Linea');
        $em = $this->getDoctrine()->getManager();

        $lineas = $em->getRepository('WbcAdministratorBundle:Linea')->findAll();

        return $this->render('linea/index.html.twig', array(
            'lineas' => $lineas,
        ));
    }

    /**
     * Creates a new Linea entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Linea');

        $linea = new Linea();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\LineaType', $linea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($linea);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Linea created!'));

            return $this->redirectToRoute('linea_index');
        }

        return $this->render('linea/new.html.twig', array(
            'linea' => $linea,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Linea entity.
     *
     */
    public function showAction(Linea $linea)
    {

        $this->get('Services')->setMenuItem('Linea');
        $changes = $this->get('Services')->getLogsByEntity($linea);

        return $this->render('linea/show.html.twig', array(
            'linea' => $linea,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Linea entity.
     *
     */
    public function editAction(Request $request, Linea $linea)
    {
        $this->get('Services')->setMenuItem('Linea');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\LineaType', $linea);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($linea);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Linea updated!'));

            return $this->redirectToRoute('linea_index');
        }

        return $this->render('linea/edit.html.twig', array(
            'linea' => $linea,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Linea entity.
     *
     */
    public function deleteAction(Request $request, Linea $linea)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($linea);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Linea deleted!'));

        return $this->redirectToRoute('linea_index');
    }

}
