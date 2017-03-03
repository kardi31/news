<?php

namespace Kardi\FrameworkBundle\Service;

use Facebook\FacebookRequest;

class Facebook {

    protected $_session;

    function __construct()
    {
        $this->_session = new \Facebook\Facebook([
            'app_id' => '#app_id',
            'app_secret' => '#secret',
            'default_graph_version' => 'v2.8',
        ]);
    }
}
