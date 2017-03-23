<?php

namespace Kardi\BannerBundle\Entity;

/**
 * Banner
 */
class Banner
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
     * @var \Kardi\BannerBundle\Entity\Banner
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
     * @return Banner
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
     * @return Banner
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
     * @return Banner
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
     * @return Banner
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
     * @return Banner
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
     * @param \Kardi\BannerBundle\Entity\BannerType $type
     *
     * @return Banner
     */
    public function setType(\Kardi\BannerBundle\Entity\BannerType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \Kardi\BannerBundle\Entity\Banner
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
