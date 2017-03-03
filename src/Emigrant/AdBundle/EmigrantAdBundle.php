<?php

namespace Emigrant\AdBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EmigrantAdBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiAdBundle';
    }
}
