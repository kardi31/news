<?php

namespace Garden\MenuBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GardenMenuBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiMenuBundle';
    }
}
