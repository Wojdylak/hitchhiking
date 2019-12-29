<?php


namespace App\Controller\Api;


use App\DTO\Assembler\ProfileAssembler;
use App\DTO\Request\ProfileDTO;
use App\Entity\Profile;
use App\Entity\User;
use App\Service\ProfileService;
use Doctrine\Common\Collections\Criteria;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ProfileController extends AbstractFOSRestController
{
    /**
     * @var ProfileService
     */
    private $profileService;
    /**
     * @var ProfileAssembler
     */
    private $profileAssembler;

    public function __construct(ProfileService $profileService, ProfileAssembler $profileAssembler)
    {
        $this->profileService = $profileService;
        $this->profileAssembler = $profileAssembler;
    }

    /**
     * @ParamConverter("profile", class="App\Entity\Profile")
     * @Rest\Get("/profile/{id}", name="profile", requirements={"id"="\d+"})
     * @param Profile $profile
     * @return Response
     */
    public function getAction(Profile $profile)
    {
        $this->denyAccessUnlessGranted('view', $this->getUser()->getProfile());
        $data = $this->profileAssembler->writeDTO($profile);

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }

    /**
     * @Rest\Get("/profiles", name="profiles")
     * @return Response
     */
    public function getListAction()
    {
        $this->denyAccessUnlessGranted('view', $this->getUser()->getProfile());
        $criteria = new Criteria();
        $criteria->andWhere(Criteria::expr()->eq('isCompleted', true));

        $profiles = $this->profileService->getList($criteria);
        $data = [];
        foreach ($profiles as $profile) {
            $data[] = $this->profileAssembler->writeDTO($profile);
        }

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }

    /**
     * @ParamConverter("profile", class="App\Entity\Profile")
     * @ParamConverter("profileDTO", converter="fos_rest.request_body")
     * @Rest\Put("/profile/update/{id}", name="profile_update", requirements={"id"="\d+"})
     * @param Profile $profile
     * @param ProfileDTO $profileDTO
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function updateAction(Profile $profile, ProfileDTO $profileDTO, ConstraintViolationListInterface $validationErrors)
    {
        $this->denyAccessUnlessGranted('edit', $profile);
        if (count($validationErrors) > 0) {
            return $this->handleView($this->view(
                $validationErrors,
                Response::HTTP_BAD_REQUEST
            ));
        }
        $profile = $this->profileAssembler->updateProfile($profile, $profileDTO);
        $profile->setIsCompleted(true);
        $profile = $this->profileService->update($profile);

        $data = $this->profileAssembler->writeDTO($profile);
        return $this->handleView($this->view($data,Response::HTTP_OK));
    }

    /**
     * @ParamConverter("profile", class="App\Entity\Profile")
     * @Rest\Delete("/profile/delete/{id}", name="profile_delete", requirements={"id"="\d+"})
     * @param Profile $profile
     * @return Response
     */
    public function deleteAction(Profile $profile)
    {
        $this->denyAccessUnlessGranted('edit', $profile);
        $this->profileService->delete($profile);

        return $this->handleView($this->view(null, Response::HTTP_NO_CONTENT));
    }

    /**
     * @Rest\Get("/profile/is-completed", name="profile_is_completed")
     * @return Response
     */
    public function isCompletedAction()
    {
        $data = [
            'id' => $this->getUser()->getProfile()->getId(),
            'userId' => $this->getUser()->getId(),
            'roles' => $this->getUser()->getRoles(),
            'isCompleted' => $this->getUser()->getProfile()->isCompleted(),
        ];

        return $this->handleView($this->view($data,Response::HTTP_OK));
    }
}