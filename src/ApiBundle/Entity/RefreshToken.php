<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;

/**
 * RefreshToken
 *
 * @ORM\Table(name="refresh_token")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\RefreshTokenRepository")
 */
class RefreshToken extends BaseRefreshToken
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
// \
