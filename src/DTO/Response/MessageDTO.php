<?php


namespace App\DTO\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

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
     * @var boolean
     */
    private $isNew;

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

class UserMessageDTO
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     * @return UserMessageDTO
     */
    public function setId(int $id): UserMessageDTO
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserMessageDTO
     */
    public function setName(string $name): UserMessageDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return UserMessageDTO
     */
    public function setAvatar(string $avatar): UserMessageDTO
    {
        $this->avatar = $avatar;
        return $this;
    }
}