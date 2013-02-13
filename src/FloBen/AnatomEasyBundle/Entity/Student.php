<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 */
class Student
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\User
     */
    private $user;


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
     * Set user
     *
     * @param \FloBen\AnatomEasyBundle\Entity\User $user
     * @return Student
     */
    public function setUser(\FloBen\AnatomEasyBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \FloBen\AnatomEasyBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
