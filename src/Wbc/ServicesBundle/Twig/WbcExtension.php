<?php

namespace Wbc\ServicesBundle\Twig;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Wbc\AdministratorBundle\Custom\GoogleUrlApi;

class WbcExtension extends \Twig_Extension {

    protected $em, $container;

    public function __construct($em, $container) {
        $this->em = $em;
        $this->container = $container;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('user', array($this, 'user')),
            new \Twig_SimpleFilter('version', array($this, 'version')),
            new \Twig_SimpleFilter('md5', array($this, 'wbc_md5')),
            new \Twig_SimpleFilter('list', array($this, 'wbc_list')),
            new \Twig_SimpleFilter('shortURL', array($this, 'shortURL')),
        );
    }

    public function getFunctions() {
        return array(
            'fayeClient' => new \Twig_Function_Method($this, 'fayeClient'),
            'confirmLeaving' => new \Twig_Function_Method($this, 'confirmLeaving'),
            'in_array' => new \Twig_Function_Method($this, 'wbc_in_array'),
            'api' => new \Twig_Function_Method($this, 'api'),
            'get' => new \Twig_Function_Method($this, 'get'),
            'is_ajax' => new \Twig_Function_Method($this, 'is_ajax'),
            'getMenuItem' => new \Twig_Function_Method($this, 'getMenuItem'),
            'i18nResource' => new \Twig_Function_Method($this, 'i18nResource'),
        );
    }

    public function shortURL($url){
        $login = $this->get('bitly_login', 'rodmarzavala');
        $appKey = $this->get('bitly_app_key', 'R_a667c6edd3c34e4e82f9305904b4117c');
        return $this->container->get('Services')->makeBitlyURL($url, $login, $appKey,'json');
    }

    public function wbc_list($list = array()){
        $result = substr(implode(", ", $list), 0);
        return $result;
    }

    public function i18nResource($resourceSlug){
        $session = new Session();
        $locale = $session->get('_locale', 'es');
        $em = $this->em;

        $locale = $em->getRepository('WbcAdministratorBundle:Locale')
            ->findOneBy(array('code' => $locale));

        if($locale){
            $criteria = array('locale' => $locale->getId(), 'slug' => $resourceSlug);
            $resource = $em->getRepository('WbcAdministratorBundle:I18NResource')
                ->findOneBy($criteria);

            if($resource){
                return $resource->getContent();
            }
        }

        return false;
    }

    public function getMenuItem($default = "", $itemName = "MainAdministratorMenuItem"){
        return $this->container->get('Services')->getMenuItem($default, $itemName);
    }

    public function is_ajax(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;
    }

    public function get($index, $default = ''){
        return $this->container->get('Services')->get($index, $default);;
    }

    public function api($action = '/', $opts = array()){
        $url = $this->container->get('Services')->getMainAPIURL() . $action;
        $env = $this->container->getParameter("kernel.environment");

        if($env == 'dev'){
            $url = str_replace('/api', '/app_dev.php/api', $url);
        }

        foreach ($opts as $key => $value) {
            $url = str_replace(':'.$key, $value, $url);
        }

        return $url;
    }

    public function wbc_md5($input){
        return md5($input);
    }

    public function version($old){
        if(!$old ){ return '1.1'; }

        $numbers = explode('.', $old);
        $total   = count($numbers);

        if($total >= 2){
            $last_version_number = end($numbers);
            $last_index = count($numbers)-1;

            if(!is_numeric($last_version_number)){
                $numbers[$last_index] = 1;
            }else{
                $numbers[$last_index] = $last_version_number +1;
            }
        }else{
            return $old . '.1';
        }

        return implode('.', $numbers);
    }

    public function wbc_in_array($needle, $haystack, $strict=false){
        return in_array($needle, $haystack, $strict);
    }

    public function confirmLeaving($customMessage = 'Are you sure you want leave?') {
        $customMessage = $this->container->get('translator')->trans($customMessage);
        $opts['customMessage'] = $customMessage;
        return $this->container->get('templating')->render('WbcCRMBundle:Tools:confirmLeaving.html.twig', $opts);
    }

    public function fayeClient(){
        return $this->container->get('Services')->get('faye_server_url');
    }

    public function user($id = false){
        if(!$id){
            return 'N/A';
        }else{
            $user = $this->em->getRepository('WbcAdministratorBundle:User')
                ->find($id);

            if($user){
                $url = $this->container->get('router')->generate('user_show', array('id' => $user->getId(), 'changes' => false));
                return '<a data-target="#infoModal" data-toggle="modal" class="modal-info" data-remote="false" href="'. $url .'">'. $user .'</a>';
            }else{
                return '---';
            }
        }
    }

    public function getName() {
        return 'wbc_extension';
    }

}
