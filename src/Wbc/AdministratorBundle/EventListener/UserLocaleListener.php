<?php

namespace Wbc\AdministratorBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Stores the locale of the user in the session after the
 * login. This can be used by the LocaleListener afterwards.
 */
class UserLocaleListener
{
    /**
     * @var Session
     */
    private $session;
    private $em;

    public function __construct(Session $session, EntityManager $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $default_locale = 'es';
        $user = $event->getAuthenticationToken()->getUser();
        $locale = $user->getLocale() ? $user->getLocale()->getCode() : $default_locale;

        /*
         * Add Roles
         * */

        $all_roles = $user->getRoles();
        $role_name = isset($all_roles[0]) ? $all_roles[0] : 'ROLE_USER';

        $role = $this->em->getRepository('WbcAdministratorBundle:Role')
            ->findOneBy(array('name' => $role_name));

        if($role){
            $repository = $this->em->getRepository('WbcAdministratorBundle:Permission');
            $permissions = $repository->createQueryBuilder('p')
                ->innerJoin('p.role', 'r')
                ->where('r.id = :role_id')
                ->setParameter('role_id', $role->getId())
                ->getQuery()->getResult();

            foreach($permissions as $permission){
                $user->addRole($permission->getName());
            }
        }

        /*
         * Add Roles
         * */

        $this->session->set('_locale', $locale );
    }
}