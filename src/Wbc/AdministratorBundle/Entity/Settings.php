<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Settings
 */
class Settings
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $html_robots;

    /**
     * @var string
     */
    private $og_title;

    /**
     * @var string
     */
    private $og_description;

    /**
     * @var string
     */
    private $og_image_url;

    /**
     * @var string
     */
    private $og_url;

    /**
     * @var string
     */
    private $api_url;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $facebook_url;

    /**
     * @var string
     */
    private $twitter_url;

    /**
     * @var string
     */
    private $youtube_url;

    /**
     * @var string
     */
    private $instagram_url;

    /**
     * @var string
     */
    private $facebook_app_id;

    /**
     * @var string
     */
    private $analytics_script;

    /**
     * @var string
     */
    private $copyright;

    /**
     * @var boolean
     */
    private $is_production;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Settings
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Settings
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Settings
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Settings
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set htmlRobots
     *
     * @param string $htmlRobots
     *
     * @return Settings
     */
    public function setHtmlRobots($htmlRobots)
    {
        $this->html_robots = $htmlRobots;

        return $this;
    }

    /**
     * Get htmlRobots
     *
     * @return string
     */
    public function getHtmlRobots()
    {
        return $this->html_robots;
    }

    /**
     * Set ogTitle
     *
     * @param string $ogTitle
     *
     * @return Settings
     */
    public function setOgTitle($ogTitle)
    {
        $this->og_title = $ogTitle;

        return $this;
    }

    /**
     * Get ogTitle
     *
     * @return string
     */
    public function getOgTitle()
    {
        return $this->og_title;
    }

    /**
     * Set ogDescription
     *
     * @param string $ogDescription
     *
     * @return Settings
     */
    public function setOgDescription($ogDescription)
    {
        $this->og_description = $ogDescription;

        return $this;
    }

    /**
     * Get ogDescription
     *
     * @return string
     */
    public function getOgDescription()
    {
        return $this->og_description;
    }

    /**
     * Set ogImageUrl
     *
     * @param string $ogImageUrl
     *
     * @return Settings
     */
    public function setOgImageUrl($ogImageUrl)
    {
        $this->og_image_url = $ogImageUrl;

        return $this;
    }

    /**
     * Get ogImageUrl
     *
     * @return string
     */
    public function getOgImageUrl()
    {
        return $this->og_image_url;
    }

    /**
     * Set ogUrl
     *
     * @param string $ogUrl
     *
     * @return Settings
     */
    public function setOgUrl($ogUrl)
    {
        $this->og_url = $ogUrl;

        return $this;
    }

    /**
     * Get ogUrl
     *
     * @return string
     */
    public function getOgUrl()
    {
        return $this->og_url;
    }

    /**
     * Set apiUrl
     *
     * @param string $apiUrl
     *
     * @return Settings
     */
    public function setApiUrl($apiUrl)
    {
        $this->api_url = $apiUrl;

        return $this;
    }

    /**
     * Get apiUrl
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Settings
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set facebookUrl
     *
     * @param string $facebookUrl
     *
     * @return Settings
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebook_url = $facebookUrl;

        return $this;
    }

    /**
     * Get facebookUrl
     *
     * @return string
     */
    public function getFacebookUrl()
    {
        return $this->facebook_url;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     *
     * @return Settings
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitter_url = $twitterUrl;

        return $this;
    }

    /**
     * Get twitterUrl
     *
     * @return string
     */
    public function getTwitterUrl()
    {
        return $this->twitter_url;
    }

    /**
     * Set youtubeUrl
     *
     * @param string $youtubeUrl
     *
     * @return Settings
     */
    public function setYoutubeUrl($youtubeUrl)
    {
        $this->youtube_url = $youtubeUrl;

        return $this;
    }

    /**
     * Get youtubeUrl
     *
     * @return string
     */
    public function getYoutubeUrl()
    {
        return $this->youtube_url;
    }

    /**
     * Set instagramUrl
     *
     * @param string $instagramUrl
     *
     * @return Settings
     */
    public function setInstagramUrl($instagramUrl)
    {
        $this->instagram_url = $instagramUrl;

        return $this;
    }

    /**
     * Get instagramUrl
     *
     * @return string
     */
    public function getInstagramUrl()
    {
        return $this->instagram_url;
    }

    /**
     * Set facebookAppId
     *
     * @param string $facebookAppId
     *
     * @return Settings
     */
    public function setFacebookAppId($facebookAppId)
    {
        $this->facebook_app_id = $facebookAppId;

        return $this;
    }

    /**
     * Get facebookAppId
     *
     * @return string
     */
    public function getFacebookAppId()
    {
        return $this->facebook_app_id;
    }

    /**
     * Set analyticsScript
     *
     * @param string $analyticsScript
     *
     * @return Settings
     */
    public function setAnalyticsScript($analyticsScript)
    {
        $this->analytics_script = $analyticsScript;

        return $this;
    }

    /**
     * Get analyticsScript
     *
     * @return string
     */
    public function getAnalyticsScript()
    {
        return $this->analytics_script;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     *
     * @return Settings
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set isProduction
     *
     * @param boolean $isProduction
     *
     * @return Settings
     */
    public function setIsProduction($isProduction)
    {
        $this->is_production = $isProduction;

        return $this;
    }

    /**
     * Get isProduction
     *
     * @return boolean
     */
    public function getIsProduction()
    {
        return $this->is_production;
    }
    /**
     * @var string
     */
    private $main_api;

    /**
     * @var boolean
     */
    private $use_twilio;

    /**
     * @var boolean
     */
    private $use_twilio_voice;

    /**
     * @var string
     */
    private $twilio_number;

    /**
     * @var string
     */
    private $twilio_sid;

    /**
     * @var string
     */
    private $twilio_token;

    /**
     * @var boolean
     */
    private $use_email;

    /**
     * @var string
     */
    private $admin_email;

    /**
     * @var string
     */
    private $faye_server_url;


    /**
     * Set mainApi
     *
     * @param string $mainApi
     *
     * @return Settings
     */
    public function setMainApi($mainApi)
    {
        $this->main_api = $mainApi;

        return $this;
    }

    /**
     * Get mainApi
     *
     * @return string
     */
    public function getMainApi()
    {
        return $this->main_api;
    }

    /**
     * Set useTwilio
     *
     * @param boolean $useTwilio
     *
     * @return Settings
     */
    public function setUseTwilio($useTwilio)
    {
        $this->use_twilio = $useTwilio;

        return $this;
    }

    /**
     * Get useTwilio
     *
     * @return boolean
     */
    public function getUseTwilio()
    {
        return $this->use_twilio;
    }

    /**
     * Set useTwilioVoice
     *
     * @param boolean $useTwilioVoice
     *
     * @return Settings
     */
    public function setUseTwilioVoice($useTwilioVoice)
    {
        $this->use_twilio_voice = $useTwilioVoice;

        return $this;
    }

    /**
     * Get useTwilioVoice
     *
     * @return boolean
     */
    public function getUseTwilioVoice()
    {
        return $this->use_twilio_voice;
    }

    /**
     * Set twilioNumber
     *
     * @param string $twilioNumber
     *
     * @return Settings
     */
    public function setTwilioNumber($twilioNumber)
    {
        $this->twilio_number = $twilioNumber;

        return $this;
    }

    /**
     * Get twilioNumber
     *
     * @return string
     */
    public function getTwilioNumber()
    {
        return $this->twilio_number;
    }

    /**
     * Set twilioSid
     *
     * @param string $twilioSid
     *
     * @return Settings
     */
    public function setTwilioSid($twilioSid)
    {
        $this->twilio_sid = $twilioSid;

        return $this;
    }

    /**
     * Get twilioSid
     *
     * @return string
     */
    public function getTwilioSid()
    {
        return $this->twilio_sid;
    }

    /**
     * Set twilioToken
     *
     * @param string $twilioToken
     *
     * @return Settings
     */
    public function setTwilioToken($twilioToken)
    {
        $this->twilio_token = $twilioToken;

        return $this;
    }

    /**
     * Get twilioToken
     *
     * @return string
     */
    public function getTwilioToken()
    {
        return $this->twilio_token;
    }

    /**
     * Set useEmail
     *
     * @param boolean $useEmail
     *
     * @return Settings
     */
    public function setUseEmail($useEmail)
    {
        $this->use_email = $useEmail;

        return $this;
    }

    /**
     * Get useEmail
     *
     * @return boolean
     */
    public function getUseEmail()
    {
        return $this->use_email;
    }

    /**
     * Set adminEmail
     *
     * @param string $adminEmail
     *
     * @return Settings
     */
    public function setAdminEmail($adminEmail)
    {
        $this->admin_email = $adminEmail;

        return $this;
    }

    /**
     * Get adminEmail
     *
     * @return string
     */
    public function getAdminEmail()
    {
        return $this->admin_email;
    }

    /**
     * Set fayeServerUrl
     *
     * @param string $fayeServerUrl
     *
     * @return Settings
     */
    public function setFayeServerUrl($fayeServerUrl)
    {
        $this->faye_server_url = $fayeServerUrl;

        return $this;
    }

    /**
     * Get fayeServerUrl
     *
     * @return string
     */
    public function getFayeServerUrl()
    {
        return $this->faye_server_url;
    }

    public function __toString()
    {
        return $this->name;
    }
    /**
     * @var boolean
     */
    private $use_translations;


    /**
     * Set useTranslations
     *
     * @param boolean $useTranslations
     *
     * @return Settings
     */
    public function setUseTranslations($useTranslations)
    {
        $this->use_translations = $useTranslations;

        return $this;
    }

    /**
     * Get useTranslations
     *
     * @return boolean
     */
    public function getUseTranslations()
    {
        return $this->use_translations;
    }
}
