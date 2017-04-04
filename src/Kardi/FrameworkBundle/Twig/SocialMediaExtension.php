<?php

namespace Kardi\FrameworkBundle\Twig;

use Kardi\FrameworkBundle\Service\Facebook;
use Kardi\FrameworkBundle\Service\SocialMedia;

class SocialMediaExtension extends \Twig_Extension
{
    /**
     * @var Facebook
     */
    private $_socialMediaService;

    /**
     * SocialMediaExtension constructor.
     * @param SocialMedia $socialMediaService
     */
    public function __construct(SocialMedia $socialMediaService)
    {
        $this->_socialMediaService = $socialMediaService;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('facebook_share_link',[$this, 'getFacebookShareLink']),
            new \Twig_SimpleFunction('twitter_share_link',[$this, 'getTwitterShareLink']),
            new \Twig_SimpleFunction('google_plus_share_link',[$this, 'getGooglePlusShareLink']),
            new \Twig_SimpleFunction('pinterest_share_link',[$this, 'getPinterestShareLink']),
            new \Twig_SimpleFunction('linkedin_share_link',[$this, 'getLinkedinShareLink']),
        ];
    }

    /**
     * @return string
     */
    public function getFacebookShareLink()
    {
        return $this->_socialMediaService->getFacebook()->generateShareUrl();
    }

    /**
     * @return string
     */
    public function getTwitterShareLink()
    {
        return $this->_socialMediaService->getTwitter()->generateShareUrl();
    }

    /**
     * @return string
     */
    public function getGooglePlusShareLink()
    {
        return $this->_socialMediaService->getGooglePlus()->generateShareUrl();
    }

    /**
     * @return string
     */
    public function getPinterestShareLink()
    {
        return $this->_socialMediaService->getPinterest()->generateShareUrl();
    }

    /**
     * @return string
     */
    public function getLinkedinShareLink()
    {
        return $this->_socialMediaService->getLinkedin()->generateShareUrl();
    }
}
