<?php

namespace App\Controller\Api;

use App\DTO\Assembler\MessageAssembler;
use App\DTO\Request\MessageDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\MessageService;
use Doctrine\Common\Collections\Criteria;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class MessageController extends AbstractFOSRestController
{
    /**
     * @var MessageService
     */
    private $messageService;
    /**
     * @var MessageAssembler
     */
    private $messageAssembler;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(MessageService $messageService, MessageAssembler $messageAssembler, UserRepository $userRepository)
    {
        $this->messageService = $messageService;
        $this->messageAssembler = $messageAssembler;
        $this->userRepository = $userRepository;
    }

    /**
     * @ParamConverter("userTo", class="App\Entity\User")
     * @Rest\Get("/messages/user/{id}", name="messages_user", requirements={"id"="\d+"})
     * @param User $userTo
     * @return Response
     */
    public function getMessageList(User $userTo)
    {
        $userFrom = $this->getUser();
        $criteria = new Criteria();
        $criteria->orderBy(['createdAt' => Criteria::DESC]);
        $criteria->andWhere(
            Criteria::expr()->orX(
                Criteria::expr()->andX(
                    Criteria::expr()->eq('userIdTo', $userTo),
                    Criteria::expr()->eq('userIdFrom', $userFrom)
                    ),
                Criteria::expr()->andX(
                    Criteria::expr()->eq('userIdFrom', $userTo),
                    Criteria::expr()->eq('userIdTo', $userFrom)
                )
            ));

        $messages = $this->messageService->getList($criteria);
        $this->messageService->setMessagesRead($userFrom, $userTo);
        $data = [];
        foreach ($messages as $message) {
            $data[] = $this->messageAssembler->writeDTO($message);
        }

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }

    /**
     * @Rest\Get("/conversations", name="conversations")
     * @return Response
     */
    public function getConversationListAction()
    {
        $conversations = $this->messageService->getConversationListUser($this->getUser());
        $data = [];
        foreach ($conversations as $conversation) {
            $data[] = $this->messageAssembler->writeConversationDTO($conversation, $this->getUser());
        }
//        $data = array_values(array_unique($data));

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }

    /**
     * @ParamConverter("messageDTO", converter="fos_rest.request_body")
     * @Rest\Post("/message/create", name="message_create")
     * @param MessageDTO $messageDTO
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function createAction(MessageDTO $messageDTO, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            return $this->handleView($this->view(
                $validationErrors,
                Response::HTTP_BAD_REQUEST
            ));
        }

        $message = $this->messageAssembler->createMessage($messageDTO);
        $message = $this->messageService->create($message);

        $data = $this->messageAssembler->writeDTO($message);
        return $this->handleView($this->view($data, Response::HTTP_CREATED));
    }
}
