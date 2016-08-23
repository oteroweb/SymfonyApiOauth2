<?php

namespace ApiBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ClientRepository")
 */
class Client extends BaseClient
{
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

   public function __construct(EntityManager $em)
    {
        parent::__construct();
          $this->request = Request::createFromGlobals();
        $this->post = $this->request->request->all();
        $this->em = $em;
    } 
}

