<?php
namespace Wbc\AdministratorBundle\EventListener;


use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Wbc\AdministratorBundle\Controller\DefaultController;

class RequestAndResponseListener
{
    protected $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        //dump($event);
    }


    public function onKernelController(FilterControllerEvent $event){
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if($controller[0] instanceof DefaultController){
            if($controller[1] == 'indexAction'){
                $event->getRequest()->attributes->set('set_cache_10', true);
            }
        }

        //dump($controller);
    }

    public function onKernelResponse(FilterResponseEvent $event){
        //dump($response);
        $logger = $this->container->get('logger');

        // check to see if onKernelController marked this as a token "auth'ed" request
        if ($key = $event->getRequest()->attributes->get('set_cache_10')) {
            $response = $event->getResponse();

            $logger->info('Set Max Age to 10');

            $response->setPublic();
            $response->setMaxAge(10);
            return;
        }
    }


    public function onKernelView(GetResponseForControllerResultEvent $event){
        $val = $event->getControllerResult();
        //dump($val);
    }
}