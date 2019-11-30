<?php


namespace App\DTO\Request;


use App\Component\Validator\Constraint as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     * @AppAssert\UniqueEmail()
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="8")
     */
    private $password;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserDTO
     */
    public function setEmail(string $email): UserDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserDTO
     */
    public function setPassword(string $password): UserDTO
    {
        $this->password = $password;
        return $this;
    }
}