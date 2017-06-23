<?php

namespace Kardi\MediaBundle\Entity;

/**
 * Photo
 */
class Photo
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
     * @var string
     */
    private $folder;

    /**
     * @var integer
     */
    private $lft;

    /**
     * @var integer
     */
    private $rgt;

    /**
     * @var integer
     */
    private $lvl;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Kardi\MediaBundle\Entity\Photo
     */
    private $root;

    /**
     * @var \Kardi\MediaBundle\Entity\Photo
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return bool
     */
    public function hasPhoto()
    {
        return (strlen($this->getPhoto()) > 0);
    }

    /**
     * Set folder
     *
     * @param string $folder
     *
     * @return Photo
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     *
     * @return Photo
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return Photo
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Photo
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Add child
     *
     * @param \Kardi\MediaBundle\Entity\Photo $child
     *
     * @return Photo
     */
    public function addChild(\Kardi\MediaBundle\Entity\Photo $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Kardi\MediaBundle\Entity\Photo $child
     */
    public function removeChild(\Kardi\MediaBundle\Entity\Photo $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * @param int|null $limit
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren(?int $limit = null)
    {
        if ($limit && !$this->children->isEmpty()) {
            return $this->children->slice(0, $limit);
        }

        return $this->children;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !$this->getChildren()->isEmpty();
    }
    /**
     * Set root
     *
     * @param \Kardi\MediaBundle\Entity\Photo $root
     *
     * @return Photo
     */
    public function setRoot(\Kardi\MediaBundle\Entity\Photo $root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return \Kardi\MediaBundle\Entity\Photo
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \Kardi\MediaBundle\Entity\Photo $parent
     *
     * @return Photo
     */
    public function setParent(\Kardi\MediaBundle\Entity\Photo $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Kardi\MediaBundle\Entity\Photo
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return \Kardi\MediaBundle\Entity\Photo
     */
    public function getMainPhoto()
    {
        return $this;
    }

    /**
     * @param null|string $size
     * @return string
     */
    public function show(?string $size = null)
    {
        if (strlen($this->getPhoto())) {
//            if (!$size) {
                if ($size) {
                    return sprintf('/photos/%s/%s', $size, $this->getPhoto());
                }

                return '/photos/' . $this->getPhoto();
//            }
        }


//        $types = ['fashion', 'animals', 'sports', 'nightlife', 'cats', 'technics', 'transport'];

        return 'http://placehold.it/' . $size . '?text=Brak+zdjęcia';
    }
}

