<?php


namespace App\DTO\Assembler;

use App\DTO\Request\UserDTO as RequestUserDTO;
use App\DTO\Response\UserDTO as ResponseUserDTO;
use App\Entity\User;

final class UserAssembler
{
    public function writeEntity(RequestUserDTO $userDTO, User $user = null)
    {
        if (null === $user) {
            $user = new User();
        }

        $user
            ->setEmail($userDTO->getEmail())
            ->setPassword($userDTO->getPassword())
        ;

        return $user;
    }

    public function updateUser(User $user, RequestUserDTO $userDTO)
    {
        return $this->writeEntity($userDTO, $user);
    }

    public function createUser(RequestUserDTO $userDTO)
    {
        return $this->writeEntity($userDTO);
    }

    public function writeDTO(User $user)
    {
        $dto = new ResponseUserDTO();

        $profile = $user->getProfile() ? $user->getProfile()->getId() : null;

        $dto
            ->setId($user->getId())
            ->setEmail($user->getEmail())
            ->setProfile($profile)
        ;

        return $profile;
    }
}