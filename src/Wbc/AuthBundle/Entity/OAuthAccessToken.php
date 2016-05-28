<?php
// src/Acme/ApiBundle/Entity/AccessToken.php

namespace Wbc\AuthBundle\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_access_token")
 */
class OAuthAccessToken extends BaseAccessToken
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
        return 'AccessToken';
    }
}
