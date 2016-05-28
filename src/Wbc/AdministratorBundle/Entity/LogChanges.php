<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * LogChanges
 */
class LogChanges
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $old;

    /**
     * @var string
     */
    private $new;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Log
     */
    private $log;


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
     * Set old
     *
     * @param string $old
     *
     * @return LogChanges
     */
    public function setOld($old)
    {
        $this->old = $old;

        return $this;
    }

    /**
     * Get old
     *
     * @return string
     */
    public function getOld()
    {
        return $this->old;
    }

    /**
     * Set new
     *
     * @param string $new
     *
     * @return LogChanges
     */
    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }

    /**
     * Get new
     *
     * @return string
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * Set log
     *
     * @param \Wbc\AdministratorBundle\Entity\Log $log
     *
     * @return LogChanges
     */
    public function setLog(\Wbc\AdministratorBundle\Entity\Log $log = null)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Get log
     *
     * @return \Wbc\AdministratorBundle\Entity\Log
     */
    public function getLog()
    {
        return $this->log;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedByValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedByValue()
    {
        // Add your code here
    }
    /**
     * @var string
     */
    private $name;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return LogChanges
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
