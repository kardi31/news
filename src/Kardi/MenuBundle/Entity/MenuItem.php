<?php

namespace Kardi\MenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    private $custom_url;

    /**
     * @var integer
     */
    private $menu_id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \Kardi\MenuBundle\Entity\Menu
     */
    private $menu;

    /**
     * @var string|null
     */
    private $route;

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
     * Add translation
     *
     * @param \Kardi\MenuBundle\Entity\MenuItemTranslation $translation
     *
     * @return MenuItem
     */
    public function addTranslation(\Kardi\MenuBundle\Entity\MenuItemTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Kardi\MenuBundle\Entity\MenuItemTranslation $translation
     */
    public function removeTranslation(\Kardi\MenuBundle\Entity\MenuItemTranslation $translation)
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
     * @return string
     */
    public function getLink()
    {
        $children = $this->getChildren();

        if (count($children) > 0) {
            return 'javascript:void(0)';
        }

        return $this->trans('slug');
    }

    public function trans($field)
    {
        $this->setTranslations($this->translations);

        return parent::trans($field);
    }

    /**
     * @var integer
     */
    private $pos;

    /**
     * @var integer
     */
    private $parent;


    /**
     * Set pos
     *
     * @param integer $pos
     *
     * @return MenuItem
     */
    public function setPos($pos)
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * Get pos
     *
     * @return integer
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     *
     * @return MenuItem
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function hasChildren()
    {
        return !empty($this->getChildren());
    }

    /**
     * @param MenuItem $child
     */
    public function addChild(MenuItem $child)
    {
        if (!$this->children) {
            $this->children = new ArrayCollection();
        }

        $this->children->add($child);
    }

    /**
     * @param ArrayCollection $children
     */
    public function setChildren(ArrayCollection $children)
    {
        $this->children = $children;
    }

    public function sortChildren()
    {
        $children = $this->getChildren();
        if ($children) {
            $children = $children->toArray();
        }

        usort($children, [$this, 'sortByPos']);
        $this->setChildren(new ArrayCollection($children));
    }

    /**
     * @return null|string
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param null|string $route
     */
    public function setRoute(?string $route)
    {
        $this->route = $route;
    }

    private function sortByPos($a, $b)
    {
        return $a->getPos() > $b->getPos() ? 1 : -1;
    }
}
