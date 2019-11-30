<?php


namespace App\DTO\Assembler;


use App\DTO\Request\NoticeDTO as RequestNoticeDTO;
use App\DTO\Response\NoticeDTO as ResponseNoticeDTO;
use App\Entity\Notice;

class NoticeAssembler
{
    public function writeEntity(RequestNoticeDTO $noticeDTO, Notice $notice = null)
    {
        if (null === $notice) {
            $notice = new Notice();
        }

        $notice
            ->setDescription($noticeDTO->getDescription())
            ->setType($noticeDTO->getType())
            ->setPlace($noticeDTO->getPlace())
            ->setStartDate($noticeDTO->getStartDate())
            ->setEndDate($noticeDTO->getEndDate())
            ->setTags($noticeDTO->getTags())
        ;

        return $notice;
    }

    public function updateNotice(Notice $notice, RequestNoticeDTO $noticeDTO)
    {
        return $this->writeEntity($noticeDTO, $notice);
    }

    public function createNotice(RequestNoticeDTO $noticeDTO)
    {
        return $this->writeEntity($noticeDTO);
    }

    public function writeDTO(Notice $notice)
    {
        $dto = new ResponseNoticeDTO();

        $picture = $notice->getPicture();

        $dto
            ->setId($notice->getId())
            ->setDescription($notice->getDescription())
            ->setUser($notice->getUser()->getId)
            ->setPictureId($picture->getId())
            ->setPicturePath($picture->getPath())
            ->setType($notice->getType())
            ->setPlace($notice->getPlace())
            ->setStartDate($notice->getStartDate())
            ->setEndDate($notice->getEndDate())
            ->setTags($notice->getTags())
        ;

        return $dto;
    }
}