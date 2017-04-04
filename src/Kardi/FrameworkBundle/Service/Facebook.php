<?php

namespace Kardi\FrameworkBundle\Service;

use Facebook\FacebookRequest;

class Facebook extends BaseSocialMedia
{
    protected $_session;

    protected $_sharerUrl = 'https://www.facebook.com/sharer/sharer.php?u=';

//    function __construct()
//    {
//        parent::__construct()
//        $this->_session = new \Facebook\Facebook([
//            'app_id' => '#app_id',
//            'app_secret' => '#secret',
//            'default_graph_version' => 'v2.8',
//        ]);
//    }
    /**
     * @return null|string
     */
    public function generateShareUrl(): ?string
    {
        parent::setSharerUrl($this->_sharerUrl);
        return parent::generateShareUrl();
    }
}
