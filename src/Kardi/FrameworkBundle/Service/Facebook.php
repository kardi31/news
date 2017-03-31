<?php

namespace Kardi\FrameworkBundle\Service;

use Facebook\FacebookRequest;
use Kardi\FrameworkBundle\Helper\Url;

class Facebook
{

    protected $_session;

    /**
     * @var RequestStack
     */
    private $_urlHelper;

    protected $_sharerUrl = 'https://www.facebook.com/sharer/sharer.php?u=';

    function __construct(Url $urlHelper)
    {
        $this->_urlHelper = $urlHelper;

        $this->_session = new \Facebook\Facebook([
            'app_id' => '#app_id',
            'app_secret' => '#secret',
            'default_graph_version' => 'v2.8',
        ]);
    }

    public function generateShareUrl()
    {
        return sprintf('%s%s', $this->_sharerUrl, $this->_urlHelper->getFullUrl());
    }
}
