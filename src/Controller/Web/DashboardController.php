<?php

namespace App\Controller\Web;

use App\Entity\User;
use App\Repository\NoticeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var NoticeRepository
     */
    private $noticeRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, NoticeRepository $noticeRepository)
    {
        $this->userRepository = $userRepository;
        $this->noticeRepository = $noticeRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $numberUsers = count($this->userRepository->findAll());
        $numberAnnouncementsType['all'] = count($this->noticeRepository->findAll());
        $numberAnnouncementsType['companion'] = count($this->noticeRepository->findBy(['type' => 'companion']));
        $numberAnnouncementsType['integration'] = count($this->noticeRepository->findBy(['type' => 'integration']));


        return $this->render('web/dashboard/index.html.twig', [
            'numberUser' => $numberUsers,
            'numberAnnouncementsType' => $numberAnnouncementsType,
        ]);
    }

    /**
     * @Route("/users", name="users")
     */
    public function showUsersAction()
    {
        $users = $this->userRepository->findBy([], ['createdAt' => 'ASC']);

        return $this->render('web/dashboard/show.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @ParamConverter(name="User", class="App\Entity\User")
     * @Route("/user/{id}/delete", name="user_delete")
     * @param User $user
     * @return string
     */
    public function deleteUser(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('admin_users');
    }
}
