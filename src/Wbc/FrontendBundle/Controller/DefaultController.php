<?php

namespace Wbc\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WbcFrontendBundle:Default:index.html.twig');
    }

    public function grandCentralAction(){

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $route = 'wbc_administrator_homepage';
        }else{
            $route = 'wbc_frontend_homepage';
        }



        return $this->redirectToRoute($route);
    }
}
