<?php
/**
 * Created by PhpStorm.
 * User: Rodmar Zavala
 * Date: 28/02/16
 * Time: 7:52 PM
 */

namespace Wbc\AdministratorBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Lexik\Bundle\TranslationBundle\Entity\File;
use Lexik\Bundle\TranslationBundle\Entity\Translation;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Wbc\AdministratorBundle\Entity\Currency;
use Wbc\AdministratorBundle\Entity\Log;
use Wbc\AdministratorBundle\Entity\LogChanges;
use Wbc\AdministratorBundle\Entity\User;


class ChangesListener
{
    protected $container;
    public $action;
    public $verb;

    public function __construct($container){
        $this->container = $container;
        $this->action    = '';
        $this->verb      = '';
    }

    private function processUnitOfWork(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if(!$em){
            return;
        }

        if(!$entity instanceof Log){
            if(!$entity instanceof LogChanges){

                if(!$entity instanceof TransUnit){
                    if(!$entity instanceof File){
                        if(!$entity instanceof Translation){
                            if(!$entity instanceof Currency){
                               $uow = $em->getUnitOfWork();
                                $uow->computeChangeSets(); // do not compute changes if inside a listener
                                $changeSet = $uow->getEntityChangeSet($entity);

                                $user    = $this->container->get('Services')->getUser();
                                $user_id = $this->container->get('Services')->getUserId();
                                $now     = new \DateTime();

                                $text = "";

                                if($user_id){
                                    $text = $this->container->get('translator')->trans('%name% has been '. $this->verb .' by %user%', array(
                                        '%user%' => $user,
                                        '%name%' => $entity
                                    ));
                                }else{
                                    $text = $this->container->get('translator')->trans('%name% has been '. $this->verb .'!', array(
                                        '%name%' => $entity
                                    ));
                                }

                                $entity_id = null;
                                if(is_callable([$entity, 'getId'])){
                                    $entity_id = $entity->getId();
                                }

                                $entity_name = get_class($entity);
                                $user = is_object($user) ? $user : NULL;

                                $log = new Log();
                                $log->setAction($this->action);
                                $log->setUser($user);
                                $log->setText($text);
                                $log->setEntity($entity_name);
                                $log->setEntityId($entity_id);
                                $log->setCreatedAt($now);
                                $log->setUpdatedAt($now);
                                $log->setCreatedBy($user_id);
                                $log->setUpdatedBy($user_id);

                                $em->persist($log);
                                $em->flush($log);

                                $invalidFields = array('usernameCanonical', 'emailCanonical', 'salt', 'createdAt', 'updatedAt', 'lastLogin');

                                foreach($changeSet as $field => $versions){
                                    if(!in_array($field, $invalidFields)){
                                        $before = $versions[0];
                                        $after  = $versions[1];

                                        if($field == 'password'){
                                            $before = '*******';
                                            $after  = '*******';
                                        }


                                        if(is_array($before)){
                                            $before = serialize($before);
                                        }

                                        if(is_array($after)){
                                            $after = serialize($after);
                                        }

                                        if(is_object($before)){
                                            if($before instanceof \DateTime){
                                                $before = $before->format('Y-m-d H:i');
                                            }else if(!(String) $before){
                                                $before = '[Object]';
                                            }
                                        }

                                        if(is_object($after)){
                                            if($after instanceof \DateTime){
                                                $after = $after->format('Y-m-d H:i');
                                            }elseif(!(String) $after){
                                                $after = '[Object]';
                                            }
                                        }

                                        $changes = new LogChanges();
                                        $changes->setLog($log);
                                        $changes->setName($field);
                                        $changes->setOld($before);
                                        $changes->setNew($after);

                                        $em->persist($changes);
                                        $em->flush($changes);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        // only act on some "User" entity
        if ($entity instanceof User) {

            return;
        }
    }

    public function postUpdate(LifecycleEventArgs $args){
        $this->action = 'update';
        $this->verb   = 'updated';
        self::processUnitOfWork($args);
    }

    public function preUpdate(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        $user_id = $this->container->get('Services')->getUserId();

        if(is_callable([$entity, 'setUpdatedAt'])){
            $entity->setUpdatedAt(new \DateTime());
        }

        if(is_callable([$entity, 'setUpdatedBy'])){
            $entity->setUpdatedBy($user_id);
        }
    }

    public function postPersist(LifecycleEventArgs $args){
        $this->action = 'create';
        $this->verb   = 'created';
        self::processUnitOfWork($args);
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        $user_id = $this->container->get('Services')->getUserId();

        if(is_callable([$entity, 'setCreatedAt'])){
            $entity->setCreatedAt(new \DateTime());
        }

        if(is_callable([$entity, 'setCreatedBy'])){
            $entity->setCreatedBy($user_id);
        }
    }

    public function postRemove(LifecycleEventArgs $args){
        $this->action = 'delete';
        $this->verb   = 'deleted';
        self::processUnitOfWork($args);
    }
}