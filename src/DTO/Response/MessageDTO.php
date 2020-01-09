<?php


namespace App\DTO\Response;

class MessageDTO
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var UserMessageDTO
     */
    private $user;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $image;

    /**
     * @var
     */
    private $video;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     * @return MessageDTO
     */
    public function setId(int $id): MessageDTO
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return UserMessageDTO
     */
    public function getUser(): UserMessageDTO
    {
        return $this->user;
    }

    /**
     * @param UserMessageDTO $user
     * @return MessageDTO
     */
    public function setUser(UserMessageDTO $user): MessageDTO
    {
        $this->user = $user;
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
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return MessageDTO
     */
    public function setCreatedAt(\DateTime $createdAt): MessageDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return MessageDTO
     */
    public function setImage(string $image): MessageDTO
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return MessageDTO
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }
}