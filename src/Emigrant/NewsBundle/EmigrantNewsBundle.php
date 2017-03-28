<?php

namespace Emigrant\NewsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EmigrantNewsBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiNewsBundle';
    }
}
