<?php


namespace App\Service;


use App\Entity\Profile;
use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class ProfileService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    public function __construct(EntityManagerInterface $entityManager, ProfileRepository $profileRepository)
    {
        $this->entityManager = $entityManager;
        $this->profileRepository = $profileRepository;
    }

    /**
     * @param int $id
     * @return Profile|null
     */
    public function get(int $id)
    {
        return $this->profileRepository->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getList(Criteria $criteria)
    {
        $criteria->orderBy(['createdAt' => 'ASC']);
        $criteria->setMaxResults(20);
        return $this->profileRepository->matching($criteria);
    }

    /**
     * @param Profile $profile
     * @return Profile
     */
    public function create(Profile $profile)
    {
        $this->entityManager->persist($profile);
        $this->entityManager->flush();

        return $profile;
    }

    /**
     * @param Profile $profile
     * @return Profile
     */
    public function update(Profile $profile)
    {
        $this->entityManager->persist($profile);
        $this->entityManager->flush();

        return $profile;
    }

    /**
     * @param Profile $profile
     */
    public function delete(Profile $profile)
    {
        $this->entityManager->remove($profile);
        $this->entityManager->flush();
    }
}