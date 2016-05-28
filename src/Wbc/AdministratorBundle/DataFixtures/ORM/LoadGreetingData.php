<?php

namespace Wbc\AdministratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Wbc\AdministratorBundle\Entity\Greeting;

class LoadGreetingData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $greetings = array(
            array( 'name' => 'mr', 'es' => 'Señor', 'en' => 'Mr.' ),
            array( 'name' => 'miss', 'es' => 'Señorita', 'en' => 'Miss' ),
        );

        foreach($greetings as $g){
            $greeting = new Greeting();
            $greeting->setName($g['name']);
            $greeting->setNameEn($g['en']);
            $greeting->setNameEs($g['es']);

            $manager->persist($greeting);

            $manager->flush();
            $this->addReference('greeting-'.$g['name'], $greeting);
        }
    }

    public function getOrder(){
        return 1;
    }
}