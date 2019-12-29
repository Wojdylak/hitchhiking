<?php


namespace App\DTO\Response;

class MessageDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userIdFrom;

    /**
     * @var int
     */
    private $userIdTo;

    /**
     * @var string
     */
    private $userFirstNameTo;

    /**
     * @var string
     */
    private $userLastNameTo;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $isNew;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MessageDTO
     */
    public function setId(int $id): MessageDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserIdFrom(): int
    {
        return $this->userIdFrom;
    }

    /**
     * @param int $userIdFrom
     * @return MessageDTO
     */
    public function setUserIdFrom(int $userIdFrom): MessageDTO
    {
        $this->userIdFrom = $userIdFrom;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserIdTo(): int
    {
        return $this->userIdTo;
    }

    /**
     * @param int $userIdTo
     * @return MessageDTO
     */
    public function setUserIdTo(int $userIdTo): MessageDTO
    {
        $this->userIdTo = $userIdTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserFirstNameTo(): string
    {
        return $this->userFirstNameTo;
    }

    /**
     * @param string $userFirstNameTo
     * @return MessageDTO
     */
    public function setUserFirstNameTo(string $userFirstNameTo): MessageDTO
    {
        $this->userFirstNameTo = $userFirstNameTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserLastNameTo(): string
    {
        return $this->userLastNameTo;
    }

    /**
     * @param string $userLastNameTo
     * @return MessageDTO
     */
    public function setUserLastNameTo(string $userLastNameTo): MessageDTO
    {
        $this->userLastNameTo = $userLastNameTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return MessageDTO
     */
    public function setText(string $text): MessageDTO
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return MessageDTO
     */
    public function setDate(\DateTime $date): MessageDTO
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->isNew;
    }

    /**
     * @param bool $isNew
     * @return MessageDTO
     */
    public function setIsNew(bool $isNew): MessageDTO
    {
        $this->isNew = $isNew;
        return $this;
    }
}