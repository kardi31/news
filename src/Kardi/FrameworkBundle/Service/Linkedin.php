<?php

namespace Kardi\FrameworkBundle\Service;

class Linkedin extends BaseSocialMedia
{
    protected $_sharerUrl = 'http://www.linkedin.com/shareArticle?mini=true&url=';

    /**
     * @return null|string
     */
    public function generateShareUrl(): ?string
    {
        parent::setSharerUrl($this->_sharerUrl);
        return parent::generateShareUrl();
    }
}
