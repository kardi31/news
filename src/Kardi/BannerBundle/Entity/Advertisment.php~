<?php

namespace Kardi\AdBundle\Entity;

/**
 * Advertisment
 */
class Advertisment
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
     * @var integer
     */
    private $type_id;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $image;

    /**
     * @var boolean
     */
    private $active = 0;

    /**
     * @var \Kardi\AdBundle\Entity\AdvertismentType
     */
    private $type;


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
     * @return Advertisment
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
     * Set typeId
     *
     * @param integer $typeId
     *
     * @return Advertisment
     */
    public function setTypeId($typeId)
    {
        $this->type_id = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Advertisment
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Advertisment
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Advertisment
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set type
     *
     * @param \Kardi\AdBundle\Entity\AdvertismentType $type
     *
     * @return Advertisment
     */
    public function setType(\Kardi\AdBundle\Entity\AdvertismentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Kardi\AdBundle\Entity\AdvertismentType
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt()
    {
        // Add your code here
    }
}

