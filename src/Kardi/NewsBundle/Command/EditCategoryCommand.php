<?php

namespace Kardi\NewsBundle\Command;

use Kardi\NewsBundle\Entity\Category;

class EditCategoryCommand
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category){

        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }
}
