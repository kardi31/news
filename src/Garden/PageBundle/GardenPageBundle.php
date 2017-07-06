<?php

namespace Garden\PageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GardenPageBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiPageBundle';
    }
}
