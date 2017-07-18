<?php

namespace Garden\GalleryBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GardenGalleryBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiGalleryBundle';
    }
}
