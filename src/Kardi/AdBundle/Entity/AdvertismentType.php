<?php

namespace Kardi\AdBundle\Entity;

/**
 * AdvertismentType
 */
class AdvertismentType
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
    private $advertisments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advertisments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return AdvertismentType
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
     * @return AdvertismentType
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
     * Add advertisment
     *
     * @param \Kardi\AdBundle\Entity\Advertisment $advertisment
     *
     * @return AdvertismentType
     */
    public function addAdvertisment(\Kardi\AdBundle\Entity\Advertisment $advertisment)
    {
        $this->advertisments[] = $advertisment;

        return $this;
    }

    /**
     * Remove advertisment
     *
     * @param \Kardi\AdBundle\Entity\Advertisment $advertisment
     */
    public function removeAdvertisment(\Kardi\AdBundle\Entity\Advertisment $advertisment)
    {
        $this->advertisments->removeElement($advertisment);
    }

    /**
     * Get advertisments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertisments()
    {
        return $this->advertisments;
    }
}

