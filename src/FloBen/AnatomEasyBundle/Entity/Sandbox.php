<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sandbox
 * @ORM\Entity
 * @ORM\Table(name="Sandbox")
 */ 
class Sandbox
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Exercice
     * @ORM\ManyToOne(targetEntity="Exercice", inversedBy="sandbox")
     * @ORM\JoinColumn(name="exercice_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $exercice;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Result
     * @ORM\ManyToOne(targetEntity="Result", inversedBy="sandbox")
     * @ORM\JoinColumn(name="result_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $result;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="sandbox")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $student;


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