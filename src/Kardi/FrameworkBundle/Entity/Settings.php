<?php

namespace Kardi\FrameworkBundle\Entity;

/**
 * Settings
 */
class Settings
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $facebook;

    /**
     * @var string
     */
    private $linkedin;

    /**
     * @var string
     */
    private $google_plus;

    /**
     * @var string
     */
    private $twitter;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Settings
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     *
     * @return Settings
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set googlePlus
     *
     * @param string $googlePlus
     *
     * @return Settings
     */
    public function setGooglePlus($googlePlus)
    {
        $this->google_plus = $googlePlus;

        return $this;
    }

    /**
     * Get googlePlus
     *
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->google_plus;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Settings
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @return bool
     */
    public function hasTwitter()
    {
        return strlen($this->twitter)>0?true:false;
    }

    /**
     * @return bool
     */
    public function hasFacebook()
    {
        return strlen($this->facebook)>0?true:false;
    }

    /**
     * @return bool
     */
    public function hasLinkedin()
    {
        return strlen($this->linkedin)>0?true:false;
    }

    /**
     * @return bool
     */
    public function hasGooglePlus()
    {
        return strlen($this->google_plus)>0?true:false;
    }
}
