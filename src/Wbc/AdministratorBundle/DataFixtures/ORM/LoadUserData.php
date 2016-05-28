<?php


namespace Wbc\AdministratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Wbc\AdministratorBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
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
        $user->setUsername('admin');
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