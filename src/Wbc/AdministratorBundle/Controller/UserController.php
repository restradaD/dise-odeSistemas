<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wbc\AdministratorBundle\Entity\User;
use Wbc\AdministratorBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('user');

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('WbcAdministratorBundle:User')->findAll();

        return $this->render('WbcAdministratorBundle:User:index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new User entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $this->get('Services')->setMenuItem('user');

        $user = new User();

        $user->setEnabled(true);
        $previous_password = $user->getPassword();

        $form = $this->createForm('Wbc\AdministratorBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form['password']->getData();

            if($plainPassword != $previous_password){
                $userManager = $this->container->get('fos_user.user_manager');
                $user->setPlainPassword($plainPassword);
                $userManager->updatePassword($user);
            }

            $em = $this->getDoctrine()->getManager();
            $user->setPlainPassword($user->getPlainPassword());

            /*
             * ROLE Management
             * */

            $roles_array = array();

            if($user->getRole()){
                $roles_array[] = $user->getRole()->getName();
                $user->setRoles($roles_array);
            }


            /*
             * ROLE Management
             * */

            $em->persist($user);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('User created!'));

            return $this->redirectToRoute('user_index');
        }

        return $this->render('WbcAdministratorBundle:User:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(User $user)
    {
        $this->get('Services')->setMenuItem('user');
        $request = Request::createFromGlobals();
        $showChanges = $request->get('changes', true);

        $deleteForm = $this->createDeleteForm($user);

        $changes = $this->get('Services')->getLogsByEntity($user);

        return $this->render('WbcAdministratorBundle:User:show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
            'changes' => $changes,
            'showChanges' => $showChanges
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, User $user)
    {
        $this->get('Services')->setMenuItem('user');

        $previous_password = $user->getPassword();
        $user->setPassword(null);

        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        $plainPassword = trim($editForm['password']->getData());

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if(($plainPassword != $previous_password) && strlen($plainPassword) > 0){
                $userManager = $this->container->get('fos_user.user_manager');
                $user->setPlainPassword($plainPassword);
                $userManager->updatePassword($user);
            }else{
                $user->setPassword($previous_password);
            }

            /*
             * ROLE Management
             * */

            $roles_array = array();

            if($user->getRole()){
                $roles_array[] = $user->getRole()->getName();
                $user->setRoles($roles_array);
            }


            /*
             * ROLE Management
             * */

            $em->persist($user);
            $em->flush();

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('User updated!'));

            return $this->redirectToRoute('user_index');
        }

        return $this->render('WbcAdministratorBundle:User:edit.html.twig', array(
            'user' => $user,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $this->get('Services')->setFlash('danger', $this->get('translator')->trans('User deleted!'));
        //}

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
