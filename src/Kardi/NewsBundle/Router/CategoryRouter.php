<?php

namespace Kardi\NewsBundle\Router;

use Kardi\NewsBundle\Provider\Route\CategoryRouteProvider;
use Kardi\NewsBundle\Repository\CategoryRepository;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

class CategoryRouter implements RouterInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var CategoryRouteProvider
     */
    private $categoryRouteProvider;

    public function __construct(CategoryRepository $categoryRepository, CategoryRouteProvider $categoryRouteProvider)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryRouteProvider = $categoryRouteProvider;
    }

    /**
     * @param string $pathinfo
     * @return array
     */
    public function match($pathinfo)
    {
        //url should have an identification code as the last part
        $pathParts = array_values(array_filter(explode('/', $pathinfo)));

        if (!in_array($pathParts[0], ['news', 'wiadomosci'])) {
            throw new ResourceNotFoundException();
        }

        $lastPart = end($pathParts);

        $category = $this->categoryRepository->getCategoryBySlug($lastPart);
        if (!$category) {
            throw new ResourceNotFoundException();
        }

        $routeName = $this->categoryRouteProvider->generateCategoryRouteName($category);

        return [
            '_controller' => 'KardiNewsBundle:Default:showCategory',
            '_route' => $routeName,
            'slug' => $category->trans('slug'),
        ];
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        if (substr($name, 0, strlen($this->categoryRouteProvider->getCategoryRouteNamespace())) !== $this->categoryRouteProvider->getCategoryRouteNamespace()) {
            throw new RouteNotFoundException();
        }

        $nameExpl = explode('.', $name);

        $id = end($nameExpl);

        $category = $this->categoryRepository->find($id);
        if (!$category) {
            throw new RouteNotFoundException();
        }

        $url = $this->categoryRouteProvider->generateCategoryUrl($category);

        if ($referenceType == self::ABSOLUTE_URL) {
            $scheme = $this->getContext()->getScheme();
            $port = '';
            if ('http' === $scheme && 80 != $this->getContext()->getHttpPort()) {
                $port = ':'.$this->getContext()->getHttpPort();
            } elseif ('https' === $scheme && 443 != $this->getContext()->getHttpsPort()) {
                $port = ':'.$this->getContext()->getHttpsPort();
            }
            $host = $this->getContext()->getHost();
            $url = sprintf('%s://%s%s%s', $this->forcedScheme ?: $scheme, $host, $port, $url);
        }

        return $url;
    }

    public function getRouteCollection()
    {
        return new RouteCollection();
    }

    public function setContext(RequestContext $context)
    {
        $this->context = $context;
    }

    public function getContext()
    {
        if (null === $this->context) {
            return false;
        }

        return $this->context;
    }
}
