<?php

namespace Kardi\NewsBundle\Entity;

use Kardi\FrameworkBundle\Entity\Translation;

/**
 * Tag
 */
class Tag extends Translation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsList;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->newsList = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add translation
     *
     * @param \Kardi\NewsBundle\Entity\TagTranslation $translation
     *
     * @return Tag
     */
    public function addTranslation(\Kardi\NewsBundle\Entity\TagTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Kardi\NewsBundle\Entity\TagTranslation $translation
     */
    public function removeTranslation(\Kardi\NewsBundle\Entity\TagTranslation $translation)
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
     * Add newsList
     *
     * @param \Kardi\NewsBundle\Entity\News $newsList
     *
     * @return Tag
     */
    public function addNews(\Kardi\NewsBundle\Entity\News $newsList)
    {
        $this->newsList[] = $newsList;

        return $this;
    }

    /**
     * Remove newsList
     *
     * @param \Kardi\NewsBundle\Entity\News $newsList
     */
    public function removeNews(\Kardi\NewsBundle\Entity\News $newsList)
    {
        $this->newsList->removeElement($newsList);
    }

    /**
     * Get newsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->newsList;
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
}
