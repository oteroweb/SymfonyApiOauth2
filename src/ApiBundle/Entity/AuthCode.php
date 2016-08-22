<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;

/**
 * AuthCode
 *
 * @ORM\Table(name="auth_code")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AuthCodeRepository")
 */
class AuthCode extends BaseAuthCode 
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
     * @ORM\JoinColumn(referencedColumnName="memberId")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Members")
    */
    protected $user;
}

