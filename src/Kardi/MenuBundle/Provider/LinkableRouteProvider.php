<?php

namespace Kardi\MenuBundle\Provider;

use Kardi\NewsBundle\Provider\Route\CategoryRouteProvider;

class LinkableRouteProvider
{

    /**
     * @var Router
     */
    private $router;
    /**
     * @var CategoryRouteProvider
     */
    private $categoryRouteProvider;

    public function __construct($router, CategoryRouteProvider $categoryRouteProvider)
    {
        $this->router = $router;
        $this->categoryRouteProvider = $categoryRouteProvider;
    }

    /**
     * @return array
     */
    public function prepareRoutesForForm(): array
    {
        $result[''] = '';
        $result['Strony'] = $this->getLinkableRoutes();
        $result['Kategorie aktualności'] = $this->categoryRouteProvider->getAllCategoriesForForm();

        return $result;
    }

    /**
     * @return array
     */
    public function getLinkableRoutes(): array
    {
        $routeCollection = $this->router->getRouteCollection();

        $result = [];
        foreach ($routeCollection as $routeName => $route) {
            if ($route->getOption('linkable')) {
                $result[$route->getOption('title')] = $routeName;
            }
        }

        return $result;
    }
}
