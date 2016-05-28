<?php

namespace Wbc\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function localeAction(Request $request){
        $locale = $request->get('locale');

        if($locale){
            $session = new Session();
            $session->set('_locale', $locale);
        }

        $dashboard_url = $this->generateUrl('wbc_administrator_homepage');

        $url = $request->headers->get('referer') ? $request->headers->get('referer') : $dashboard_url;
        return $this->redirect($url);
    }

    public function notificationsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('Services')->getUser();
        $opts = array();
        $format = $request->get('_format', 'html');

        if($format == 'html'){
            $opts['all'] = $em->getRepository('WbcAdministratorBundle:Notification')
                ->findBy(array( 'to' => $user->getId() ));

            $opts['unchecked'] = $em->getRepository('WbcAdministratorBundle:Notification')
                ->findBy(array( 'to' => $user->getId(), 'checked' => false ));


            return $this->render('WbcThemeBundle:Partials:Widgets/navigator/notifications-part.html.twig', $opts);
        }

        if($format == 'json'){
            //seen but not checked
            $nots = $em->getRepository('WbcAdministratorBundle:Notification')
                ->findBy(array( 'to' => $user->getId() ));

            $opts['all'] = count($nots);


            //not checked
            $nots = $em->getRepository('WbcAdministratorBundle:Notification')
                ->findBy(array( 'to' => $user->getId(), 'checked' => false ));

            $opts['unchecked'] = count($nots);

            return new JsonResponse($opts);
        }

    }

    public function langAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $locale = $session->get('_locale');
        $default_locale = 'es';

        $opts = array();
        $opts['langs'] = $em->getRepository('WbcAdministratorBundle:Locale')
            ->findAll();

        $opts['locale'] = $em->getRepository('WbcAdministratorBundle:Locale')->findOneByCode($locale);

        if(!$opts['locale']){
            $opts['locale'] = $em->getRepository('WbcAdministratorBundle:Locale')
                ->findOneByCode($default_locale);
        }

        return $this->render('WbcThemeBundle:Partials/Widgets/security:lang.html.twig', $opts);
    }
}
