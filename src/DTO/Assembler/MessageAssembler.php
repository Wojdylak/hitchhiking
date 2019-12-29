<?php


namespace App\DTO\Assembler;


use App\DTO\Request\MessageDTO as RequestMessageDTO;
use App\DTO\Response\MessageDTO as ResponseMessageDTO;
use App\DTO\Response\UserConversationDTO;
use App\Entity\Message;
use App\Entity\User;

class MessageAssembler
{
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

        /** @var User $userTo */
        $userTo = $message->getUserIdTo();

        $dto
            ->setId($message->getId())
            ->setUserIdFrom($message->getUserIdFrom()->getId())
            ->setUserIdTo($userTo->getId())
            ->setUserFirstNameTo($userTo->getProfile()->getFirstName())
            ->setUserLastNameTo($userTo->getProfile()->getLastName())
            ->setText($message->getText())
            ->setDate($message->getCreatedAt())
            ->setIsNew($message->isNew())
        ;

        return $dto;
    }

    public function writeUserConversationDTO($message)
    {
        $dto = new UserConversationDTO();

        $dto
            ->setUserIdFrom($message['userIdFrom'])
            ->setUserIdTo($message['userIdTo'])
            ->setUserFirstNameTo($message['firstName'])
            ->setUserLastNameTo($message['lastName'])
            ->setUserPicturePathTo($message['path'])
        ;

        return $dto;
    }
}