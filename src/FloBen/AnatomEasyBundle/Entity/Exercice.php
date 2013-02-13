<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 */
class Exercice
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Level
     */
    private $level;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Subjects
     */
    private $subjectsSubjectscol;


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
     * Set title
     *
     * @param string $title
     * @return Exercice
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Exercice
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set level
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Level $level
     * @return Exercice
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
     * Set subjectsSubjectscol
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Subjects $subjectsSubjectscol
     * @return Exercice
     */
    public function setSubjectsSubjectscol(\FloBen\AnatomEasyBundle\Entity\Subjects $subjectsSubjectscol = null)
    {
        $this->subjectsSubjectscol = $subjectsSubjectscol;
    
        return $this;
    }

    /**
     * Get subjectsSubjectscol
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Subjects 
     */
    public function getSubjectsSubjectscol()
    {
        return $this->subjectsSubjectscol;
    }
}
