<?php

namespace Kardi\NewsletterBundle\Entity;

class Group
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $subscriber;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subscriber = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add subscriber
     *
     * @param \Kardi\NewsletterBundle\Entity\Subscriber $subscriber
     *
     * @return Group
     */
    public function addSubscriber(\Kardi\NewsletterBundle\Entity\Subscriber $subscriber)
    {
        $this->subscriber[] = $subscriber;

        return $this;
    }

    /**
     * Remove subscriber
     *
     * @param \Kardi\NewsletterBundle\Entity\Subscriber $subscriber
     */
    public function removeSubscriber(\Kardi\NewsletterBundle\Entity\Subscriber $subscriber)
    {
        $this->subscriber->removeElement($subscriber);
    }

    /**
     * Get subscriber
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }
}
