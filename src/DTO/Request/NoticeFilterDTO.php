<?php


namespace App\DTO\Request;


use Symfony\Component\Validator\Constraints as Assert;

class NoticeFilterDTO
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var array
     */
    private $filter;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return NoticeFilterDTO
     */
    public function setOffset(int $offset): NoticeFilterDTO
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param mixed $filter
     * @return NoticeFilterDTO
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }
}