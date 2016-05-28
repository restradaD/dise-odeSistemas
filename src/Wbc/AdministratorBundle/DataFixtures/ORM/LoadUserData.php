<?php


namespace Wbc\AdministratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture; 
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Wbc\AdministratorBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        //admin
        $user = new User();
        $user->setUsername('admin2');
        $user->setEmail('admin@admin');
        $user->setEnabled(true);
        $user->setFirstName('Usuario');
        $user->setLastName('Administrador');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setLocale($this->getReference('locale-es'));

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'password');
        $user->setPassword($password);
        $user->setGreeting($this->getReference('greeting-mr'));
        $user->setTimezone($this->getReference('timezone-default'));

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder(){
        return 3;
    }
}