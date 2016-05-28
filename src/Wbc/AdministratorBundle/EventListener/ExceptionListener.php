<?php
/**
 * Created by PhpStorm.
 * User: rodmar
 * Date: 28/01/16
 * Time: 6:44 PM
 */

namespace Wbc\AdministratorBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    private $container;

    function __construct($container) {
        $this->container = $container;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();

        $statusCode = 404;

        try{
            $statusCode = $exception->getStatusCode() ? $exception->getStatusCode() : 404;
        }catch(\Exception $e){
            //trow exception
        }

        $response = $this->container->get('templating')->renderResponse('WbcThemeBundle::error.html.twig', array('e' => $exception));

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($statusCode);
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Send the modified response object to the event
        $event->setResponse($response);
    }
}