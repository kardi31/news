<?php

namespace Kardi\MenuBundle\Command;

use Kardi\MenuBundle\Entity\MenuItem;

class DeleteMenuItemCommand
{
    /**
     * @var MenuItem
     */
    private $menuItem;

    public function __construct(MenuItem $menuItem){

        $this->menuItem = $menuItem;
    }

    /**
     * @return MenuItem
     */
    public function getMenuItem(): MenuItem
    {
        return $this->menuItem;
    }
}
