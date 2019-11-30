<?php


namespace App\Service;


use App\Entity\Notice;
use App\Repository\NoticeRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class NoticeService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var NoticeRepository
     */
    private $noticeRepository;

    public function __construct(EntityManagerInterface $entityManager, NoticeRepository $noticeRepository)
    {
        $this->entityManager = $entityManager;
        $this->noticeRepository = $noticeRepository;
    }

    /**
     * @param int $id
     * @return Notice|null
     */
    public function get(int $id)
    {
        return $this->noticeRepository->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getList(Criteria $criteria)
    {
        return $this->noticeRepository->matching($criteria);
    }

    /**
     * @param Notice $notice
     * @return Notice
     */
    public function create(Notice $notice)
    {
        $this->entityManager->persist($notice);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param Notice $notice
     * @return Notice
     */
    public function update(Notice $notice)
    {
        $this->entityManager->persist($notice);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param Notice $notice
     */
    public function delete(Notice $notice)
    {
        $this->entityManager->remove($notice);
        $this->entityManager->flush();
    }
}