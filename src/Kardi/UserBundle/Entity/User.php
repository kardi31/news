<?php

namespace Kardi\UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{

    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
