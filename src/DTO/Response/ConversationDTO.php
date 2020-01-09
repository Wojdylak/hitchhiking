<?php


namespace App\DTO\Response;

class ConversationDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $picturePath;

    /**
     * @var int
     */
    private $amountUnread;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ConversationDTO
     */
    public function setId(int $id): ConversationDTO
    {
        $this->id = $id;
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
     * @return ConversationDTO
     */
    public function setFirstName(string $firstName): ConversationDTO
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
     * @return ConversationDTO
     */
    public function setLastName(string $lastName): ConversationDTO
    {
        $this->lastName = $lastName;
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
     * @return ConversationDTO
     */
    public function setPicturePath(string $picturePath): ConversationDTO
    {
        $this->picturePath = $picturePath;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountUnread(): int
    {
        return $this->amountUnread;
    }

    /**
     * @param int $amountUnread
     * @return ConversationDTO
     */
    public function setAmountUnread(int $amountUnread): ConversationDTO
    {
        $this->amountUnread = $amountUnread;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->id);
    }
}