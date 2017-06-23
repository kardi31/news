<?php

namespace Kardi\PageBundle\Command;

use Kardi\PageBundle\Entity\Page;

class DeletePageCommand
{
    /**
     * @var Page
     */
    private $page;

    public function __construct(Page $page){

        $this->page = $page;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }
}
