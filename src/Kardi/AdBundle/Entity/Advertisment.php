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
        if(strpos($this->website, 'http://') !== 0) {
            return 'http://' . $this->website;
        } else {
            return $this->website;
        }
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
    public function getImage($size)
    {
        if (!$size) {
            return 'http://placehold.it/800x600?text+ad+'.$size;
        }

        return 'http://placehold.it/'.$size.'?text+ad+'.$size;
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
     * Set createdAt
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
