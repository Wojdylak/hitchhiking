<?php


namespace App\Controller\Api;


use App\DTO\Assembler\UserAssembler;
use App\DTO\Request\UserDTO as RequestUserDTO;
use App\Service\JWT\JWTService;
use App\Service\UserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Rest\Route("/auth", name="auth_")
 */
class AuthController extends AbstractFOSRestController
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var UserAssembler
     */
    private $userAssembler;
    /**
     * @var JWTService
     */
    private $JWTService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     * @param UserAssembler $userAssembler
     * @param JWTService $JWTService
     */
    public function __construct(UserService $userService, UserAssembler $userAssembler, JWTService $JWTService)
    {
        $this->userService = $userService;
        $this->userAssembler = $userAssembler;
        $this->JWTService = $JWTService;
    }

    /**
     * @ParamConverter("userDTO", converter="fos_rest.request_body")
     * @Rest\Post("/register", name="register")
     * @param RequestUserDTO $userDTO
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function register(RequestUserDTO $userDTO, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            return $this->handleView($this->view($validationErrors, Response::HTTP_BAD_REQUEST));
        }
        $user = $this->userAssembler->createUser($userDTO);
        $user->setRoles(['ROLE_API']);
        $user = $this->userService->create($user);

        return $this->handleView($this->view($this->JWTService->createNewJWT($user),Response::HTTP_CREATED));
    }
}