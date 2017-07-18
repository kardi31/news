<?php

namespace Kardi\GalleryBundle\Provider;

use Kardi\GalleryBundle\Repository\CategoryRepository;

class CategoryProvider
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryProvider constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param bool $withEmptyOption
     * @return array
     */
    public function prependCategories($withEmptyOption = true)
    {
        $result = $this->categoryRepository->findAll();

        $categories = [];

        if ($withEmptyOption) {
            $categories[''] = '';
        }

        foreach ($result as $row) {
            $categories[$row->getId()] = $row->trans('title');
        }

        return array_flip($categories);
    }
}
