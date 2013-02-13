<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomeworkHasExercice
 */
class HomeworkHasExercice
{
    /**
     * @var boolean
     */
    private $done;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Homework
     */
    private $homework;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Exercice
     */
    private $exercice;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Result
     */
    private $result;


    /**
     * Set done
     *
     * @param boolean $done
     * @return HomeworkHasExercice
     */
    public function setDone($done)
    {
        $this->done = $done;
    
        return $this;
    }

    /**
     * Get done
     *
     * @return boolean 
     */
    public function getDone()
    {
        return $this->done;
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
