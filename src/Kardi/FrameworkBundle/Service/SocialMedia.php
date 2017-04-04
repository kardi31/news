<?php

namespace Kardi\FrameworkBundle\Service;

class SocialMedia
{
    /**
     * @var Facebook
     */
    private $facebookService;
    /**
     * @var Twitter
     */
    private $twitterService;
    /**
     * @var GooglePlus
     */
    private $googlePlusService;
    /**
     * @var Pinterest
     */
    private $pinterestService;
    /**
     * @var Linkedin
     */
    private $linkedinService;

    function __construct(Facebook $facebookService, Twitter $twitterService, GooglePlus $googlePlusService, Pinterest $pinterestService, Linkedin $linkedinService)
    {

        $this->facebookService = $facebookService;
        $this->twitterService = $twitterService;
        $this->googlePlusService = $googlePlusService;
        $this->pinterestService = $pinterestService;
        $this->linkedinService = $linkedinService;
    }

    /**
     * @return Facebook
     */
    public function getFacebook()
    {
        return $this->facebookService;
    }

    /**
     * @return Twitter
     */
    public function getTwitter()
    {
        return $this->twitterService;
    }

    /**
     * @return GooglePlus
     */
    public function getGooglePlus()
    {
        return $this->googlePlusService;
    }

    /**
     * @return Pinterest
     */
    public function getPinterest()
    {
        return $this->pinterestService;
    }

    /**
     * @return Linkedin
     */
    public function getLinkedin()
    {
        return $this->linkedinService;
    }
}
