<?php

namespace Kardi\NewsBundle\Entity;

use Kardi\FrameworkBundle\Entity\Translation;

/**
 * Class Category
 * @package Kardi\NewsBundle\Entity
 */
class Category extends Translation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $news;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var boolean
     */
    private $active = 1;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param News $news
     * @return $this
     */
    public function addNews(\Kardi\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Kardi\NewsBundle\Entity\News $news
     */
    public function removeNews(\Kardi\NewsBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param CategoryTranslation $translation
     * @return $this
     */
    public function addTranslation(\Kardi\NewsBundle\Entity\CategoryTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * @param CategoryTranslation $translation
     */
    public function removeTranslation(\Kardi\NewsBundle\Entity\CategoryTranslation $translation)
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
     * @param $field
     * @return string
     */
    public function trans($field)
    {
        // keep it to make sure translations are set
        if (!$this->translations) {
            $this->getTranslations();
        }

        $this->setTranslations($this->translations);

        return parent::trans($field);
    }


    /**
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }
}
