<?php

namespace App\Entity;

use App\Entity\Traits\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoticeRepository")
 * @ORM\Table(name="message")
 * @ORM\HasLifecycleCallbacks()
 */
class Message
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id_from", referencedColumnName="id", onDelete="CASCADE")
     */
    private $userIdFrom;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id_to", referencedColumnName="id", onDelete="CASCADE")
     */
    private $userIdTo;

    /**
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isNew = true;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Message
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserIdFrom()
    {
        return $this->userIdFrom;
    }

    /**
     * @param mixed $userIdFrom
     * @return Message
     */
    public function setUserIdFrom($userIdFrom)
    {
        $this->userIdFrom = $userIdFrom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserIdTo()
    {
        return $this->userIdTo;
    }

    /**
     * @param mixed $userIdTo
     * @return Message
     */
    public function setUserIdTo($userIdTo)
    {
        $this->userIdTo = $userIdTo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Message
     */
    public function setText($text)
    {
        $this->text = $text;
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
     * @return Message
     */
    public function setIsNew(bool $isNew): Message
    {
        $this->isNew = $isNew;
        return $this;
    }
}
