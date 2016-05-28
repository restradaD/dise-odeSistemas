<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Role;
use Wbc\AdministratorBundle\Form\RoleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Role controller.
 *
 */
class RoleController extends Controller
{
    /**
     * Lists all Role entities.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Role');
        $em = $this->getDoctrine()->getManager();

        $roles = $em->getRepository('WbcAdministratorBundle:Role')->findAll();

        return $this->render('role/index.html.twig', array(
            'roles' => $roles,
        ));
    }

    /**
     * Creates a new Role entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Role');

        $role = new Role();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\RoleType', $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Role created!'));

            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/new.html.twig', array(
            'role' => $role,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Role entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Role $role)
    {

        $this->get('Services')->setMenuItem('Role');
        $changes = $this->get('Services')->getLogsByEntity($role);

        return $this->render('role/show.html.twig', array(
            'role' => $role,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Role entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Role $role)
    {
        $this->get('Services')->setMenuItem('Role');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\RoleType', $role);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Role updated!'));

            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/edit.html.twig', array(
            'role' => $role,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Role entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Role $role)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($role);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Role deleted!'));

        return $this->redirectToRoute('role_index');
    }

}
