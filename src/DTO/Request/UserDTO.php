<?php


namespace App\DTO\Request;


use App\Component\Validator\Constraint as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    /**
     * @var string
     * @Assert\NotBlank(groups={"new"})
     * @Assert\Email(groups={"new"})
     * @AppAssert\UniqueEmail(groups={"new"})
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(groups={"new", "change"})
     * @Assert\Length(min="8", groups={"new", "change"})
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