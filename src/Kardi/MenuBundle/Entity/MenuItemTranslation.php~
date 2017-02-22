<?php

namespace Kardi\MenuBundle\Entity;

/**
 * MenuItemTranslation
 */
class MenuItemTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $item_id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

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
     * Set itemId
     *
     * @param integer $itemId
     *
     * @return MenuItemTranslation
     */
    public function setItemId($itemId)
    {
        $this->item_id = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return MenuItemTranslation
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
     * @return MenuItemTranslation
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
     * Set menu
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $menuItem
     *
     * @return MenuItemTranslation
     */
    public function setMenuItem(\Kardi\MenuBundle\Entity\MenuItem $menuItem = null)
    {
        $this->menu_item = $menuItem;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Kardi\MenuBundle\Entity\MenuItem
     */
    public function getMenuItem()
    {
        return $this->menu_item;
    }
    /**
     * @var string
     */
    private $lang;

    /**
     * @var \Kardi\MenuBundle\Entity\Translation
     */
    private $menu_item;


    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return MenuItemTranslation
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
}
