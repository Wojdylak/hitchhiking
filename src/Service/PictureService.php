<?php


namespace App\Service;


use App\Entity\Picture;
use App\Repository\PictureRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var PictureRepository
     */
    private $pictureRepository;
    /**
     * @var FileUploader
     */
    private $fileUploader;

    public function __construct(EntityManagerInterface $entityManager, PictureRepository $pictureRepository, FileUploader $fileUploader)
    {
        $this->entityManager = $entityManager;
        $this->pictureRepository = $pictureRepository;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param int $id
     * @return Picture|null
     */
    public function get(int $id)
    {
        return $this->pictureRepository->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getList(Criteria $criteria)
    {
        return $this->pictureRepository->matching($criteria);
    }

    /**
     * @param Picture $picture
     * @return Picture
     */
    public function create(Picture $picture)
    {
        $this->entityManager->persist($picture);
        $this->entityManager->flush();

        return $picture;
    }

    /**
     * @param Picture $picture
     * @param UploadedFile $file
     * @return Picture
     */
    public function update(Picture $picture, UploadedFile $file)
    {
        if (false === $picture->isDefault()) {
            $this->fileUploader->remove($picture->getFilename());
        }
        $filename = $this->fileUploader->upload($file);

        $picture
            ->setFilename($filename)
            ->setPath('/uploads/' . $filename)
            ->setIsDefault(false)
        ;

        $this->entityManager->persist($picture);
        $this->entityManager->flush();

        return $picture;
    }

    /**
     * @param Picture $picture
     */
    public function delete(Picture $picture)
    {
        $this->entityManager->remove($picture);
        $this->entityManager->flush();
    }

    /**
     * @param Picture $picture
     * @return Picture
     */
    public function setDefaultProfile(Picture $picture)
    {
        $this->fileUploader->remove($picture->getFilename());

        $picture
            ->setFilename('default_profile.jpg')
            ->setPath('/uploads/default_profile.jpg')
            ->setIsDefault(true);

        $this->entityManager->persist($picture);
        $this->entityManager->flush();

        return $picture;
    }

    /**
     * @param Picture $picture
     * @return Picture
     */
    public function setDefaultNotice(Picture $picture)
    {
        $this->fileUploader->remove($picture->getFilename());

        $picture
            ->setFilename('default_notice.jpg')
            ->setPath('/uploads/default_notice.jpg')
            ->setIsDefault(true);

        $this->entityManager->persist($picture);
        $this->entityManager->flush();

        return $picture;
    }
}