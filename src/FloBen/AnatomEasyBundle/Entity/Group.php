<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 * @ORM\Entity
 * @ORM\Table(name="`Group`")
 */ 
class Group
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;

    /** 
     * @ORM\ManyToOne(targetEntity="Level", inversedBy="group")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $level;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="teachGroup")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $teacher;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;
     
    /**
     * user
     *  
     * @ORM\OneToMany(targetEntity="User", mappedBy="group")
     */
    protected $student;

    /**
     * To string
     *
     * @return string 
     */
    public function __toString()
    {
        return "[".$this->level."]". $this->name ;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->student = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set level
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Level $level
     * @return Group
     */
    public function setLevel(\FloBen\AnatomEasyBundle\Entity\Level $level = null)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Level 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set teacher
     *
     * @param \FloBen\AnatomEasyBundle\Entity\User $teacher
     * @return Group
     */
    public function setTeacher(\FloBen\AnatomEasyBundle\Entity\User $teacher = null)
    {
        $this->teacher = $teacher;
    
        return $this;
    }

    /**
     * Get teacher
     *
     * @return \FloBen\AnatomEasyBundle\Entity\User 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Add student
     *
     * @param \FloBen\AnatomEasyBundle\Entity\User $student
     * @return Group
     */
    public function addStudent(\FloBen\AnatomEasyBundle\Entity\User $student)
    {
        $this->student[] = $student;
    
        return $this;
    }

    /**
     * Remove student
     *
     * @param \FloBen\AnatomEasyBundle\Entity\User $student
     */
    public function removeStudent(\FloBen\AnatomEasyBundle\Entity\User $student)
    {
        $this->student->removeElement($student);
    }

    /**
     * Get student
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudent()
    {
        return $this->student;
    }
}