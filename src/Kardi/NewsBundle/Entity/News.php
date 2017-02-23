<?php

namespace Kardi\NewsBundle\Entity;

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
    private $category_id;

    /**
     * @var boolean
     */
    private $breaking_news = 0;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \Kardi\NewsBundle\Entity\NewsCategory
     */
    private $category;

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
     * Set breakingNews
     *
     * @param boolean $breakingNews
     *
     * @return News
     */
    public function setBreakingNews($breakingNews)
    {
        $this->breaking_news = $breakingNews;

        return $this;
    }

    /**
     * Get breakingNews
     *
     * @return boolean
     */
    public function getBreakingNews()
    {
        return $this->breaking_news;
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
     * @param \Kardi\NewsBundle\Entity\NewsCategory $category
     *
     * @return News
     */
    public function setCategory(\Kardi\NewsBundle\Entity\NewsCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Kardi\NewsBundle\Entity\NewsCategory
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

    public function getUrl()
    {
        return '#';
    }
}

