<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\LineaProducto;
use Wbc\AdministratorBundle\Form\LineaProductoType;

/**
 * LineaProducto controller.
 *
 */
class LineaProductoController extends Controller
{
    /**
     * Lists all LineaProducto entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('LineaProducto');
        $em = $this->getDoctrine()->getManager();

        $lineaProductos = $em->getRepository('WbcAdministratorBundle:LineaProducto')->findAll();

        return $this->render('lineaproducto/index.html.twig', array(
            'lineaProductos' => $lineaProductos,
        ));
    }

    /**
     * Creates a new LineaProducto entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('LineaProducto');

        $lineaProducto = new LineaProducto();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\LineaProductoType', $lineaProducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $now = new \DateTime('now');
            $lineaProducto->setCreacion($now);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($lineaProducto);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('LineaProducto created!'));

            return $this->redirectToRoute('lineaproducto_index');
        }

        return $this->render('lineaproducto/new.html.twig', array(
            'lineaProducto' => $lineaProducto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a LineaProducto entity.
     *
     */
    public function showAction(LineaProducto $lineaProducto)
    {

        $this->get('Services')->setMenuItem('LineaProducto');
        $changes = $this->get('Services')->getLogsByEntity($lineaProducto);

        return $this->render('lineaproducto/show.html.twig', array(
            'lineaProducto' => $lineaProducto,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing LineaProducto entity.
     *
     */
    public function editAction(Request $request, LineaProducto $lineaProducto)
    {
        $this->get('Services')->setMenuItem('LineaProducto');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\LineaProductoType', $lineaProducto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lineaProducto);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('LineaProducto updated!'));

            return $this->redirectToRoute('lineaproducto_index');
        }

        return $this->render('lineaproducto/edit.html.twig', array(
            'lineaProducto' => $lineaProducto,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a LineaProducto entity.
     *
     */
    public function deleteAction(Request $request, LineaProducto $lineaProducto)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($lineaProducto);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('LineaProducto deleted!'));

        return $this->redirectToRoute('lineaproducto_index');
    }

}
