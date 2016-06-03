<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Beneficio;
use Wbc\AdministratorBundle\Form\BeneficioType;
use Wbc\AdministratorBundle\Model\EncargadoRH;

/**
 * Beneficio controller.
 *
 */
class BeneficioController extends Controller
{
    /**
     * Lists all Beneficio entities.
     *
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Beneficio');
        $em = $this->getDoctrine()->getManager();

        $beneficios = $em->getRepository('WbcAdministratorBundle:Beneficio')->findAll();

        return $this->render('beneficio/index.html.twig', array(
            'beneficios' => $beneficios,
        ));
    }

    /**
     * Creates a new Beneficio entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Beneficio');

        $beneficio = new Beneficio();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\BeneficioType', $beneficio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $encargadoRH = new EncargadoRH($em);
            $encargadoRH->administrarPrestaciones($beneficio); //flush new beneficio 

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Beneficio created!'));

            return $this->redirectToRoute('beneficio_index');
        }

        return $this->render('beneficio/new.html.twig', array(
            'beneficio' => $beneficio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Beneficio entity.
     *
     */
    public function showAction(Beneficio $beneficio)
    {

        $this->get('Services')->setMenuItem('Beneficio');
        $changes = $this->get('Services')->getLogsByEntity($beneficio);

        return $this->render('beneficio/show.html.twig', array(
            'beneficio' => $beneficio,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Beneficio entity.
     *
     */
    public function editAction(Request $request, Beneficio $beneficio)
    {
        $this->get('Services')->setMenuItem('Beneficio');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\BeneficioType', $beneficio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($beneficio);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Beneficio updated!'));

            return $this->redirectToRoute('beneficio_index');
        }

        return $this->render('beneficio/edit.html.twig', array(
            'beneficio' => $beneficio,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Beneficio entity.
     *
     */
    public function deleteAction(Request $request, Beneficio $beneficio)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($beneficio);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Beneficio deleted!'));

        return $this->redirectToRoute('beneficio_index');
    }

}
