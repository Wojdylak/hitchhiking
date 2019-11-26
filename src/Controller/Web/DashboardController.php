<?php

namespace App\Controller\Web;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $users = $this->userRepository->findAll();

        return $this->render('web/dashboard/index.html.twig', [
            'users' => $users,
        ]);
    }
}
