<?php


namespace App\Service;


use App\Entity\Message;
use App\Entity\User;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MessageService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var MessageRepository
     */
    private $messageRepository;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, MessageRepository $messageRepository, TokenStorageInterface $tokenStorage, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->messageRepository = $messageRepository;
        $this->tokenStorage = $tokenStorage;
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return Message|null
     */
    public function get(int $id)
    {
        return $this->messageRepository->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getList(Criteria $criteria)
    {
        $criteria->orderBy(array_merge($criteria->getOrderings(), ['id' => Criteria::ASC]));

        return $this->messageRepository->matching($criteria);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getListUserConversation(User $user)
    {
        return $this->messageRepository->findListUserConversation($user);
    }

    /**
     * @param Message $message
     * @return Message
     */
    public function create(Message $message)
    {
        $userFrom = $this->tokenStorage->getToken()->getUser();
        $userTo = $this->userRepository->find($message->getUserIdTo());

        $message
            ->setUserIdFrom($userFrom)
            ->setUserIdTo($userTo)
        ;
//        var_dump($message);

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        return $message;
    }

    /**
     * @param Message $message
     * @return Message
     */
    public function update(Message $message)
    {
        $this->entityManager->persist($message);
        $this->entityManager->flush();

        return $message;
    }

    /**
     * @param Message $message
     */
    public function delete(Message $message)
    {
        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }
}