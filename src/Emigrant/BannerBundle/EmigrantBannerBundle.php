<?php

namespace Emigrant\BannerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EmigrantBannerBundle extends Bundle
{
    public function getParent()
    {
        return 'KardiBannerBundle';
    }
}
