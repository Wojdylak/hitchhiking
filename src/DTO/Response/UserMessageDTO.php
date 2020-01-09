<?php


namespace App\DTO\Response;


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