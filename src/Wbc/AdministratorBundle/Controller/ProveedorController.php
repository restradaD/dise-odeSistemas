<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Proveedor;
use Wbc\AdministratorBundle\Form\ProveedorType;

/**
 * Proveedor controller.
 *
 */
class ProveedorController extends Controller
{
    /**
     * Lists all Proveedor entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Proveedor');
        $em = $this->getDoctrine()->getManager();

        $proveedors = $em->getRepository('WbcAdministratorBundle:Proveedor')->findAll();

        return $this->render('proveedor/index.html.twig', array(
            'proveedors' => $proveedors,
        ));
    }

    /**
     * Creates a new Proveedor entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Proveedor');

        $proveedor = new Proveedor();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\ProveedorType', $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $now = new \DateTime('now');
            $proveedor->setFechaCreacion($now);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Proveedor created!'));

            return $this->redirectToRoute('proveedor_index');
        }

        return $this->render('proveedor/new.html.twig', array(
            'proveedor' => $proveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proveedor entity.
     *
     */
    public function showAction(Proveedor $proveedor)
    {

        $this->get('Services')->setMenuItem('Proveedor');
        $changes = $this->get('Services')->getLogsByEntity($proveedor);

        return $this->render('proveedor/show.html.twig', array(
            'proveedor' => $proveedor,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Proveedor entity.
     *
     */
    public function editAction(Request $request, Proveedor $proveedor)
    {
        $this->get('Services')->setMenuItem('Proveedor');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\ProveedorType', $proveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Proveedor updated!'));

            return $this->redirectToRoute('proveedor_index');
        }

        return $this->render('proveedor/edit.html.twig', array(
            'proveedor' => $proveedor,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Proveedor entity.
     *
     */
    public function deleteAction(Request $request, Proveedor $proveedor)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($proveedor);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Proveedor deleted!'));

        return $this->redirectToRoute('proveedor_index');
    }

}
