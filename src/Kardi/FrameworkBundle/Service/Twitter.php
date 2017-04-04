<?php

namespace Kardi\FrameworkBundle\Service;

class Twitter extends BaseSocialMedia
{
    protected $_sharerUrl = 'https://twitter.com/home?status=';

    /**
     * @return null|string
     */
    public function generateShareUrl(): ?string
    {
        parent::setSharerUrl($this->_sharerUrl);
        return parent::generateShareUrl();
    }
}
