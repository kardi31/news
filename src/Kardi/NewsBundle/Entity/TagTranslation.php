<?php

namespace Kardi\NewsBundle\Entity;

/**
 * TagTranslation
 */
class TagTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $tag_id;

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
     * @var \Kardi\NewsBundle\Entity\Tag
     */
    private $tag;


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
     * Set tagId
     *
     * @param integer $tagId
     *
     * @return TagTranslation
     */
    public function setTagId($tagId)
    {
        $this->tag_id = $tagId;

        return $this;
    }

    /**
     * Get tagId
     *
     * @return integer
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return TagTranslation
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
     * @return TagTranslation
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
     * @return TagTranslation
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
     * Set tag
     *
     * @param \Kardi\NewsBundle\Entity\Tag $tag
     *
     * @return TagTranslation
     */
    public function setTag(\Kardi\NewsBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Kardi\NewsBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}
