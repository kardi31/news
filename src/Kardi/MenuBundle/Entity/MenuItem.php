<?php

namespace Kardi\MenuBundle\Entity;

use Kardi\FrameworkBundle\Entity\Translation;

/**
 * MenuItem
 */
class MenuItem extends Translation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    protected $translations;

    /**
     * @var string
     */
    private $custom_url;

    /**
     * @var integer
     */
    private $menu_id;

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
     * @var \Kardi\MenuBundle\Entity\MenuItem
     */
    private $root;

    /**
     * @var \Kardi\MenuBundle\Entity\MenuItem
     */
    private $parent;

    /**
     * @var \Kardi\MenuBundle\Entity\Menu
     */
    private $menu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setLink($link)
    {
        $this->link = $customUrl;

        return $this;
    }
    
    /**
     * Set customUrl
     *
     * @param string $customUrl
     *
     * @return MenuItem
     */
    public function setCustomUrl($customUrl)
    {
        $this->custom_url = $customUrl;

        return $this;
    }

    /**
     * Get customUrl
     *
     * @return string
     */
    public function getCustomUrl()
    {
        return $this->custom_url;
    }

    /**
     * Set menuId
     *
     * @param integer $menuId
     *
     * @return MenuItem
     */
    public function setMenuId($menuId)
    {
        $this->menu_id = $menuId;

        return $this;
    }

    /**
     * Get menuId
     *
     * @return integer
     */
    public function getMenuId()
    {
        return $this->menu_id;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     *
     * @return MenuItem
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
     * @return MenuItem
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
     * @return MenuItem
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
     * @param \Kardi\MenuBundle\Entity\MenuItem $child
     *
     * @return MenuItem
     */
    public function addChild(\Kardi\MenuBundle\Entity\MenuItem $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $child
     */
    public function removeChild(\Kardi\MenuBundle\Entity\MenuItem $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set root
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $root
     *
     * @return MenuItem
     */
    public function setRoot(\Kardi\MenuBundle\Entity\MenuItem $root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return \Kardi\MenuBundle\Entity\MenuItem
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $parent
     *
     * @return MenuItem
     */
    public function setParent(\Kardi\MenuBundle\Entity\MenuItem $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Kardi\MenuBundle\Entity\MenuItem
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set menu
     *
     * @param \Kardi\MenuBundle\Entity\Menu $menu
     *
     * @return MenuItem
     */
    public function setMenu(\Kardi\MenuBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Kardi\MenuBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
    
    /**
     * 
     * @param \Kardi\MenuBundle\Entity\MenuItemTranslation $itemTranslation
     * @return \Kardi\MenuBundle\Entity\MenuItem
     */
    public function addTranslation(\Kardi\MenuBundle\Entity\MenuItemTranslation $itemTranslation)
    {
        $this->translations[] = $itemTranslation;

        $this->setTranslations($this->translations);
        
        return $this;
    }

    /**
     * Remove item translation
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $itemTranslation
     */
    public function removeItemTranslation(\Kardi\MenuBundle\Entity\MenuItemTranslation $itemTranslation)
    {
        $this->translations->removeElement($itemTranslation);
        
        $this->setTranslations($this->translations);
    }

    /**
     * Get all item translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
    
    public function getLink()
    {
        $children = $this->getChildren();

        if (count($children) > 0) {
            return 'javascript:void(0)';
        }

        return $this->trans('slug'); //''; //$this->getSlug();
    }
    
    public function getTitle()
    {
        return $this->trans('title');
    }
}
