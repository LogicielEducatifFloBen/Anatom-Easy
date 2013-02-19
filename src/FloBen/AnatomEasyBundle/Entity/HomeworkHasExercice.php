<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FloBen\AnatomEasyBundle\Entity\Exercice;

/**
 * HomeworkHasExercice
 * @ORM\Entity
 * @ORM\Table(name="`HomeworkHasExercice`")
 */
class HomeworkHasExercice
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;

    /**
     * @var boolean
     */
    protected $done;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Exercice
     * @ORM\ManyToOne(targetEntity="Exercice", inversedBy="homeworkHasExercice" )
     * @ORM\JoinColumn(name="exercice_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $exercice;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Homework
     * @ORM\ManyToOne(targetEntity="Homework", inversedBy="homeworkHasExercice" )
     * @ORM\JoinColumn(name="homework_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $homework;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Result
     * @ORM\ManyToOne(targetEntity="Result", inversedBy="homeworkHasExercice")
     * @ORM\JoinColumn(name="result_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $result;

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
     * Set exercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Exercice $exercice
     * @return HomeworkHasExercice
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
     * Set homework
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Homework $homework
     * @return HomeworkHasExercice
     */
    public function setHomework(\FloBen\AnatomEasyBundle\Entity\Homework $homework = null)
    {
        $this->homework = $homework;
    
        return $this;
    }

    /**
     * Get homework
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Homework 
     */
    public function getHomework()
    {
        return $this->homework;
    }

    /**
     * Set result
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Result $result
     * @return HomeworkHasExercice
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
}
