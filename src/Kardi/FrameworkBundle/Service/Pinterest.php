<?php

namespace Kardi\FrameworkBundle\Service;

class Pinterest extends BaseSocialMedia
{
    protected $_sharerUrl = 'http://pinterest.com/pin/create/button/?url=';

    /**
     * @return null|string
     */
    public function generateShareUrl(): ?string
    {
        parent::setSharerUrl($this->_sharerUrl);
        return parent::generateShareUrl();
    }
}
