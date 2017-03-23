<?php

namespace Kardi\AdBundle\Entity;

use Kardi\FrameworkBundle\Entity\Translation;

/**
 * Category
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
    private $ad;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ad = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add ad
     *
     * @param \Kardi\AdBundle\Entity\Ad $ad
     *
     * @return Category
     */
    public function addAd(\Kardi\AdBundle\Entity\Ad $ad)
    {
        $this->ad[] = $ad;

        return $this;
    }

    /**
     * Remove ad
     *
     * @param \Kardi\AdBundle\Entity\Ad $ad
     */
    public function removeAd(\Kardi\AdBundle\Entity\Ad $ad)
    {
        $this->ad->removeElement($ad);
    }

    /**
     * Get ad
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAd()
    {
        return $this->ad;
    }

    /**
     * Add translation
     *
     * @param \Kardi\AdBundle\Entity\CategoryTranslation $translation
     *
     * @return Category
     */
    public function addTranslation(\Kardi\AdBundle\Entity\CategoryTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Kardi\AdBundle\Entity\CategoryTranslation $translation
     */
    public function removeTranslation(\Kardi\AdBundle\Entity\CategoryTranslation $translation)
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
}
