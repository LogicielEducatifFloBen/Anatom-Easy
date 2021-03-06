<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 * @ORM\Entity
 * @ORM\Table(name="`Type`")
 */
class Type
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id; 
     
    /**
     * exercice
     * 
     * @ORM\OneToMany(targetEntity="Exercice", mappedBy="type")
     */
    protected $exercice;


    /**
     * tostring
     *
     * @return string 
     */
    public function __toString()
    {
        return  $this->id  ;
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
        $this->exercice = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set id
     *
     * @param string $id
     * @return Type
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Add exercice
     *
     * @param \FloBen\AnatomEasyBundle\Entity\Exercice $exercice
     * @return Type
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