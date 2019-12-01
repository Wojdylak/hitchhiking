<?php

namespace App\Entity;

use App\Entity\Traits\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 * @ORM\Table(name="profile")
 * @ORM\HasLifecycleCallbacks()
 */
class Profile
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="profile", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(name="first_name", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\OneToOne(targetEntity="Picture", cascade={"persist", "remove"})
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="is_completed", type="boolean", nullable=false, unique=false)
     */
    private $isCompleted = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Profile
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return Profile
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return Profile
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     * @return Profile
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Profile
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    /**
     * @param bool $isCompleted
     * @return Profile
     */
    public function setIsCompleted(bool $isCompleted): Profile
    {
        $this->isCompleted = $isCompleted;
        return $this;
    }
}
