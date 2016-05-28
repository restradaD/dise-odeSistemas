<?php

namespace Wbc\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function clientAction()
    {
        return $this->render('WbcAuthBundle:Default:index.html.twig');
    }
}
