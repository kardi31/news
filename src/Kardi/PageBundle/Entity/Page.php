<?php

namespace Kardi\PageBundle\Entity;

use Kardi\FrameworkBundle\Entity\Translation;
/**
 * Page
 */
class Page extends Translation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $photoRootId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \Kardi\MediaBundle\Entity\Photo
     */
    private $photo;

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
     * Set photoRootId
     *
     * @param integer $photoRootId
     *
     * @return Page
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
     * Set type
     *
     * @param string $type
     *
     * @return Page
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return $this
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

        return $this;
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
     * Add translation
     *
     * @param \Kardi\PageBundle\Entity\PageTranslation $translation
     *
     * @return Page
     */
    public function addTranslation(\Kardi\PageBundle\Entity\PageTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Kardi\PageBundle\Entity\PageTranslation $translation
     */
    public function removeTranslation(\Kardi\PageBundle\Entity\PageTranslation $translation)
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
     * Set photo
     *
     * @param \Kardi\MediaBundle\Entity\Photo $photo
     *
     * @return Page
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
     * @param $field
     * @return string
     */
    public function trans($field)
    {
        $this->setTranslations($this->translations);

        return parent::trans($field);
    }
}

