<?php

namespace Kardi\NewsletterBundle\Entity;

/**
 * MessageSubscriber
 */
class MessageSubscriber
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $message_id;

    /**
     * @var integer
     */
    private $subscriber_id;

    /**
     * @var boolean
     */
    private $sent;

    /**
     * @var \DateTime
     */
    private $sent_date;

    /**
     * @var \Kardi\NewsletterBundle\Entity\Message
     */
    private $message;

    /**
     * @var \Kardi\NewsletterBundle\Entity\Subscriber
     */
    private $subscriber;


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
     * Set messageId
     *
     * @param integer $messageId
     *
     * @return MessageSubscriber
     */
    public function setMessageId($messageId)
    {
        $this->message_id = $messageId;

        return $this;
    }

    /**
     * Get messageId
     *
     * @return integer
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * Set subscriberId
     *
     * @param integer $subscriberId
     *
     * @return MessageSubscriber
     */
    public function setSubscriberId($subscriberId)
    {
        $this->subscriber_id = $subscriberId;

        return $this;
    }

    /**
     * Get subscriberId
     *
     * @return integer
     */
    public function getSubscriberId()
    {
        return $this->subscriber_id;
    }

    /**
     * Set sent
     *
     * @param boolean $sent
     *
     * @return MessageSubscriber
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return boolean
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set sentDate
     *
     * @param \DateTime $sentDate
     *
     * @return MessageSubscriber
     */
    public function setSentDate($sentDate)
    {
        $this->sent_date = $sentDate;

        return $this;
    }

    /**
     * Get sentDate
     *
     * @return \DateTime
     */
    public function getSentDate()
    {
        return $this->sent_date;
    }

    /**
     * Set message
     *
     * @param \Kardi\NewsletterBundle\Entity\Message $message
     *
     * @return MessageSubscriber
     */
    public function setMessage(\Kardi\NewsletterBundle\Entity\Message $message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \Kardi\NewsletterBundle\Entity\Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set subscriber
     *
     * @param \Kardi\NewsletterBundle\Entity\Subscriber $subscriber
     *
     * @return MessageSubscriber
     */
    public function setSubscriber(\Kardi\NewsletterBundle\Entity\Subscriber $subscriber = null)
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    /**
     * Get subscriber
     *
     * @return \Kardi\NewsletterBundle\Entity\Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }
}
