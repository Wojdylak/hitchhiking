<?php


namespace App\DTO\Request;


use Symfony\Component\Validator\Constraints as Assert;

class MessageDTO
{
    /**
     * @var int
     * @Assert\NotNull()
     */
    private $userIdTo;

    /**
     * @var string
     * @Assert\NotNull()
     */
    private $text;

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
}