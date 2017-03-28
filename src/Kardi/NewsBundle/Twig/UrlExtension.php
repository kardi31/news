<?php

namespace Kardi\NewsBundle\Twig;


use Kardi\NewsBundle\Entity\News;
use Kardi\NewsBundle\Router\NewsRouter;

class UrlExtension extends \Twig_Extension
{
    /**
     * @var NewsRouter
     */
    private $_newsRouter;

    /**
     * UrlExtension constructor.
     * @param NewsRouter $newsRouter
     */
    public function __construct(NewsRouter $newsRouter)
    {
        $this->_newsRouter = $newsRouter;
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

    /**
     * @param News $news
     * @return string
     */
    public function generateNewsUrl(News $news)
    {
        return $this->_newsRouter->generateNewsUrl($news);
    }

}
