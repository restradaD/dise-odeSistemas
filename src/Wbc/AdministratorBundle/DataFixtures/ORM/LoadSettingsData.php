<?php

namespace Wbc\AdministratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Wbc\AdministratorBundle\Entity\Settings;

class LoadSettingsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $setting = new Settings();
        $setting->setActive(true);
        $setting->setName('Dev Env');
        $setting->setUrl('http://base.local/app_dev.php');
        $setting->setDescription('Base Theme');
        $setting->setOgTitle('Base Theme');
        $setting->setOgDescription('Base Theme');
        $setting->setCopyright('&copy; Rodmar Zavala');
        $setting->setIsProduction(false);
        $setting->setMainApi('http://base.local/api');
        $setting->setUseEmail(true);
        $setting->setUseTwilio(false);
        $setting->setUseTwilioVoice(false);
        $setting->setAdminEmail('rodmar.zavala@gmail.com');
        $setting->setHtmlRobots('nofollow,noindex');

        $manager->persist($setting);

        $manager->flush();
    }

    public function getOrder(){
        return 4;
    }
}