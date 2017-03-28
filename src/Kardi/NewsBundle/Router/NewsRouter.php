<?php

namespace Kardi\NewsBundle\Router;


use BeSimple\I18nRoutingBundle\Routing\Router;
use Kardi\NewsBundle\Entity\News;

class NewsRouter
{
    /**
     * @var Router
     */
    protected $_router;

    /**
     * NewsRouter constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->_router = $router;
    }

    /**
     * @param News $news
     * @return string
     */
    public function generateNewsUrl(News $news)
    {
        $category = $news->getCategory();
        $route = $this->_router->generate('kardi_news_show',['categoryslug' => $category->trans('slug'), 'id' => $news->getId(), 'slug' => $news->trans('slug')]);

        return $route;
    }
}
