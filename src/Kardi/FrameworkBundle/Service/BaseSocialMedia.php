<?php

namespace Kardi\FrameworkBundle\Service;

use Kardi\FrameworkBundle\Helper\Url;

abstract class BaseSocialMedia
{
    /**
     * @var Url
     */
    private $_urlHelper;

    /**
     * @var string
     */
    private $_sharerUrl;

    function __construct(Url $urlHelper)
    {
        $this->_urlHelper = $urlHelper;
    }

    /**
     * @return null|string
     */
    public function generateShareUrl(): ?string
    {
        if ($this->getSharerUrl()&&$this->_urlHelper)
            return sprintf('%s%s', $this->getSharerUrl(), $this->_urlHelper->getFullUrl());

        return null;
    }

    /**
     * @return string
     */
    public function getSharerUrl()
    {
        return $this->_sharerUrl;
    }

    /**
     * @param $sharerUrl
     */
    public function setSharerUrl($sharerUrl)
    {
        $this->_sharerUrl = $sharerUrl;
    }
}
