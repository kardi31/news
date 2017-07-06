<?php

namespace Kardi\NewsBundle\Twig;

use Kardi\NewsBundle\Entity\Category;
use Kardi\NewsBundle\Entity\News;
use Kardi\NewsBundle\Provider\Route\CategoryRouteProvider;
use Kardi\NewsBundle\Provider\Route\NewsRouteProvider;

class UrlExtension extends \Twig_Extension
{
    /**
     * @var NewsRouteProvider
     */
    private $newsRouteProvider;
    /**
     * @var CategoryRouteProvider
     */
    private $categoryRouteProvider;

    /**
     * UrlExtension constructor.
     * @param NewsRouteProvider $newsRouteProvider
     * @param CategoryRouteProvider $categoryRouteProvider
     */
    public function __construct(NewsRouteProvider $newsRouteProvider, CategoryRouteProvider $categoryRouteProvider)
    {
        $this->newsRouteProvider = $newsRouteProvider;
        $this->categoryRouteProvider = $categoryRouteProvider;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('generate_news_url',[$this, 'generateNewsUrl']),
            new \Twig_SimpleFunction('generate_category_url',[$this, 'generateCategoryUrl']),
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

    /**
     * @param Category $category
     * @return string
     */
    public function generateCategoryUrl(Category $category)
    {
        return $this->categoryRouteProvider->generateCategoryUrl($category);
    }
}
