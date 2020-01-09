<?php

namespace App\Controller\Web;

use App\Entity\User;
use App\Repository\NoticeRepository;
use App\Repository\UserRepository;
use App\Service\UserService;
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
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(EntityManagerInterface $entityManager, UserService $userService, UserRepository $userRepository, NoticeRepository $noticeRepository)
    {
        $this->userRepository = $userRepository;
        $this->noticeRepository = $noticeRepository;
        $this->entityManager = $entityManager;
        $this->userService = $userService;
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
     * @Route("/user/{id}/change_role", name="user_change_role")
     * @param User $user
     * @return string
     */
    public function changeRoleUser(User $user)
    {
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $user->setRoles(['ROLE_API']);
        } else {
            $user->setRoles(['ROLE_ADMIN']);
        }
        $this->userService->update($user);

        return $this->redirectToRoute('admin_users');
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
