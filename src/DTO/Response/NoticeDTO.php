<?php


namespace App\DTO\Response;

class NoticeDTO
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
     * @var int
     */
    private $profileId;

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
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $place;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var array
     */
    private $tags;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return NoticeDTO
     */
    public function setId(int $id): NoticeDTO
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
     * @return NoticeDTO
     */
    public function setUser(int $user): NoticeDTO
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getProfileId(): int
    {
        return $this->profileId;
    }

    /**
     * @param int $profileId
     * @return NoticeDTO
     */
    public function setProfileId(int $profileId): NoticeDTO
    {
        $this->profileId = $profileId;
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
     * @return NoticeDTO
     */
    public function setFirstName(string $firstName): NoticeDTO
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
     * @return NoticeDTO
     */
    public function setLastName(string $lastName): NoticeDTO
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
     * @return NoticeDTO
     */
    public function setPictureId(int $pictureId): NoticeDTO
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
     * @return NoticeDTO
     */
    public function setPicturePath(string $picturePath): NoticeDTO
    {
        $this->picturePath = $picturePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return NoticeDTO
     */
    public function setDescription(string $description): NoticeDTO
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return NoticeDTO
     */
    public function setType(string $type): NoticeDTO
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return NoticeDTO
     */
    public function setPlace(string $place): NoticeDTO
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return NoticeDTO
     */
    public function setStartDate(\DateTime $startDate): NoticeDTO
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return NoticeDTO
     */
    public function setEndDate(\DateTime $endDate): NoticeDTO
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return NoticeDTO
     */
    public function setTags(array $tags): NoticeDTO
    {
        $this->tags = $tags;
        return $this;
    }
}