<?php

namespace Kardi\BannerBundle\Entity;

/**
 * BannerType
 */
class BannerType
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
    private $size;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $banners;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->banners = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return BannerType
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
     * Set size
     *
     * @param string $size
     *
     * @return BannerType
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Add banner
     *
     * @param \Kardi\BannerBundle\Entity\BannerType $banner
     *
     * @return BannerType
     */
    public function addBanner(\Kardi\BannerBundle\Entity\Banner $banner)
    {
        $this->banners[] = $banner;

        return $this;
    }

    /**
     * Remove advertisment
     *
     * @param \Kardi\BannerBundle\Entity\Banner $banner
     */
    public function removeBanner(\Kardi\BannerBundle\Entity\Banner $banner)
    {
        $this->banners->removeElement($banner);
    }

    /**
     * Get advertisments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBanners()
    {
        return $this->banners;
    }
}
