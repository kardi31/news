<?php

namespace Kardi\AdBundle\Twig;


use Kardi\AdBundle\Entity\Ad;
use Kardi\AdBundle\Router\AdRouter;

class UrlExtension extends \Twig_Extension
{
    /**
     * @var AdRouter
     */
    private $_adRouter;

    /**
     * UrlExtension constructor.
     * @param AdRouter $adRouter
     */
    public function __construct(AdRouter $adRouter)
    {
        $this->_adRouter = $adRouter;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generate_ad_url',
                [$this, 'generateAdUrl']
            ),
        ];
    }

    /**
     * @param Ad $ad
     * @return mixed
     */
    public function generateAdUrl(Ad $ad)
    {
        return $this->_adRouter->generateAdUrl($ad);
    }

}
