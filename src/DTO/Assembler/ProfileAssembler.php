<?php


namespace App\DTO\Assembler;


use App\DTO\Request\ProfileDTO as RequestProfileDTO;
use App\DTO\Response\ProfileDTO as ResponseProfileDTO;
use App\Entity\Profile;

class ProfileAssembler
{
    public function writeEntity(RequestProfileDTO $profileDTO, Profile $profile = null)
    {
        if (null === $profile) {
            $profile = new Profile();
        }

        $profile
            ->setDescription($profileDTO->getDescription())
            ->setFirstName($profileDTO->getFirstName())
            ->setLastName($profileDTO->getLastName())
        ;

        return $profile;
    }

    public function updateProfile(Profile $profile, RequestProfileDTO $profileDTO)
    {
        return $this->writeEntity($profileDTO, $profile);
    }

    public function createProfile(RequestProfileDTO $profileDTO)
    {
        return $this->writeEntity($profileDTO);
    }

    public function writeDTO(Profile $profile)
    {
        $dto = new ResponseProfileDTO();

        $picture = $profile->getPicture();

        $dto
            ->setId($profile->getId())
            ->setDescription($profile->getDescription())
            ->setFirstName($profile->getFirstName())
            ->setLastName($profile->getLastName())
            ->setPictureId($picture->getId())
            ->setPicturePath($picture->getPath())
            ->setUser($profile->getUser()->getId())
        ;

        return $dto;
    }
}