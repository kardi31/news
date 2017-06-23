<?php

namespace Kardi\AdminBundle\Twig;

use Kardi\AdminBundle\Helper\Datatable;

class DatatableExtension extends \Twig_Extension
{
    /**
     * @var Datatable
     */
    private $datatableHelper;

    /**
     * DatatableExtension constructor.
     * @param Datatable $datatableHelper
     */
    public function __construct(Datatable $datatableHelper)
    {
        $this->datatableHelper = $datatableHelper;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('display_datatable_link',[$this, 'displayDatatableLink']),
            new \Twig_SimpleFunction('display_datatable_toggle',[$this, 'displayDatatableToggle']),
        ];
    }

    /**
     * @param string $route
     * @param int $id
     * @param string $icon
     * @param null|string $class
     * @return string
     */
    public function displayDatatableLink(string $route, int $id, string $icon, ?string $class = null)
    {
        return $this->datatableHelper->displayLink($route, $id, $icon, $class);
    }

    /**
     * @param bool $fieldValue
     * @param string $route
     * @param int $id
     * @return string
     */
    public function displayDatatableToggle(bool $fieldValue, string $route, int $id)
    {
        return $this->datatableHelper->displayToggle($fieldValue, $route, $id);
    }
}
