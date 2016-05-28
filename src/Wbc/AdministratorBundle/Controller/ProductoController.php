<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Producto;
use Wbc\AdministratorBundle\Form\ProductoType;

/**
 * Producto controller.
 *
 */
class ProductoController extends Controller
{
    /**
     * Lists all Producto entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Producto');
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('WbcAdministratorBundle:Producto')->findAll();

        return $this->render('producto/index.html.twig', array(
            'productos' => $productos,
        ));
    }

    /**
     * Creates a new Producto entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Producto');

        $producto = new Producto();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\ProductoType', $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             
            $now = new \DateTime('now');
            $producto->setFechaCreacion($now);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Producto created!'));

            return $this->redirectToRoute('producto_index');
        }

        return $this->render('producto/new.html.twig', array(
            'producto' => $producto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Producto entity.
     *
     */
    public function showAction(Producto $producto)
    {

        $this->get('Services')->setMenuItem('Producto');
        $changes = $this->get('Services')->getLogsByEntity($producto);

        return $this->render('producto/show.html.twig', array(
            'producto' => $producto,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     */
    public function editAction(Request $request, Producto $producto)
    {
        $this->get('Services')->setMenuItem('Producto');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\ProductoType', $producto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Producto updated!'));

            return $this->redirectToRoute('producto_index');
        }

        return $this->render('producto/edit.html.twig', array(
            'producto' => $producto,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Producto entity.
     *
     */
    public function deleteAction(Request $request, Producto $producto)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($producto);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Producto deleted!'));

        return $this->redirectToRoute('producto_index');
    }

}
