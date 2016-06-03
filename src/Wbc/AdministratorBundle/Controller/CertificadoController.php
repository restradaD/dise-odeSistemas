<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Certificado;
use Wbc\AdministratorBundle\Form\CertificadoType;
use Wbc\AdministratorBundle\Model\Factura;

/**
 * Certificado controller.
 *
 */
class CertificadoController extends Controller
{
    /**
     * Lists all Certificado entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Certificado');
        $em = $this->getDoctrine()->getManager();

        $certificados = $em->getRepository('WbcAdministratorBundle:Certificado')->findAll();

        return $this->render('certificado/index.html.twig', array(
            'certificados' => $certificados,
        ));
    }

    /**
     * Creates a new Certificado entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Certificado');

        $certificado = new Certificado();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\CertificadoType', $certificado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $factura = new Factura($em); 
            $factura->generarCertificado($certificado); //flush certificado
            

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Certificado created!'));

            return $this->redirectToRoute('certificado_index');
        }

        return $this->render('certificado/new.html.twig', array(
            'certificado' => $certificado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Certificado entity.
     *
     */
    public function showAction(Certificado $certificado)
    {

        $this->get('Services')->setMenuItem('Certificado');
        $changes = $this->get('Services')->getLogsByEntity($certificado);

        return $this->render('certificado/show.html.twig', array(
            'certificado' => $certificado,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Certificado entity.
     *
     */
    public function editAction(Request $request, Certificado $certificado)
    {
        $this->get('Services')->setMenuItem('Certificado');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\CertificadoType', $certificado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $producto = new \Wbc\AdministratorBundle\Model\Producto($em);
            $producto->administrarCertificado($certificado); // flush certificado  

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Certificado updated!'));

            return $this->redirectToRoute('certificado_index');
        }

        return $this->render('certificado/edit.html.twig', array(
            'certificado' => $certificado,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Certificado entity.
     *
     */
    public function deleteAction(Request $request, Certificado $certificado)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($certificado);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Certificado deleted!'));

        return $this->redirectToRoute('certificado_index');
    }

}
