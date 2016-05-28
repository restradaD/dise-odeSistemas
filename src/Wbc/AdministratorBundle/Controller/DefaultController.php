<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->get('Services')->setMenuItem('dashboard');
        return $this->render('WbcAdministratorBundle:Default:index.html.twig');
    }

    public function cacheClearAction(){
        $env = $this->get('Kernel')->getEnvironment();
        $this->get('Services')->clearCacheByEnv($env);
        return $this->redirectToRoute('wbc_administrator_homepage');
    }

    public function searchAction(Request $request){
        $this->get('Services')->setMenuItem('search');
        return $this->render('WbcAdministratorBundle:Default:search.html.twig');
    }

    public function goAction(Request $request){
        $code = $request->get('code', false);
        $user_id = $this->get('Services')->getUserId();

        if($code){
            $em = $this->getDoctrine()->getManager();

            $notification = $em->createQuery(
                'SELECT n FROM WbcAdministratorBundle:Notification n '
                . ' WHERE MD5(n.id) = :code')
                ->setParameters(array(
                    'code'     => $code,
                ))
                ->setMaxResults(1)
                ->getOneOrNullResult();

            if($notification){
                $prefix = ($this->get('kernel')->getEnvironment() =='dev') ? '/app_dev.php' : '' ;
                $go = $prefix . $notification->getAction();

                /* clear notification */
                $notification->setSeen(1);
                $notification->setChecked(1);
                $notification->setUpdatedAt(new \DateTime());
                $notification->setUpdatedBy($user_id);

                $em->flush();

            }else{
                $text = $this->get('translator')->trans('That notification was invalid.');
                $this->get('Services')->setFlash('danger', $text);
                $go = $this->generateUrl('wbc_administrator_homepage');
            }

            return $this->redirect($go);

        }else{
            $text = $this->get('translator')->trans('The link is invalid!');
            $this->get('Services')->setFlash('danger', $text);
            return $this->redirectToRoute('wbc_administrator_homepage');
        }
    }

}
