<?php

namespace Kardi\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kardi\FrameworkBundle\Entity\Translation;

/**
 * News
 */
class News extends Translation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var boolean
     */
    private $breakingNews = 0;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \Kardi\NewsBundle\Entity\News
     */
    private $category;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var boolean
     */
    private $active = 0;

    private $photoRootId;
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

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return News
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set breakingNews
     *
     * @param boolean $breakingNews
     *
     * @return News
     */
    public function setBreakingNews($breakingNews)
    {
        $this->breakingNews = $breakingNews;

        return $this;
    }

    /**
     * Get breakingNews
     *
     * @return boolean
     */
    public function getBreakingNews()
    {
        return $this->breakingNews;
    }

    /**
     * Add translation
     *
     * @param \Kardi\NewsBundle\Entity\NewsTranslation $translation
     *
     * @return News
     */
    public function addTranslation(\Kardi\NewsBundle\Entity\NewsTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Kardi\NewsBundle\Entity\NewsTranslation $translation
     */
    public function removeTranslation(\Kardi\NewsBundle\Entity\NewsTranslation $translation)
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
     * Set category
     *
     * @param \Kardi\NewsBundle\Entity\Category $category
     *
     * @return News
     */
    public function setCategory(\Kardi\NewsBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Kardi\NewsBundle\Entity\Category
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
     * @var string
     */
    private $photo;

    /**
     * @var \DateTime
     */
    private $publish_date;


//    /**
//     * Set photo
//     *
//     * @param string $photo
//     *
//     * @return News
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
     * @param bool $publishDate
     * @return $this
     */
    public function setPublishDate($publishDate = false)
    {
        if (!$publishDate) {
            $publishDate = $this->getCreatedAt();
        }
        $this->publish_date = $publishDate;

        return $this;
    }

    /**
     * @param bool $object
     * @param string $format
     * @return \DateTime|string
     */
    public function getPublishDate($object = true, $format = 'Y-m-d H:i')
    {
        if ($object) {
            return $this->publish_date;
        }

        return $this->publish_date->format($format);
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
        $this->setPublishDate();
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
     * Set active
     *
     * @param boolean $active
     *
     * @return News
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;


    /**
     * Add comment
     *
     * @param \Kardi\NewsBundle\Entity\Comment $comment
     *
     * @return News
     */
    public function addComment(\Kardi\NewsBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Kardi\NewsBundle\Entity\Comment $comment
     */
    public function removeComment(\Kardi\NewsBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return int
     */
    public function countComments()
    {
        return count($this->getComments());
    }


    /**
     * Set photoRootId
     *
     * @param integer $photoRootId
     *
     * @return News
     */
    public function setPhotoRootId($photoRootId)
    {
        $this->photoRootId = $photoRootId;

        return $this;
    }

    /**
     * Get photoRootId
     *
     * @return integer
     */
    public function getPhotoRootId()
    {
        return $this->photoRootId;
    }

    /**
     * Set photo
     *
     * @param \Kardi\MediaBundle\Entity\Photo $photo
     *
     * @return News
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;


    /**
     * Add tag
     *
     * @param \Kardi\NewsBundle\Entity\Tag $tag
     *
     * @return News
     */
    public function addTag(\Kardi\NewsBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Kardi\NewsBundle\Entity\Tag $tag
     */
    public function removeTag(\Kardi\NewsBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @var string
     */
    private $author;


    /**
     * Set author
     *
     * @param string $author
     *
     * @return News
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
