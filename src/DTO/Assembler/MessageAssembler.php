<?php


namespace App\DTO\Assembler;


use App\DTO\Request\MessageDTO as RequestMessageDTO;
use App\DTO\Response\MessageDTO as ResponseMessageDTO;
use App\DTO\Response\ConversationDTO;
use App\DTO\Response\UserMessageDTO;
use App\Entity\Message;
use App\Entity\User;
use App\Service\MessageService;

class MessageAssembler
{
    /**
     * @var MessageService
     */
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function writeEntity(RequestMessageDTO $messageDTO, Message $message = null)
    {
        if (null === $message) {
            $message = new Message();
        }

        $message
            ->setUserIdTo($messageDTO->getUserIdTo())
            ->setText($messageDTO->getText())
        ;

        return $message;
    }

    public function updateMessage(Message $message, RequestMessageDTO $messageDTO)
    {
        return $this->writeEntity($messageDTO, $message);
    }

    public function createMessage(RequestMessageDTO $messageDTO)
    {
        return $this->writeEntity($messageDTO);
    }

    public function writeDTO(Message $message)
    {
        $dto = new ResponseMessageDTO();
        $userMessageDTO = new UserMessageDTO();

        /** @var User $userFrom */
        $userFrom = $message->getUserIdFrom();
        $userMessageDTO
            ->setId($userFrom->getId())
            ->setName(sprintf('%s %s',$userFrom->getProfile()->getFirstName(), $userFrom->getProfile()->getLastName()))
            ->setAvatar('')
        ;

        $dto
            ->setId($message->getId())
            ->setUser($userMessageDTO)
            ->setText($message->getText())
            ->setCreatedAt($message->getCreatedAt())
            ->setImage('')
            ->setVideo('')
        ;

        return $dto;
    }

    public function writeConversationDTO($conversation, User $user)
    {
        $dto = new ConversationDTO();

        $amount = $this->messageService->getAmountUnreadMessages($conversation['user_id'], $user);

        $dto
            ->setId($conversation['user_id'])
            ->setFirstName($conversation['first_name'])
            ->setLastName($conversation['last_name'])
            ->setPicturePath($conversation['path'])
            ->setAmountUnread($amount)
        ;

        return $dto;
    }
}