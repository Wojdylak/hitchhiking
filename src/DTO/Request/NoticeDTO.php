<?php


namespace App\DTO\Request;


use Symfony\Component\Validator\Constraints as Assert;

class NoticeDTO
{
    /**
     * @var string
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @var string
     * @Assert\NotNull()
     * @Assert\Choice(callback={"App\Entity\Notice", "getTypes"})
     */
    private $type;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $place;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Assert\GreaterThanOrEqual(value="today", message="Past")
     */
    private $startDate;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Assert\GreaterThanOrEqual(value="today", message="Past")
     * @Assert\Expression("this.getEndDate() >= this.getStartDate()", message="Wrong date")
     */
    private $endDate;

    /**
     * @var array
     * @Assert\All({
     *     @Assert\NotNull(),
     *     @Assert\NotBlank()
     * })
     */
    private $tags;

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