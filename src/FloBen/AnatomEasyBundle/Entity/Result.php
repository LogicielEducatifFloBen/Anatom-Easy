<?php

namespace FloBen\AnatomEasyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 */
class Result
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $todoData;


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
}
