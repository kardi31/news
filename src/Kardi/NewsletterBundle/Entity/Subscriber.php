<?php

namespace Kardi\NewsletterBundle\Entity;

/**
 * Subscriber
 */
class Subscriber
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var boolean
     */
    private $unsubscribed;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var \DateTime
     */
    private $deletedAt;

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
     * Set email
     *
     * @param string $email
     *
     * @return Subscriber
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Subscriber
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Subscriber
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set unsubscribed
     *
     * @param boolean $unsubscribed
     *
     * @return Subscriber
     */
    public function setUnsubscribed($unsubscribed)
    {
        $this->unsubscribed = $unsubscribed;

        return $this;
    }

    /**
     * Get unsubscribed
     *
     * @return boolean
     */
    public function getUnsubscribed()
    {
        return $this->unsubscribed;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Subscriber
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Subscriber
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Add subscriber
     *
     * @param \Kardi\NewsletterBundle\Entity\Subscriber $subscriber
     *
     * @return Subscriber
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
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt()
    {
        // Add your code here
    }
}