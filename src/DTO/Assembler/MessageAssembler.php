<?php


namespace App\DTO\Assembler;


use App\DTO\Request\MessageDTO as RequestMessageDTO;
use App\DTO\Response\MessageDTO as ResponseMessageDTO;
use App\DTO\Response\UserConversationDTO;
use App\DTO\Response\UserMessageDTO;
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
            ->setIsNew($message->isNew())
            ->setImage('')
            ->setVideo('')
        ;

        return $dto;
    }

    public function writeUserConversationDTO($message, User $user)
    {
        $dto = new UserConversationDTO();

        if ($message['userIdTo'] === $user->getId()) {
            $dto
                ->setId($message['userIdFrom'])
                ->setFirstName($message['firstNameFrom'])
                ->setLastName($message['lastNameFrom'])
                ->setPicturePath($message['pathFrom'])
            ;
        } else {
            $dto
                ->setId($message['userIdTo'])
                ->setFirstName($message['firstNameTo'])
                ->setLastName($message['lastNameTo'])
                ->setPicturePath($message['pathTo'])
            ;
        }

        return $dto;
    }
}