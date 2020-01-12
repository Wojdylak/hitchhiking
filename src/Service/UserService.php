<?php


namespace App\Service;


use App\Entity\Picture;
use App\Entity\Profile;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function get(int $id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getList(Criteria $criteria)
    {
        return $this->userRepository->matching($criteria);
    }

    /**
     * @param User $user
     * @return User
     */
    public function create(User $user)
    {
        $picture = new Picture();
        $picture
            ->setOwner($user)
            ->setFilename('default_profile.jpg')
            ->setPath('/uploads/default_profile.jpg');

        $profile = new Profile();
        $profile
            ->setUser($user)
            ->setFirstName('none')
            ->setLastName('none')
            ->setPicture($picture);

        $user->setProfile($profile);

        $this->entityManager->persist($picture);
        $this->entityManager->persist($profile);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function update(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @param User $user
     */
    public function delete(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function createSuperUser()
    {
        $user = new User();
        $encoded = $this->encoder->encodePassword($user, 'Testowy1');

        $user->setEmail('superadministrator@admin.pl');
        $user->setPassword($encoded);
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setIsActive(true);

        $this->create($user);
    }

    public function changePassword(User $user, string $password)
    {
        $encoded = $this->encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $this->update($user);
    }
}