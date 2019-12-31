<?php

namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(string $name = null, UserService $userService)
    {
        parent::__construct($name);
        $this->userService = $userService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->userService->createSuperUser();

        $io->success('You created user');

        return 0;
    }
}
