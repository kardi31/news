<?php

namespace Kardi\MediaBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class PrePhotoEditEvent extends Event
{
    /**
     * @var string
     */
    private $paramName;

    public function __construct($paramName)
    {
        $this->paramName = $paramName;
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


}
