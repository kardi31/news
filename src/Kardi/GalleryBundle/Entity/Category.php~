<?php

namespace Kardi\GalleryBundle\Entity;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $gallery;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gallery = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add gallery
     *
     * @param \Kardi\GalleryBundle\Entity\Gallery $gallery
     *
     * @return Category
     */
    public function addGallery(\Kardi\GalleryBundle\Entity\Gallery $gallery)
    {
        $this->gallery[] = $gallery;

        return $this;
    }

    /**
     * Remove gallery
     *
     * @param \Kardi\GalleryBundle\Entity\Gallery $gallery
     */
    public function removeGallery(\Kardi\GalleryBundle\Entity\Gallery $gallery)
    {
        $this->gallery->removeElement($gallery);
    }

    /**
     * Get gallery
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Add translation
     *
     * @param \Kardi\GalleryBundle\Entity\GalleryTranslation $translation
     *
     * @return Category
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
}
