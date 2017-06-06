<?php

namespace Kardi\MediaBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class PrePhotoEditEvent extends Event
{
    /**
     * @var string
     */
    private $paramName;
    /**
     * @var string
     */
    private $pageTitle;

    public function __construct($paramName, $pageTitle)
    {
        $this->paramName = $paramName;
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return string
     */
    public function getParamName(): string
    {
        return $this->paramName;
    }

    /**
     * @param string $paramName
     */
    public function setParamName(string $paramName)
    {
        $this->paramName = $paramName;
    }

    /**
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    /**
     * @param string $pageTitle
     */
    public function setPageTitle(string $pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

}
