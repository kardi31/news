<?php

namespace Kardi\AdminBundle\Helper;

class Datatable
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * @param bool $fieldValue
     * @param string $route
     * @param int $id
     * @return string
     */
    public function displayToggle(bool $fieldValue, string $route, int $id): string
    {
        if ($fieldValue) {
            $icon = '<i class="fa fa-check-square-o"></i>';
        } else {
            $icon = '<i class="fa fa-square-o"></i>';
        }

        $toggleUrl = $this->router->generate($route, ['id' => $id]);

        return sprintf('<a href="%s">%s</a>', $toggleUrl, $icon);
    }
}
