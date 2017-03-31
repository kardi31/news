<?php

namespace Kardi\FrameworkBundle\Twig;

use Kardi\FrameworkBundle\Service\Facebook;

class SocialMediaExtension extends \Twig_Extension
{
    /**
     * @var Facebook
     */
    private $_facebookService;

    /**
     * SocialMediaExtension constructor.
     * @param Facebook $facebookService
     */
    public function __construct(Facebook $facebookService)
    {
        $this->_facebookService = $facebookService;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('facebook_share_link',[$this, 'getFacebookShareLink']),
        ];
    }

    public function getFacebookShareLink()
    {
        return $this->_facebookService->generateShareUrl();
    }

}
