<?php


namespace App\Controller\Api;


use App\DTO\Assembler\NoticeAssembler;
use App\DTO\Request\NoticeDTO;
use App\Entity\Notice;
use App\Service\NoticeService;
use Doctrine\Common\Collections\Criteria;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class NoticeController extends AbstractFOSRestController
{
    /**
     * @var NoticeService
     */
    private $noticeService;
    /**
     * @var NoticeAssembler
     */
    private $noticeAssembler;

    public function __construct(NoticeService $noticeService, NoticeAssembler $noticeAssembler)
    {
        $this->noticeService = $noticeService;
        $this->noticeAssembler = $noticeAssembler;
    }

    /**
     * @ParamConverter("notice", class="App\Entity\Notice")
     * @Rest\Get("/notice/{id}", name="notice", requirements={"id"="\d+"})
     * @param Notice $notice
     * @return Response
     */
    public function getAction(Notice $notice)
    {
        $this->denyAccessUnlessGranted('view', $this->getUser()->getProfile());
        $data = $this->noticeAssembler->writeDTO($notice);

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }

    /**
     * @Rest\Get("/notices", name="notices")
     * @return Response
     */
    public function getListAction()
    {
        $this->denyAccessUnlessGranted('view', $this->getUser()->getProfile());
        $criteria = new Criteria();
        $criteria->andWhere(Criteria::expr()->eq('isActive', true));

        $profiles = $this->noticeService->getList($criteria);
        $data = [];
        foreach ($profiles as $profile) {
            $data[] = $this->noticeAssembler->writeDTO($profile);
        }

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }

    /**
     * @ParamConverter("noticeDTO", converter="fos_rest.request_body")
     * @Rest\Post("/notice/create", name="notice_create")
     * @param NoticeDTO $noticeDTO
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function createAction(NoticeDTO $noticeDTO, ConstraintViolationListInterface $validationErrors)
    {
        $this->denyAccessUnlessGranted('view', $this->getUser()->getProfile());
        if (count($validationErrors) > 0) {
            return $this->handleView($this->view(
                $validationErrors,
                Response::HTTP_BAD_REQUEST
            ));
        }

        $notice = $this->noticeAssembler->createNotice($noticeDTO);
        $notice = $this->noticeService->create($notice);

        $data = $this->noticeAssembler->writeDTO($notice);
        return $this->handleView($this->view($data, Response::HTTP_CREATED));
    }

    /**
     * @ParamConverter("notice", class="App\Entity\Notice")
     * @ParamConverter("noticeDTO", converter="fos_rest.request_body")
     * @Rest\Put("/notice/update/{id}", name="notice_update", requirements={"id"="\d+"})
     * @param Notice $notice
     * @param NoticeDTO $noticeDTO
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function updateAction(Notice $notice, NoticeDTO $noticeDTO, ConstraintViolationListInterface $validationErrors)
    {
        $this->denyAccessUnlessGranted('edit', $notice);
        if (count($validationErrors) > 0) {
            return $this->handleView($this->view(
                $validationErrors,
                Response::HTTP_BAD_REQUEST
            ));
        }

        $notice = $this->noticeAssembler->updateNotice($notice, $noticeDTO);
        $notice = $this->noticeService->update($notice);

        $data = $this->noticeAssembler->writeDTO($notice);
        return $this->handleView($this->view($data, Response::HTTP_CREATED));
    }

    /**
     * @ParamConverter("notice", class="App\Entity\Notice")
     * @Rest\Delete("/notice/delete/{id}", name="notice_delete", requirements={"id"="\d+"})
     * @param Notice $notice
     * @return Response
     */
    public function deleteAction(Notice $notice)
    {
        $this->denyAccessUnlessGranted('edit', $notice);
        $this->noticeService->delete($notice);

        return $this->handleView($this->view(null, Response::HTTP_NO_CONTENT));
    }
}