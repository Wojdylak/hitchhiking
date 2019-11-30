<?php


namespace App\DTO\Request;


use Symfony\Component\Validator\Constraints as Assert;

class ProfileDTO
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="50")
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="50")
     */
    private $lastName;

    /**
     * @var string
     */
    private $description;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return ProfileDTO
     */
    public function setFirstName(string $firstName): ProfileDTO
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return ProfileDTO
     */
    public function setLastName(string $lastName): ProfileDTO
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ProfileDTO
     */
    public function setDescription(string $description): ProfileDTO
    {
        $this->description = $description;
        return $this;
    }
}