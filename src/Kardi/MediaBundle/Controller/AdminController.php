<?php

namespace Kardi\MediaBundle\Controller;

use Kardi\FrameworkBundle\Helper\Text;
use Kardi\MediaBundle\Entity\Photo;
use stojg\crop\CropCenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdminController extends Controller
{
    public function editPhotoAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $photoRepository = $em->getRepository('KardiMediaBundle:Photo');
        $photo = $photoRepository->find($id);

        if (!$photo) {
            throw new \Exception('Zdjęcie nie istnieje');
        }

        $returnUrl = $request->getSession()->get('_returnUrl');
        $returnTitle = $request->getSession()->get('_returnTitle');
        $photoSizes = $request->getSession()->get('_photoSizes');

        return $this->render('KardiMediaBundle:Admin:edit_photo.html.twig', ['photoSizes' => $photoSizes, 'photo' => $photo, 'returnTitle' => $returnTitle, 'returnUrl' => $returnUrl]);
    }

    public function cropEditedPhotoAction(Request $request)
    {
        $data = $request->request->get('photo');
        $filename = $request->request->get('filename');

        $result = $this->get('kardi_media.service.photo')->createPhotoFromBase($data, $filename);

        return new JsonResponse([
           'success' => $result
        ]);
    }

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

        if (!is_dir($photoDir)) {
            mkdir($photoDir);
        }

        $newFilename = Text::createUniqueFilename($filename, $photoDir);

        $uploadedFile = $tempDir . '/' . $filename;

        foreach ($photoSizes as $size) {
            $center = new CropCenter($uploadedFile);
            $sizeArray = explode('x', $size);
            $croppedImage = $center->resizeAndCrop($sizeArray[0], $sizeArray[1]);
            $targetDir = sprintf('%s/%s', $photoDir, $size);
            if (!is_dir($targetDir)) {
                mkdir($targetDir);
            }
            $croppedImage->writeImage(sprintf('%s/%s', $targetDir, $newFilename));
        }

        @copy($uploadedFile, sprintf('%s/%s', $photoDir, $newFilename));
        unlink($uploadedFile);

        $rootId = $this->appendPhotoToElement($newFilename, $bundle, $entity, $elementId);

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
        $photos = $mediaPhotoRepository->getChildren($photoRoot, false, null, 'ASC', true);

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
            // if photo is not a root image
            if ($entity->getParent()) {
                $photoRepository->moveDown($entity);
            } // otherwise swap root image with first child
            else {
                if ($children = $entity->getChildren()) {
                    $this->swapChildrenWithParentImage($children->first());

                    $rootId = $children->first()->getParent()->getId();
                }
            }
        } elseif ($direction == 'left') {
            // if photo has previous sibling
            if ($photoRepository->getPrevSiblings($entity)) {
                $photoRepository->moveUp($entity);
            } // otherwise swap photo with root image
            else {
                $this->swapChildrenWithParentImage($entity);
            }
        }

        if (!isset($rootId)) {
            $rootId = $entity->getParent()->getId();
        }

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

        // if we try to remove parent image
        if (!$entity->getParent()) {
            $firstChild = $entity->getChildren()->first();

            $this->swapChildrenWithParentImage($firstChild);

            $entity = $firstChild;
        }

        $rootId = $entity->getParent()->getId();

        $filename = $entity->getPhoto();

        $em->remove($entity);
        $em->flush();

        $fileService = $this->container->get('kardi_media.service.file');
        $fileService->unlinkFile($filename, $this->getParameter('photo_directory'), true);

        return new JSONResponse([
            'success' => 'true',
            'rootId' => $rootId
        ]);
    }

    private function swapChildrenWithParentImage($childNode)
    {
        $parentNode = $childNode->getParent();

        $em = $this->getDoctrine()->getManager();

        $oldParentNode = clone $parentNode;

        $parentNode->setPhoto($childNode->getPhoto());
        $parentNode->setFolder($childNode->getFolder());

        $childNode->setPhoto($oldParentNode->getPhoto());
        $childNode->setFolder($oldParentNode->getFolder());

        $em->persist($parentNode);
        $em->persist($childNode);

        $em->flush();
    }


}
