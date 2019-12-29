<?php


namespace App\Controller\Api;


use App\Entity\Picture;
use App\Service\PictureService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class PictureController extends AbstractFOSRestController
{
    /**
     * @var PictureService
     */
    private $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    /**
     * @ParamConverter("picture", class="App\Entity\Picture")
     * @Rest\FileParam(name="file", description="Picture", nullable=false, image=true)
     * @Rest\Post("/picture/update/{id}",  name="picture_update", requirements={"id"="\d+"})
     * @param ParamFetcher $paramFetcher
     * @param Picture $picture
     * @return Response
     */
    public function updateAction(ParamFetcher $paramFetcher, Picture $picture)
    {
//        $this->denyAccessUnlessGranted('edit', $picture);
        /** @var UploadedFile $image */
        $file = $paramFetcher->get('file');

        if ($file) {
            $newPicture = $this->pictureService->update($picture, $file);

            $data['picture_path'] = $newPicture->getPath();

            return $this->handleView($this->view($data, Response::HTTP_OK));
        }

        return $this->handleView($this->view([], Response::HTTP_BAD_REQUEST));
    }

    /**
     * @ParamConverter("picture", class="App\Entity\Picture")
     * @Rest\Delete("/picture/delete/{id}", name="picture_delete", requirements={"id"="\d+"})
     * @param Picture $picture
     * @return Response
     */
    public function deleteAction(Picture $picture)
    {
        $this->denyAccessUnlessGranted('edit', $picture);
        $newPicture = $this->pictureService->setDefaultProfile($picture);
        $data['picture_path'] = $newPicture->getPath();

        return $this->handleView($this->view($data, Response::HTTP_OK));
    }
}