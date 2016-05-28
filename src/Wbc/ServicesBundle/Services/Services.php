<?php

namespace Wbc\ServicesBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class Services extends Controller {
    private $em;
    protected $container;

    public function __construct(EntityManager $entityManager, $container) {
        $this->em = $entityManager;
        $this->container = $container;
    }

    function makeBitlyURL($url,$login,$appkey,$format = 'xml',$version = '2.0.1'){
        //create the URL
        $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;

        //get the url
        //could also use cURL here
        $response = file_get_contents($bitly);

        //parse depending on desired format
        if(strtolower($format) == 'json')
        {
            $json = @json_decode($response,true);
            return $json['results'][$url]['shortUrl'];
        }
        else //xml
        {
            $xml = simplexml_load_string($response);
            return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
        }
    }


    public function validateURL($url){
        if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
            return true;
        } else {
            return false;
        }
    }

    public function getLogsByEntity($entity, $limit = 50, $offset = 0){
        if(!$entity){
            return [];
        }

        $cache = self::getCacheSettings('logs');
        $entity_name = get_class($entity);
        $entity_id   = $entity->getId();

        $parameters = ['entity' => $entity_name, 'entity_id' => $entity_id];

        $allLogs = $this->em->createQuery(
            'SELECT l FROM WbcAdministratorBundle:Log l WHERE l.entity = :entity AND l.entity_id = :entity_id ORDER BY l.created_at DESC')
            ->setParameters($parameters)
            ->useResultCache($cache['active'], $cache['ttl'], $cache['key'])
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getResult();

        return $allLogs;
    }

    public function getResponseTime($url = 'http://google.com.gt'){
	    $time = round(microtime(true) * 1000) -21600000;
	    $responseTime = self::pingDomain($url);
        return new JsonResponse(array('time' => $time, 'responseTime' => $responseTime));
	}

    public function pingDomain($domain){
        $domain = $domain . '?source=watcher';
        $start = round(microtime(true) * 1000);
        $content = @file_get_contents($domain);
        $end = round(microtime(true) * 1000);

        return ($end - $start);
    }

    public function clearCacheByEnv($env){
        $pwd = realpath(getcwd() . '/../');

        if($pwd){
            exec("php $pwd/bin/console cache:clear --env=$env > /dev/null 2>/dev/null &");
            $this->container->get('Services')->setFlash('success', $this->container->get('translator')->trans('Clearing <strong>%env%</strong> cache...', array('%env%' => $env)));
        }else{
            $this->container->get('Services')->setFlash('danger', $this->container->get('translator')->trans('Error while clearing cache...'));
        }
    }

    public function slugify($text){
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    public function getSignedRequestContent($url, $method = 'GET', $data = array()){
        $user = 'user';
        $password = '1234567890';
        $auth = base64_encode( $user . ':' . $password );

        $options = array(
            'http' => array(
                'header'  => "Authorization: Basic $auth\r\n",
                'method'  => $method,
            ),
        );

        if( count($data) > 0 ){
            $options['http']['content'] = http_build_query($data);
        }

        $context  = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);

        return $result;
    }

    public function getClientIp (){
        $realclientip = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : isset($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) ? $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"] : $_SERVER["REMOTE_ADDR"];
        return $realclientip;
    }

    public function cacheClear($key = ''){
        $cacheDriver = $this->em->getConfiguration()->getResultCacheImpl();
        $result  = $cacheDriver->delete($key);

        if (!$result) {
            return false;
        }

        return $cacheDriver->flushAll();
    }

    public function appendToLogFile($text, $file = 'log.txt'){
        $filename = getcwd() . '/web/' . $file;
        @file_put_contents($filename, $text.PHP_EOL.PHP_EOL , FILE_APPEND);
    }

    public function createAllThumbs($path, $syncWithAkamai = true) {
        $result = array();
        $cwd = getcwd();

        if (strpos($cwd,'/web') === false) {
            $cwd = $cwd . '/web';
        }

        if (is_array($path)) {
            foreach ($path as $imagePath) {
                if($imagePath){
                    if (is_file($cwd . $imagePath)) {
                        $result = $this->processImage($imagePath);
                    }
                }
            }
        } else {
            if($path){
                if (is_file($cwd . $path)) {
                    $result = $this->processImage($path);
                }
            }
        }

        $sanitizedImages = array();
        foreach($result as $imgLocalPath){
            $goodPath = str_replace('http://localhost', $cwd, $imgLocalPath);
            $sanitizedImages[] = $goodPath;
        }

        //self::syncWithAkamai();

        return $result;
    }

    public function processImage($imagePath) {
        $request = Request::createFromGlobals();
        $conf = $this->container->getParameter('liip_imagine.filter_sets');
        $sizes = array();
        $sync = array();

        foreach ($conf as $filter => $size) {
            $sizes[] = $this->container->get('liip_imagine.controller')->filterAction($request, $imagePath, $filter);
            $cacheManager = $this->container->get('liip_imagine.cache.manager');

            $result = $cacheManager->getBrowserPath($imagePath, $filter);
            $sync[] = $result;
        }

        return $sync;
    }

    public function get($setting, $default = '') {
        $em = $this->em;

        $cache = self::getCacheSettings('settings');

        $settings = $em->createQuery(
            'SELECT s FROM WbcAdministratorBundle:Settings s WHERE s.active = :active')
            ->setParameter('active', true)
            ->useResultCache($cache['active'], $cache['ttl'], $cache['key'])
            ->setMaxResults(1)
            ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return (isset($settings[$setting]) && !empty($settings[$setting])) ? $settings[$setting] : $default;
    }

    public function log($text, $user, $action = 'none'){
        $log = new \Wbc\AdministratorBundle\Entity\Log();
        $log->setAction($action);
        $log->setUser($user);
        $log->setText($text);
        $log->setCreatedAt(new \DateTime());
        $log->setUpdatedAt(new \DateTime());
        $log->setCreatedBy($user->getId());
        $log->setUpdatedBy($user->getId());

        $this->em->persist($log);
        $this->em->flush();
    }

    public function notification($title, $message, $action, $type, $userFrom, $userTo){
        $em = $this->em;

        $user_id = self::getUserId();

        $notification = new \Wbc\AdministratorBundle\Entity\Notification();
        $notification->setTitle($title);
        $notification->setMessage($message);
        $notification->setType($type);
        $notification->setAction($action);
        $notification->setCreatedBy($user_id);
        $notification->setUpdatedBy($user_id);
        $notification->setCreatedAt(new \DateTime());
        $notification->setUpdatedAt(new \DateTime());
        $notification->setFrom($userFrom);
        $notification->setTo($userTo);

        $em->persist($notification);
        $em->flush();
    }

    public function notify($notification, $template = ''){
        $response = array();

        $title = $notification->getTitle();
        $message = $notification->getMessage();
        $type = $notification->getType();
        $action = $notification->getAction();
        $to = $notification->getTo();

        if($to){
            if($to->isEnabled()){
                $opts = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => $type,
                    'action' => $action,
                    'to' => $to,
                );

                $faye_server_url             = self::get('faye_server_url', false);
                $allow_notification_by_email = self::get('use_email', false);
                $allow_notification_by_sms   = self::get('use_twilio', false);
                $allow_notification_by_voice = self::get('use_twilio_voice', false);

                $toEmail  = $to->getEmail();
                $toPhoneNumber = $to->getPhone(false);

                if($allow_notification_by_email && $toEmail){
                    $send = self::pushEmail($title, $toEmail, $opts);

                    $response['email'] = array('code' => 200, 'message' => 'Email sent', 'to' => $toEmail);
                }

                if($allow_notification_by_sms && $toPhoneNumber){
                    $sid = self::pushTwilio($toPhoneNumber, $message);
                    $response['twilio'] = array('code' => 200, 'message' => 'SMS sent', '_id' => $sid);
                }

                if($allow_notification_by_voice && $toPhoneNumber){
                    //[TODO]: get to user lang for customize this...
                    $sid = self::pushTwilioVoice($toPhoneNumber, $message);
                    $response['twilio_voice'] = array('code' => 200, 'message' => 'Phonecall sent', '_id' => $sid);
                }

                if($faye_server_url){
                    $token = $to->getSecretToken();

                    if($token){
                        $data = array(
                            'title' => $title,
                            'message' => $message,
                            'action' => $action,
                            //[TODO]: fire event on postpersist/postupdate
                            //'id' => $notification->getId(),
                            'id' => md5($action),
                            //[TODO]: change icon by notification type.
                            'icon' => 'http://www.wingsacrossamerica.us/wasp/interact/Forward.png'
                        );

                        $channel = '/'.$token . '/' . $type;
                        self::pushFaye($channel, $data);
                        $response['faye'] = array('code' => 200, 'message' => 'Notification sent', 'channel' => $type, 'action' => $action);
                    }else{
                        $response['faye'] = array('code' => 404, 'message' => 'User without secret token cannot receive Faye notifications.');
                    }
                }


                /*
                dump($response);
                exit;
                */


                return $response;
            }else{
                $response = array('code' => 404, 'message' => 'User '. (String)$to .' is not active!');
            }
        }else{
            $response = array('code' => 404, 'message' => 'Not a valid user was given!');
        }

        return $response;
    }

    public function pushEmail($title, $toEmail, $opts = array()){
        $fromEmail = self::get('admin_email');
        $templating = $this->container->get('templating');

        $message = \Swift_Message::newInstance()
            ->setSubject($title)
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody(
                $templating->render(
                    'WbcCRMBundle:Email:SourceAdmin/notification.html.twig',
                    $opts
                ),
                'text/html'
            )
            ->addPart(
                $templating->render(
                    'WbcCRMBundle:Email:SourceAdmin/notification.txt.twig',
                    $opts
                ),
                'text/plain'
            );

        $this->container->get('mailer')->send($message);

        return true;
    }

    public function pushTwilioVoice($toPhoneNumber, $message, $lang = '', $voice = ''){
        $twilioNumber = self::get('twilio_number');
        $twilio_sid = self::get('twilio_sid');
        $twilio_token = self::get('twilio_token');

        $twilio = $this->container->get('twilio.api');
        $customTwilioInstance = $twilio->createInstance($twilio_sid, $twilio_token);

        $TWiMLPath = $this->container->get('router')->generate('twiml_path', array('phone' => $toPhoneNumber, 'message' => $message, 'lang' => $lang, 'voice' => $voice), true);
        //echo $TWiMLPath; exit;

        $call = $customTwilioInstance->account->calls->create(
            $twilioNumber,
            $toPhoneNumber,
            $TWiMLPath
        //'http://columbus.pragadev.com/response.xml'
        );

        return $call;
    }

    public function getTwiML($toPhoneNumber, $message='', $lang = '', $voice = ''){
        if($lang == ''){
            $lang = 'es-MX';
        }

        if($voice == ''){
            $voice = 'alice';
        }

        $twilioNumber = self::get('twilio_number');
        $string = '<?xml version="1.0" encoding="UTF-8"?><Response><Dial callerId="'. $twilioNumber .'">'. $toPhoneNumber .'</Dial><Say voice="'. $voice .'" language="'. $lang .'">'. $message .'</Say></Response>';
        return $string;
    }

    public function pushTwilio($toPhoneNumber, $message = ''){
        $twilioNumber = self::get('twilio_number');
        $twilio_sid = self::get('twilio_sid');
        $twilio_token = self::get('twilio_token');

        $twilio = $this->container->get('twilio.api');
        $customTwilioInstance = $twilio->createInstance($twilio_sid, $twilio_token);

        $message = $customTwilioInstance->account->messages->sendMessage(
            $twilioNumber, // From a Twilio number in your account
            $toPhoneNumber, // Text any number
            $message
        );

        return $message->sid;
    }

    public function checkTwilioSMS($sid){
        $twilioNumber = self::get('twilio_number');
        $twilio_sid = self::get('twilio_sid');
        $twilio_token = self::get('twilio_token');

        $twilio = $this->container->get('twilio.api');
        $customTwilioInstance = $twilio->createInstance($twilio_sid, $twilio_token);

        $message = $customTwilioInstance->account->messages->get($sid);

        return $message;
    }

    public function getCacheSettings($key){
        $prefix = self::getCachePrefix();

        $default_ttl = 300;
        $default_key = $key;
        $default_active = true;

        $cacheSettings = self::getCacheSettingsArray();

        return isset($cacheSettings[$key]) ? $cacheSettings[$key] : array('active' => $default_active, 'ttl' => $default_ttl, 'key' => $prefix . $default_key);
    }

    public function getCacheSettingsArray(){
        $prefix = self::getCachePrefix();

        $settings = array(
            'settings' => array(
                'active' => true,
                'ttl' => 21600,
                'key' => $prefix . '_settings'
            ),
            'companies' => array(
                'active' => true,
                'ttl' => 300,
                'key' => $prefix . '_companies'
            ),
        );

        return $settings;
    }

    public function getCachePrefix(){
        return 'simple_crm';
    }

    public function setMenuItem($value, $itemName="MainAdministratorMenuItem"){
        $session = new Session();
        $session->set($itemName, $value);
    }

    public function getMenuItem($default = "", $itemName = "MainAdministratorMenuItem"){
        $session = new Session();
        return $session->get($itemName, $default);
    }

    public function pushFaye($channel, array $data){
        $fayeServer = self::get('faye_server_url');

        $token = "958eca670492eb7808d708aff555e479";
        $opts  = array("token" => $token);

        $adapter = new \Nc\FayeClient\Adapter\CurlAdapter();
        $client = new \Nc\FayeClient\Client($adapter, $fayeServer);
        $client->send($channel, $data, $opts);
    }

    public function getUser(){
        return $this->container->get('security.token_storage')->getToken() ? $this->container->get('security.token_storage')->getToken()->getUser() : NULL;
    }

    public function getUserId(){
        if($this->container->get('security.token_storage')->getToken()){
            if($this->container->get('security.token_storage')->getToken()->getUser() !="anon."){
                return $this->container->get('security.token_storage')->getToken()->getUser()->getId();
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function setFlash($type = 'success', $text = ''){
        $session = new Session();
        $session->getFlashBag()->add($type, $text);
    }

    public function getRandomCode($length = 8, $entity = 'User', $min = false){

        if($min){
            $chars = "_ABCDEFGHIJKLMNO-PQRSTUVWX_Yab_cdefghijklmnnopqrs-tu-vwxyz011234567_89";
        }else{
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXY023456789";
        }

        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;

        while ($i <= $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        if($entity == 'User'){
            $code_field = 'secret_token';
        }else{
            $code_field = 'code';
        }

        $doesCodeExistsBefore = $this->em->getRepository('WbcAdministratorBundle:' . $entity)
            ->findOneBy(array($code_field => $pass));

        if($doesCodeExistsBefore){
            $pass = $this->getRandomCode($length);
        }

        return $pass;
    }
}