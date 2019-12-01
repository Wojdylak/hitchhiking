<?php


namespace App\DTO\Response;


class ProfileDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var int
     */
    private $pictureId;

    /**
     * @var string
     */
    private $picturePath;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProfileDTO
     */
    public function setId(int $id): ProfileDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     * @return ProfileDTO
     */
    public function setUser(int $user): ProfileDTO
    {
        $this->user = $user;
        return $this;
    }

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
     * @return int
     */
    public function getPictureId(): int
    {
        return $this->pictureId;
    }

    /**
     * @param int $pictureId
     * @return ProfileDTO
     */
    public function setPictureId(int $pictureId): ProfileDTO
    {
        $this->pictureId = $pictureId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicturePath(): string
    {
        return $this->picturePath;
    }

    /**
     * @param string $picturePath
     * @return ProfileDTO
     */
    public function setPicturePath(string $picturePath): ProfileDTO
    {
        $this->picturePath = $picturePath;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return ProfileDTO
     */
    public function setDescription(?string $description): ProfileDTO
    {
        $this->description = $description;
        return $this;
    }
}