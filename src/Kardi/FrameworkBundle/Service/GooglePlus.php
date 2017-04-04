<?php

namespace Kardi\FrameworkBundle\Service;

class GooglePlus extends BaseSocialMedia
{

    protected $_sharerUrl = 'https://plus.google.com/share?url=';

    /**
     * @return null|string
     */
    public function generateShareUrl(): ?string
    {
        parent::setSharerUrl($this->_sharerUrl);
        return parent::generateShareUrl();
    }
}
