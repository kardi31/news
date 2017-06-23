<?php

namespace Kardi\NewsBundle\Service;

use Kardi\NewsBundle\Entity\Category;
use Kardi\NewsBundle\Entity\CategoryTranslation;

class CategoryService
{
    /**
     * @var array
     */
    private $languages;

    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return Category
     */
    public function createEmptyCategoryWithTranslations()
    {
        $category = new Category();

        foreach ($this->languages as $language) {
            $translation = new CategoryTranslation();
            $translation->setLang($language);
            $translation->setCategory($category);
            $category->getTranslations()->add($translation);
        }

        return $category;
    }
}
