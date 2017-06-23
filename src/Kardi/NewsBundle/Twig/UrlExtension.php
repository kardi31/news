<?php

namespace Kardi\NewsBundle\Twig;

use Kardi\NewsBundle\Entity\News;
use Kardi\NewsBundle\Provider\Route\NewsRouteProvider;

class UrlExtension extends \Twig_Extension
{
    /**
     * @var NewsRouteProvider
     */
    private $newsRouteProvider;

    /**
     * UrlExtension constructor.
     * @param NewsRouteProvider $newsRouteProvider
     */
    public function __construct(NewsRouteProvider $newsRouteProvider)
    {
        $this->newsRouteProvider = $newsRouteProvider;
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
        return $this->newsRouteProvider->generateNewsUrl($news);
    }

}
