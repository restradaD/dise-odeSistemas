<?php

namespace Wbc\AdministratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Wbc\AdministratorBundle\Entity\Role;

class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $manager->persist($userRole);
        $manager->flush();

        $userRole = new Role();
        $userRole->setName('ROLE_ADMIN');
        $manager->persist($userRole);
        $manager->flush();
    }

    public function getOrder(){
        return 5;
    }
}