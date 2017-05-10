<?php

namespace Kardi\MediaBundle\Controller;

use Kardi\MediaBundle\Entity\Photo;
use stojg\crop\CropCenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdminController extends Controller
{
    public function uploadAction(Request $request)
    {
        if ($request->isXmlHttpRequest() && !$request->isMethod('POST')) {
            throw new HttpException('XMLHttpRequests/AJAX calls must be POSTed');
        }

        $request->request->all();

        $file = $request->files->get('file');

        $fileName = $file->getClientOriginalName();

        // Move the file to the directory where brochures are stored
        $file->move(
            $this->getParameter('photo_temp_directory'),
            $fileName
        );

        return new JsonResponse([
            'result' => 'OK',
            'filename' => $fileName
        ]);
    }


    public function uploadPhotoAction(Request $request)
    {
        $filename = $request->request->get('filename');
        $bundle = $request->request->get('bundle');
        $entity = $request->request->get('entity');
        $elementId = $request->request->get('id');

        $photoParams = $this->getParameter('photo');

        $paramName = strtolower(sprintf('%s_%s', $bundle, $entity));
        $photoSizes = $photoParams[$paramName];

        $tempDir = $this->getParameter('photo_temp_directory');
        $photoDir = $this->getParameter('photo_directory');

        $uploadedFile = $tempDir . '/' . $filename;

        if (!is_dir($photoDir)) {
            mkdir($photoDir);
        }

        foreach ($photoSizes as $size) {

            $center = new CropCenter($uploadedFile);
            $sizeArray = explode('x', $size);
            $croppedImage = $center->resizeAndCrop($sizeArray[0], $sizeArray[1]);
            $targetDir = sprintf('%s/%s', $photoDir, $size);
            if (!is_dir($targetDir)) {
                mkdir($targetDir);
            }
            $croppedImage->writeImage(sprintf('%s/%s', $targetDir, $filename));
        }

        @copy($uploadedFile, sprintf('%s/%s', $photoDir, $filename));
        unlink($uploadedFile);

        $rootId = $this->appendPhotoToElement($filename, $bundle, $entity, $elementId);

        return new JSONResponse([
            'success' => 'true',
            'filename' => $filename,
            'rootId' => $rootId
        ]);
    }

    /**
     * @param $filename
     * @param $bundle
     * @param $entity
     * @param null $id
     * @return bool|\Doctrine\Common\Collections\Collection
     */
    private function appendPhotoToElement($filename, $bundle, $entity, $id = null)
    {
        $repositoryName = sprintf('%s:%s', $bundle, $entity);

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository($repositoryName);
        if (!$repo) {
            return false;
        }

        $entity = $repo->find($id);
        if (!$entity) {
            return false;
        }

        $photoRoot = $entity->getPhoto();

        $photo = new Photo();
        $photo->setPhoto($filename);

        $treeRepository = $em->getRepository('KardiMediaBundle:Photo');
        $treeRepository->persistAsLastChildOf($photo, $photoRoot);

        $em->persist($photo);
        $em->flush();

        return $photoRoot->getId();
    }

    public function refreshPhotoListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $photoRepository = $em->getRepository('KardiMediaBundle:Photo');

        if ($request->isMethod('POST')) {
            $rootId = $request->request->get('rootId');
        } else {
            $rootId = $request->get('rootId');
        }

        $photoRoot = $photoRepository->find($rootId);

        $mediaPhotoRepository = $em->getRepository('KardiMediaBundle:Photo');
        $photos = $mediaPhotoRepository->getChildren($photoRoot,false, null, 'ASC', true);

        return $this->render('KardiMediaBundle:Admin:photo_list.html.twig', ['photos' => $photos]);
    }

    public function movePhotoAction(Request $request)
    {
        $direction = $request->request->get('direction');
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $photoRepository = $em->getRepository('KardiMediaBundle:Photo');
        $entity = $photoRepository->find($id);
        if (!$entity) {
            return false;
        }

        if ($direction == 'right') {
            $photoRepository->moveDown($entity);
        } elseif ($direction == 'left') {
            $photoRepository->moveUp($entity);
        }

        $rootId = $entity->getParent()->getId();

        return new JSONResponse([
            'success' => 'true',
            'rootId' => $rootId
        ]);
    }

    public function removePhotoAction(Request $request)
    {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $photoRepository = $em->getRepository('KardiMediaBundle:Photo');
        $entity = $photoRepository->find($id);
        if (!$entity) {
            return false;
        }

        $rootId = $entity->getParent()->getId();

        $em->remove($entity);
        $em->flush();

        return new JSONResponse([
            'success' => 'true',
            'rootId' => $rootId
        ]);
    }
}
