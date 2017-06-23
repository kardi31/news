<?php

namespace Kardi\MediaBundle\Service;

use Doctrine\ORM\EntityManager;
use Kardi\MediaBundle\Entity\Photo as PhotoEntity;

class Photo
{
    /**
     * @var string
     */
    private $photoDir;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager, string $photoDir)
    {
        $this->photoDir = $photoDir;
        $this->entityManager = $entityManager;
    }

    /**
     * @param stream resource $data
     * @param string $filename
     * @return bool
     */
    public function createPhotoFromBase($data, string $filename)
    {
        try {
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);

            $fullFilename = $_SERVER['DOCUMENT_ROOT'] . $filename;

            if (file_exists($fullFilename)) {
                unlink($fullFilename);
            }

            file_put_contents($fullFilename, $data);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @param PhotoEntity $root
     */
    public function deletePhotosByRoot(PhotoEntity $root)
    {
        foreach ($root->getChildren() as $child) {
            $this->deletePhotoByRoot($child);
        }

        $this->deletePhotoByRoot($root);
    }

    /**
     * @param PhotoEntity $photo
     */
    private function deletePhotoByRoot(PhotoEntity $photo)
    {
        $photoPath = $this->photoDir . DIRECTORY_SEPARATOR . $photo->getPhoto();
        if (file_exists($photoPath) && !is_dir($photoPath)) {
            unlink($photoPath);
        }

        $this->entityManager->remove($photo);
    }

}
