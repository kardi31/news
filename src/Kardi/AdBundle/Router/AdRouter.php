<?php

namespace Kardi\AdBundle\Router;


use Kardi\AdBundle\Entity\Ad;

class AdRouter
{
    /**
     * @var Router
     */
    protected $_router;

    /**
     * NewsRouter constructor.
     * @param Router $router
     */
    public function __construct($router)
    {
        $this->_router = $router;
    }

    /**
     * @param Ad $ad
     * @return string
     */
    public function generateAdUrl(Ad $ad)
    {
        $category = $ad->getCategory();
        $route = $this->_router->generate('kardi_ad_show',['categoryslug' => $category->trans('slug'), 'id' => $ad->getId(), 'slug' => $ad->getSlug()]);

        return $route;
    }
}
