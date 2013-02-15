<?php

namespace FloBen\AnatomEasyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher 
 * @ORM\Entity
 * @ORM\Table(name="`Teacher`")
 */
class Teacher extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id; 
    
    /**
     * @ORM\OneToMany(targetEntity="Group", mappedBy="teacher")
     */
    protected $group; 
    
    /**
     * Get id
     *
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    
    /**
     * Add group
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Group $group
     * @return Teacher
     */
    public function addGroupe(\FloBen\AnatomEasyBundle\Entity\Group $group)
    {
        $this->group[] = $group;
    
        return $this;
    }

    /**
     * Remove group
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Group $group
     */
    public function removeGroupe(\FloBen\AnatomEasyBundle\Entity\Group $group)
    {
        $this->group->removeElement($group);
    }

    /**
     * Get group
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupe()
    {
        return $this->group;
    }
}
