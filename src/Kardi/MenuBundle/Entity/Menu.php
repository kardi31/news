<?php

namespace Kardi\MenuBundle\Entity;

/**
 * Menu
 */
class Menu
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $custom_url;


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
     * Set title
     *
     * @param string $title
     *
     * @return Menu
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Menu
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set customUrl
     *
     * @param string $customUrl
     *
     * @return Menu
     */
    public function setCustomUrl($customUrl)
    {
        $this->custom_url = $customUrl;

        return $this;
    }

    /**
     * Get customUrl
     *
     * @return string
     */
    public function getCustomUrl()
    {
        return $this->custom_url;
    }
    /**
     * @var string
     */
    private $lft;


    /**
     * Set lft
     *
     * @param string $lft
     *
     * @return Menu
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return string
     */
    public function getLft()
    {
        return $this->lft;
    }
}
