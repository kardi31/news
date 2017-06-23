<?php

namespace Garden\NewsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GardenNewsBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiNewsBundle';
    }
}
