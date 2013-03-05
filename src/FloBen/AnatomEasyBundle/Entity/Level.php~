<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Level
 * @ORM\Entity
 * @ORM\Table(name="`Level`")
 * @ORM\Entity(repositoryClass="FloBen\AnatomEasyBundle\Repository\Level")
 */ 
class Level
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;
     
    /**
     * group
     * 
     * @ORM\OneToMany(targetEntity="Group", mappedBy="level")
     */
    protected $group;
     
    /**
     * exercice
     * 
     * @ORM\OneToMany(targetEntity="Exercice", mappedBy="level")
     */
    protected $exercice;
    
    


    /**
     * tostring
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->id;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exercice = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set id
     *
     * @param string $id
     * @return Level
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Add group
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Group $group
     * @return Level
     */
    public function addGroup(\FloBen\AnatomEasyBundle\Entity\Group $group)
    {
        $this->group[] = $group;
    
        return $this;
    }

    /**
     * Remove group
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Group $group
     */
    public function removeGroup(\FloBen\AnatomEasyBundle\Entity\Group $group)
    {
        $this->group->removeElement($group);
    }

    /**
     * Get group
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add exercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Exercice $exercice
     * @return Level
     */
    public function addExercice(\FloBen\AnatomEasyBundle\Entity\Exercice $exercice)
    {
        $this->exercice[] = $exercice;
    
        return $this;
    }

    /**
     * Remove exercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Exercice $exercice
     */
    public function removeExercice(\FloBen\AnatomEasyBundle\Entity\Exercice $exercice)
    {
        $this->exercice->removeElement($exercice);
    }

    /**
     * Get exercice
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExercice()
    {
        return $this->exercice;
    }
}