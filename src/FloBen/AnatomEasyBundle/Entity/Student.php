<?php

namespace FloBen\AnatomEasyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 * @ORM\Entity
 * @ORM\Table(name="`Student`")
 */ 
class Student extends BaseUser
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id; 

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Group
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="student")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $group;
     
    /**
     * homework
     *
     * @ORM\OneToMany(targetEntity="Homework", mappedBy="student")
     */
    protected $homework;
     
    /**
     * sandbox
     *
     * @ORM\OneToMany(targetEntity="Sandbox", mappedBy="student")
     */
    protected $sandbox;


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
     * Set group
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Group $group
     * @return Student
     */
    public function setGroup(\FloBen\AnatomEasyBundle\Entity\Group $group = null)
    {
        $this->group = $group;
    
        return $this;
    }

    /**
     * Get group
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->homework = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sandbox = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add homework
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Homework $homework
     * @return Student
     */
    public function addHomework(\FloBen\AnatomEasyBundle\Entity\Homework $homework)
    {
        $this->homework[] = $homework;
    
        return $this;
    }

    /**
     * Remove homework
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Homework $homework
     */
    public function removeHomework(\FloBen\AnatomEasyBundle\Entity\Homework $homework)
    {
        $this->homework->removeElement($homework);
    }

    /**
     * Get homework
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomework()
    {
        return $this->homework;
    }

    /**
     * Add sandbox
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Sandbox $sandbox
     * @return Student
     */
    public function addSandbox(\FloBen\AnatomEasyBundle\Entity\Sandbox $sandbox)
    {
        $this->sandbox[] = $sandbox;
    
        return $this;
    }

    /**
     * Remove sandbox
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Sandbox $sandbox
     */
    public function removeSandbox(\FloBen\AnatomEasyBundle\Entity\Sandbox $sandbox)
    {
        $this->sandbox->removeElement($sandbox);
    }

    /**
     * Get sandbox
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSandbox()
    {
        return $this->sandbox;
    }
}
