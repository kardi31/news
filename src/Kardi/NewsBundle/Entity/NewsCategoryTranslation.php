<?php

namespace Kardi\NewsBundle\Entity;

/**
 * NewsCategoryTranslation
 */
class NewsCategoryTranslation
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
     * @var string
     */
    private $lang;

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
    private $content;

    /**
     * @var \Kardi\NewsBundle\Entity\NewsCategory
     */
    private $newsCategory;


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
     * @return NewsCategoryTranslation
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
     * Set lang
     *
     * @param string $lang
     *
     * @return NewsCategoryTranslation
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return NewsCategoryTranslation
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
     * @return NewsCategoryTranslation
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
     * Set content
     *
     * @param string $content
     *
     * @return NewsCategoryTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set newsCategory
     *
     * @param \Kardi\NewsBundle\Entity\NewsCategory $newsCategory
     *
     * @return NewsCategoryTranslation
     */
    public function setNewsCategory(\Kardi\NewsBundle\Entity\NewsCategory $newsCategory = null)
    {
        $this->newsCategory = $newsCategory;

        return $this;
    }

    /**
     * Get newsCategory
     *
     * @return \Kardi\NewsBundle\Entity\NewsCategory
     */
    public function getNewsCategory()
    {
        return $this->newsCategory;
    }
}

