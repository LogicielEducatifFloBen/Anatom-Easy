<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 * @ORM\Entity
 * @ORM\Table(name="`Result`")
 */ 
class Result
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="boolean");
     */
    protected $success;


    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $score;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $secondSpent;
     
    /**
     * homeworkHasExercice
     * 
     * @ORM\OneToMany(targetEntity="HomeworkHasExercice", mappedBy="result")
     */
    protected $homeworkHasExercice;
     
    /**
     * sandbox
     *
     * @ORM\OneToMany(targetEntity="Sandbox", mappedBy="result")
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
     * tostring
     *
     * @return string 
     */
    public function __toString()
    {
        $s="réussi";
        if($this->success){
            $s="perdu";
        }
        return  ' le [ '  . $this->date->format('d/m/Y')  . ' ]  ' .$s .'. score = '. $this->score   .'. temps ecoule = ' .$this->secondSpent ;
    }  
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->homeworkHasExercice = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sandbox = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Result
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
     * Set success
     *
     * @param boolean $success
     * @return Result
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    
        return $this;
    }

    /**
     * Get success
     *
     * @return boolean 
     */
    public function getSuccess()
    {
        return $this->success;
    }
    
    /**
     * Set score
     *
     * @param \integer $score
     * @return Result
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return \integer 
     */
    public function getScore()
    {
        return $this->score;
    } 

    /**
     * Set secondSpent
     *
     * @param \integer $secondSpent
     * @return Result
     */
    public function setSecondSpent($secondSpent)
    {
        $this->secondSpent = $secondSpent;
    
        return $this;
    }

    /**
     * Get secondSpent
     *
     * @return \integer 
     */
    public function getSecondSpent()
    {
        return $this->secondSpent;
    } 

    /**
     * Add homeworkHasExercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice $homeworkHasExercice
     * @return Result
     */
    public function addHomeworkHasExercice(\FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice $homeworkHasExercice)
    {
        $this->homeworkHasExercice[] = $homeworkHasExercice;
    
        return $this;
    }

    /**
     * Remove homeworkHasExercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice $homeworkHasExercice
     */
    public function removeHomeworkHasExercice(\FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice $homeworkHasExercice)
    {
        $this->homeworkHasExercice->removeElement($homeworkHasExercice);
    }

    /**
     * Get homeworkHasExercice
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeworkHasExercice()
    {
        return $this->homeworkHasExercice;
    }

    /**
     * Add sandbox
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Sandbox $sandbox
     * @return Result
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
