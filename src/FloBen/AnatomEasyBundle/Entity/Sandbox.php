<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sandbox
 */
class Sandbox
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Exercice
     */
    private $exercice;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Result
     */
    private $result;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Sandbox
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set exercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Exercice $exercice
     * @return Sandbox
     */
    public function setExercice(\FloBen\AnatomEasyBundle\Entity\Exercice $exercice = null)
    {
        $this->exercice = $exercice;
    
        return $this;
    }

    /**
     * Get exercice
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Exercice 
     */
    public function getExercice()
    {
        return $this->exercice;
    }

    /**
     * Set result
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Result $result
     * @return Sandbox
     */
    public function setResult(\FloBen\AnatomEasyBundle\Entity\Result $result = null)
    {
        $this->result = $result;
    
        return $this;
    }

    /**
     * Get result
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Result 
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set student
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Student $student
     * @return Sandbox
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
