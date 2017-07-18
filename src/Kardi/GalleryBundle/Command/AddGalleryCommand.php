<?php

namespace Kardi\GalleryBundle\Command;

use Kardi\GalleryBundle\Entity\Gallery;

class AddGalleryCommand
{
    /**
     * @var Gallery
     */
    private $gallery;

    public function __construct(Gallery $gallery){

        $this->gallery = $gallery;
    }

    /**
     * @return Gallery
     */
    public function getGallery(): Gallery
    {
        return $this->gallery;
    }
}
