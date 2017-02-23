<?php

namespace Kardi\NewsBundle\Twig;

use BeSimple\I18nRoutingBundle\Routing\Router;

class UrlExtension extends \Twig_Extension
{
    /**
     * @var Router
     */
    private $_router;

    /**
     * UrlExtension constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->_router = $router;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generate_news_url',
                [$this, 'generateNewsUrl']
            ),
        ];
    }

    public function generateNewsUrl($news)
    {
        $category = $news->getCategory();
        $route = $this->_router->generate('kardi_news_show',['categoryslug' => $category->trans('slug'), 'id' => $news->getId(), 'slug' => $news->trans('slug')]);

        return $route;
    }

}
