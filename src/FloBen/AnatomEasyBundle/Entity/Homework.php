<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homework
 * @ORM\Entity
 * @ORM\Table(name="`Homework`")
 */ 
class Homework
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
    protected $deadline;

    /**
     * @var \FloBen\AnatomEasyBundle\Entity\Student
     * @ORM\ManyToOne(targetEntity="User", inversedBy="homework")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="Set Null")
     */
    protected $student;
     
    /**
     * homeworkHasExercice
     * 
     * @ORM\OneToMany(targetEntity="HomeworkHasExercice", mappedBy="homework")
     */
    protected $homeworkHasExercice;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->homeworkHasExercice = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \FloBen\AnatomEasyBundle\Entity\User $student
     * @return Homework
     */
    public function setStudent(\FloBen\AnatomEasyBundle\Entity\User $student = null)
    {
        $this->student = $student;
    
        return $this;
    }

    /**
     * Get student
     *
     * @return \FloBen\AnatomEasyBundle\Entity\User 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Add homeworkHasExercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice $homeworkHasExercice
     * @return Homework
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
}