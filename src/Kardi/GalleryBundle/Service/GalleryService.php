<?php

namespace Kardi\GalleryBundle\Service;

use Kardi\GalleryBundle\Entity\Gallery;
use Kardi\GalleryBundle\Entity\GalleryTranslation;

class GalleryService
{
    /**
     * @var array
     */
    private $languages;

    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return Gallery
     */
    public function createEmptyGalleryWithTranslations()
    {
        $gallery = new Gallery();

        foreach ($this->languages as $language) {
            $translation = new GalleryTranslation();
            $translation->setLang($language);
            $translation->setGallery($gallery);
            $gallery->getTranslations()->add($translation);
        }

        return $gallery;
    }
}
