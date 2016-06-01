<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\PagoEmpleado;
use Wbc\AdministratorBundle\Form\PagoEmpleadoType;

/**
 * PagoEmpleado controller.
 *
 */
class PagoEmpleadoController extends Controller
{
    /**
     * Lists all PagoEmpleado entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('PagoEmpleado');
        $em = $this->getDoctrine()->getManager();

        $pagoEmpleados = $em->getRepository('WbcAdministratorBundle:PagoEmpleado')->findAll();

        return $this->render('pagoempleado/index.html.twig', array(
            'pagoEmpleados' => $pagoEmpleados,
        ));
    }

    /**
     * Creates a new PagoEmpleado entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('PagoEmpleado');

        $pagoEmpleado = new PagoEmpleado();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\PagoEmpleadoType', $pagoEmpleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            
            $now = new \DateTime('now');
            $pagoEmpleado->setCreacion($now);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagoEmpleado);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('PagoEmpleado created!'));

            return $this->redirectToRoute('pagoempleado_index');
        }

        return $this->render('pagoempleado/new.html.twig', array(
            'pagoEmpleado' => $pagoEmpleado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PagoEmpleado entity.
     *
     */
    public function showAction(PagoEmpleado $pagoEmpleado)
    {

        $this->get('Services')->setMenuItem('PagoEmpleado');
        $changes = $this->get('Services')->getLogsByEntity($pagoEmpleado);

        return $this->render('pagoempleado/show.html.twig', array(
            'pagoEmpleado' => $pagoEmpleado,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing PagoEmpleado entity.
     *
     */
    public function editAction(Request $request, PagoEmpleado $pagoEmpleado)
    {
        $this->get('Services')->setMenuItem('PagoEmpleado');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\PagoEmpleadoType', $pagoEmpleado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagoEmpleado);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('PagoEmpleado updated!'));

            return $this->redirectToRoute('pagoempleado_index');
        }

        return $this->render('pagoempleado/edit.html.twig', array(
            'pagoEmpleado' => $pagoEmpleado,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a PagoEmpleado entity.
     *
     */
    public function deleteAction(Request $request, PagoEmpleado $pagoEmpleado)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pagoEmpleado);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('PagoEmpleado deleted!'));

        return $this->redirectToRoute('pagoempleado_index');
    }

}
