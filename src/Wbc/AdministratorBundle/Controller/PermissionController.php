<?php

namespace Wbc\AdministratorBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\Permission;
use Wbc\AdministratorBundle\Form\PermissionType;

/**
 * Permission controller.
 *
 */
class PermissionController extends Controller
{
    /**
     * Lists all Permission entities.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('Permission');
        $em = $this->getDoctrine()->getManager();

        $permissions = $em->getRepository('WbcAdministratorBundle:Permission')->findAll();

        return $this->render('permission/index.html.twig', array(
            'permissions' => $permissions,
        ));
    }

    /**
     * Creates a new Permission entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('Permission');

        $permission = new Permission();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\PermissionType', $permission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($permission);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Permission created!'));

            return $this->redirectToRoute('permission_index');
        }

        return $this->render('permission/new.html.twig', array(
            'permission' => $permission,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Permission entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Permission $permission)
    {

        $this->get('Services')->setMenuItem('Permission');
        $changes = $this->get('Services')->getLogsByEntity($permission);

        return $this->render('permission/show.html.twig', array(
            'permission' => $permission,
            'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Permission entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Permission $permission)
    {
        $this->get('Services')->setMenuItem('Permission');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\PermissionType', $permission);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($permission);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Permission updated!'));

            return $this->redirectToRoute('permission_index');
        }

        return $this->render('permission/edit.html.twig', array(
            'permission' => $permission,
            'form'        => $editForm->createView()
        ));
    }

    /**
     * Deletes a Permission entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Permission $permission)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($permission);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Permission deleted!'));

        return $this->redirectToRoute('permission_index');
    }

}
