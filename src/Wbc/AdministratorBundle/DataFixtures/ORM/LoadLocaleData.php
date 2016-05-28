<?php

namespace Wbc\AdministratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Wbc\AdministratorBundle\Entity\Locale;

class LoadLocaleData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $esLocale = new Locale();
        $esLocale->setCode('es');
        $esLocale->setCountryCode('es');
        $esLocale->setName('Español');
        $manager->persist($esLocale);

        $manager->flush();
        $this->addReference('locale-es', $esLocale);


        $enLocale = new Locale();
        $enLocale->setCode('en');
        $enLocale->setCountryCode('us');
        $enLocale->setName('English');
        $manager->persist($enLocale);

        $manager->flush();
        $this->addReference('locale-en', $enLocale);
    }

    public function getOrder(){
        return 2;
    }
}