<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice;
/**
 * Exercice
 * @ORM\Entity 
 * @ORM\Table(name="`Exercice`")
 */ 
class Exercice
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title; 

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Level
     * @ORM\ManyToOne(targetEntity="Level", inversedBy="exercice")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $level;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Subjects
     * @ORM\ManyToOne(targetEntity="Subjects", inversedBy="exercice")
     * @ORM\JoinColumn(name="subjects_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $subjects;
     
    /**
     * homeworkHasExercice
     * 
     * @ORM\OneToMany(targetEntity="HomeworkHasExercice", mappedBy="exercice")
     */
    protected $homeworkHasExercice;
     
    /**
     * sandbox
     *
     * @ORM\OneToMany(targetEntity="Sandbox", mappedBy="exercice")
     */
    protected $sandbox; 

    /**
     * tostring
     *
     * @return string 
     */
    public function __toString()
    {
        return '[' . $this->level . ']' . $this->subjects . ' : ' . $this->title;
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
     * Set subjects
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Subjects $subjects
     * @return Exercice
     */
    public function setSubjects(\FloBen\AnatomEasyBundle\Entity\Subjects $subjects = null)
    {
        $this->subjects = $subjects;
    
        return $this;
    }

    /**
     * Get subjects
     *
     * @return \FloBen\AnatomEasyBundle\Entity\Subjects 
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Add homeworkHasExercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice $homeworkHasExercice
     * @return Exercice
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
     * @return Exercice
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
