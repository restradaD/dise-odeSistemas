<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wbc\AdministratorBundle\Entity\Empleado;
use Wbc\AdministratorBundle\Form\EmpleadoType;
use Wbc\AdministratorBundle\Model\EncargadoRH;
use Wbc\AdministratorBundle\Model\Gerente;

/**
 * Empleado controller.
 *
 */
class EmpleadoController extends Controller {

    /**
     * Lists all Empleado entities.
     *
     */
    public function indexAction() {
        $this->get('Services')->setMenuItem('Empleado');
        $em = $this->getDoctrine()->getManager();
        $gerente = new Gerente($em);

        $empleados = $gerente->generarReportePlanilla();

        return $this->render('empleado/index.html.twig', array(
                    'empleados' => $empleados,
        ));
    }

    /**
     * Creates a new Empleado entity.
     *
     */
    public function newAction(Request $request) {
        $this->get('Services')->setMenuItem('Empleado');

        $empleado = new Empleado();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\EmpleadoType', $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $now = new \DateTime('now');
            $empleado->setFechaCreacion($now);

            $em = $this->getDoctrine()->getManager();
            $em->persist($empleado);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Empleado created!'));

            return $this->redirectToRoute('empleado_index');
        }

        return $this->render('empleado/new.html.twig', array(
                    'empleado' => $empleado,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Empleado entity.
     *
     */
    public function showAction(Empleado $empleado) {

        $this->get('Services')->setMenuItem('Empleado');
        $changes = $this->get('Services')->getLogsByEntity($empleado);

        return $this->render('empleado/show.html.twig', array(
                    'empleado' => $empleado,
                    'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Empleado entity.
     *
     */
    public function editAction(Request $request, Empleado $empleado) {
        $this->get('Services')->setMenuItem('Empleado');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\EmpleadoType', $empleado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $encargadoRH = new EncargadoRH($em);
            $encargadoRH->administrarEmpleados($empleado); //flush edit empleado

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Empleado updated!'));

            return $this->redirectToRoute('empleado_index');
        }

        return $this->render('empleado/edit.html.twig', array(
                    'empleado' => $empleado,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a Empleado entity.
     *
     */
    public function deleteAction(Request $request, Empleado $empleado) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($empleado);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Empleado deleted!'));

        return $this->redirectToRoute('empleado_index');
    }

}
