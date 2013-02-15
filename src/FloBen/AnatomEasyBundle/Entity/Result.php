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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $todoData;
     
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
     * Set todoData
     *
     * @param string $todoData
     * @return Result
     */
    public function setTodoData($todoData)
    {
        $this->todoData = $todoData;
    
        return $this;
    }

    /**
     * Get todoData
     *
     * @return string 
     */
    public function getTodoData()
    {
        return $this->todoData;
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
