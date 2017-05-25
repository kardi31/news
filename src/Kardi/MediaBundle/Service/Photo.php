<?php

namespace Kardi\MediaBundle\Service;


class Photo
{
    private $photoPath;

    public function __construct($photoPath)
    {
        $this->photoPath = $photoPath;
    }

    public function getPhotoPath($absolute = false)
    {
        if ($absolute) {
            return $this->photoPath;
        }

        $realpath = realpath($this->photoPath);

        return substr($realpath, strpos($realpath, 'web') + 3);
    }
}
