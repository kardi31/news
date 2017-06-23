<?php

namespace Kardi\NewsBundle\Provider\Route;

use Kardi\NewsBundle\Entity\Category;
use Kardi\NewsBundle\Repository\CategoryRepository;
use Symfony\Component\Translation\Translator;

class CategoryRouteProvider
{
    private $categoryRouteNamespace = 'kardi_news.category';
    /**
     * @var Translator
     */
    private $translator;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(Translator $translator, CategoryRepository $categoryRepository)
    {
        $this->translator = $translator;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Category $category
     * @return string
     */
    public function generateCategoryRouteName(Category $category)
    {
        return sprintf('%s.%s', $this->categoryRouteNamespace, $category->getId());
    }

    /**
     * @param Category $category
     * @return string
     */
    public function generateCategoryUrl(Category $category)
    {
        $urlPrefix = $this->translator->trans('news', [], 'route');

        return sprintf('%s/%s', $urlPrefix, $category->trans('title'));
    }

    /**
     * @return string
     */
    public function getCategoryRouteNamespace(): string
    {
        return $this->categoryRouteNamespace;
    }

    /**
     * @return array
     */
    public function getAllCategoriesForForm(): array
    {
        $categories = $this->categoryRepository->findAll();
        $result = [];

        foreach($categories as $category){
            $routeName = $this->generateCategoryRouteName($category);
            $result[$routeName] = $category->trans('title');
        }
        $result = array_flip($result);

        return $result;
    }
}
