<?php


namespace App\DTO\Response;

class UserConversationDTO
{
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
    private $userPicturePathTo;

    /**
     * @return int
     */
    public function getUserIdFrom(): int
    {
        return $this->userIdFrom;
    }

    /**
     * @param int $userIdFrom
     * @return UserConversationDTO
     */
    public function setUserIdFrom(int $userIdFrom): UserConversationDTO
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
     * @return UserConversationDTO
     */
    public function setUserIdTo(int $userIdTo): UserConversationDTO
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
     * @return UserConversationDTO
     */
    public function setUserFirstNameTo(string $userFirstNameTo): UserConversationDTO
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
     * @return UserConversationDTO
     */
    public function setUserLastNameTo(string $userLastNameTo): UserConversationDTO
    {
        $this->userLastNameTo = $userLastNameTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserPicturePathTo(): string
    {
        return $this->userPicturePathTo;
    }

    /**
     * @param string $userPicturePathTo
     * @return UserConversationDTO
     */
    public function setUserPicturePathTo(string $userPicturePathTo): UserConversationDTO
    {
        $this->userPicturePathTo = $userPicturePathTo;
        return $this;
    }
}