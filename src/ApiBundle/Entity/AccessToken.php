<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

/**
 * AccessToken
 *
 * @ORM\Table(name="access_token")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AccessTokenRepository")
 */
class AccessToken extends BaseAccessToken
{
/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Members")
     * @ORM\JoinColumn(referencedColumnName="memberId")
     */
    protected $user;
}

