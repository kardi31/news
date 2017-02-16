<?php

namespace Kardi\MenuBundle\Entity;

/**
 * Menu
 * @ORM\Table(name="menu_menu")
 * @ORM\Entity(repositoryClass="KardiMenuBundle|Repository|MenuRepository")
 */
class Menu
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Menu
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
     * Add item
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $item
     *
     * @return Menu
     */
    public function addItem(\Kardi\MenuBundle\Entity\MenuItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \Kardi\MenuBundle\Entity\MenuItem $item
     */
    public function removeItem(\Kardi\MenuBundle\Entity\MenuItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
