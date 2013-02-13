<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homework
 */
class Homework
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $deadline;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Student
     */
    private $student;


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
     * Set deadline
     *
     * @param \DateTime $deadline
     * @return Homework
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    
        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set student
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Student $student
     * @return Homework
     */
    public function setStudent(\FloBen\AnatomEasyBundle\Entity\Student $student = null)
    {
        $this->student = $student;
    
        return $this;
    }

    /**
     * Get student
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }
}
