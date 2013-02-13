<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 */
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
     * @var \FloBen\AnatomEasyBundle\Entity\Level
     */
    private $level;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Teacher
     */
    private $teacher;


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
     * @param \FloBen\AnatomEasyBundle\Entity\Teacher $teacher
     * @return Group
     */
    public function setTeacher(\FloBen\AnatomEasyBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;
    
        return $this;
    }

    /**
     * Get teacher
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Teacher 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }
}
