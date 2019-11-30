<?php


namespace App\DTO\Response;


class UserDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var null|int
     */
    private $profile;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserDTO
     */
    public function setId(int $id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

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
     * @return int|null
     */
    public function getProfile(): ?int
    {
        return $this->profile;
    }

    /**
     * @param int|null $profile
     * @return UserDTO
     */
    public function setProfile(?int $profile): UserDTO
    {
        $this->profile = $profile;
        return $this;
    }
}