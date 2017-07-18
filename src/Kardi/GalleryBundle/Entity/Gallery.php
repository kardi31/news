<?php

namespace Kardi\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kardi\FrameworkBundle\Entity\Translation;

class Gallery extends Translation
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var \DateTime
     */
    private $publish_date;

    /**
     * @var boolean
     */
    private $active = true;

    /**
     * @var boolean
     */
    private $featured = 0;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    protected $photo_root_id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
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

//    /**
//     * Set photo
//     *
//     * @param string $photo
//     *
//     * @return Gallery
//     */
//    public function setPhoto($photo)
//    {
//        $this->photo = $photo;
//
//        return $this;
//    }
//
//    /**
//     * Get photo
//     *
//     * @return string
//     */
//    public function getPhoto($size = false)
//    {
//        if (!$size) {
//            return 'http://lorempixel.com/800/600/fashion';
//        }
//        $size = str_replace('x', '/', $size);
//
//        return 'http://lorempixel.com/'.$size.'/fashion';
////        return $this->photo;
//    }

    /**
     * Set publishDate
     *
     * @param \DateTime $publishDate
     *
     * @return Gallery
     */
    public function setPublishDate($publishDate)
    {
        $this->publish_date = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime
     */
    public function getPublishDate()
    {
        return $this->publish_date;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Gallery
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
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Gallery
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Add translation
     *
     * @param \Kardi\GalleryBundle\Entity\GalleryTranslation $translation
     *
     * @return Gallery
     */
    public function addTranslation(\Kardi\GalleryBundle\Entity\GalleryTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Kardi\GalleryBundle\Entity\GalleryTranslation $translation
     */
    public function removeTranslation(\Kardi\GalleryBundle\Entity\GalleryTranslation $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
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
        $this->setPublishDate(new \DateTime());
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
    /**
     * @var integer
     */
    private $category_id;


    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Gallery
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }
    /**
     * @var \Kardi\GalleryBundle\Entity\Category
     */
    private $category;


    /**
     * Set category
     *
     * @param \Kardi\GalleryBundle\Entity\Category $category
     *
     * @return Gallery
     */
    public function setCategory(\Kardi\GalleryBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Kardi\GalleryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $field
     * @return string
     */
    public function trans($field)
    {
        $this->setTranslations($this->translations);

        return parent::trans($field);
    }

    /**
     * Set photoRootId
     *
     * @param integer $photoRootId
     *
     * @return Gallery
     */
    public function setPhotoRootId($photoRootId)
    {
        $this->photo_root_id = $photoRootId;

        return $this;
    }

    /**
     * Get photoRootId
     *
     * @return integer
     */
    public function getPhotoRootId()
    {
        return $this->photo_root_id;
    }

    /**
     * Set photo
     *
     * @param \Kardi\MediaBundle\Entity\Photo $photo
     *
     * @return Gallery
     */
    public function setPhoto(\Kardi\MediaBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Kardi\MediaBundle\Entity\Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
