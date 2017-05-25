<?php

namespace Kardi\MediaBundle\Twig;

use Kardi\MediaBundle\Service\Photo;

class PhotoExtension extends \Twig_Extension
{
    /**
     * @var Photo
     */
    private $photoService;

    public function __construct(Photo $photoService)
    {
        $this->photoService = $photoService;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('photo_path', [$this, 'getPhotoPath']),
        ];
    }

    public function getPhotoPath($absolute = false)
    {
        return $this->photoService->getPhotoPath($absolute);
    }
}
