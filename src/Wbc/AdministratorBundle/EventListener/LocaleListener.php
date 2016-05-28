<?php

namespace Wbc\AdministratorBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;
    private $container;

    public function __construct($defaultLocale = 'en', $container)
    {
        $this->defaultLocale = $defaultLocale;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        $em = $this->container->get('doctrine')->getManager();

        $locales = $em->createQuery('SELECT l FROM WbcAdministratorBundle:Locale l')
            ->useResultCache(true, 8600, 'LocaleCacheGetAll')
            ->getResult();

        $availableLocalesInSystem = array();
        foreach($locales as $key => $l){
            $availableLocalesInSystem[$key] = $l->getCode();
        }

        $defaultLocale = $request->getPreferredLanguage($availableLocalesInSystem);
        $defaultLocale = $defaultLocale ? $defaultLocale : $this->defaultLocale;

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}