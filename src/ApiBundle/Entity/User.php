<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * User
 *
 * @ORM\Table(name="members")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
       /**
     * @var int
     *
     * @ORM\Column(name="member_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $member_id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_birth", type="date")
     */
    private $dateOfBirth;


    /**
     * Get id
     *
     * @return int
     */
    public function getMember_id()
    {
        return $this->Member_id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return string
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Member
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return Member
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
}

