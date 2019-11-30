<?php


namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;

trait IsActiveTrait
{
    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=false, unique=false)
     */
    private $isActive = true;

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }
}