<?php

namespace  Kardi\FrameworkBundle\Helper;
use Symfony\Component\HttpFoundation\RequestStack;

class Url
{
    /**
     * @var RequestStack
     */
    protected $_requestStack;

    /**
     * Url constructor.
     * @param RequestStack $requestStack
     */
    function __construct(RequestStack $requestStack)
    {
        $this->_requestStack = $requestStack;
    }

    /**
     * Returns full current url
     * @return string
     */
    public function getFullUrl()
    {
        $request = $this->_requestStack->getCurrentRequest();
        return $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $request->getRequestUri();
    }
}
