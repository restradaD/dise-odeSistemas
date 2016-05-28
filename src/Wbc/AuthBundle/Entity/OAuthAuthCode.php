<?php
// src/Acme/ApiBundle/Entity/AuthCode.php

namespace Wbc\AuthBundle\Entity;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_auth_code")
 */
class OAuthAuthCode extends BaseAuthCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Wbc\AuthBundle\Entity\OAuthClient")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="Wbc\AdministratorBundle\Entity\User")
     */
    protected $user;

    public function __toString()
    {
        return 'AuthCode';
    }
}
