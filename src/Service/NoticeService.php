<?php


namespace App\Service;


use App\Entity\Notice;
use App\Entity\Picture;
use App\Repository\NoticeRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, NoticeRepository $noticeRepository, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->noticeRepository = $noticeRepository;
        $this->tokenStorage = $tokenStorage;
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
        $criteria->orderBy(array_merge($criteria->getOrderings(), ['id' => Criteria::ASC]));

        return $this->noticeRepository->matching($criteria);
    }

    /**
     * @param Notice $notice
     * @return Notice
     */
    public function create(Notice $notice)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $picture = new Picture();
        $picture
            ->setOwner($user)
            ->setFilename('default_notice.jpg')
            ->setPath('/uploads/default_notice.jpg');

        $notice
            ->setUser($user)
            ->setPicture($picture)
            ->setIsActive(true)
        ;

        $this->entityManager->persist($picture);
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