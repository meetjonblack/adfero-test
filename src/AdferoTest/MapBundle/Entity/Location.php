<?php
namespace AdferoTest\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
     * @ORM\Entity
     * @ORM\Table(name="location")
     */
    class Location
    {

        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ORM\Column(type="float")
         */
        protected $xcoordinate;

        /**
         * @ORM\Column(type="float")
         */
        protected $ycoordinate;

        /**
         * @ORM\Column(type="string", length=100)
         */
        protected $name;

        /**
         * @ORM\Column(type="string", length=100)
         */
        protected $description;
    
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
     * Set xcoordinate
     *
     * @param float $xcoordinate
     * @return Location
     */
    public function setXcoordinate($xcoordinate)
    {
        $this->xcoordinate = $xcoordinate;
    
        return $this;
    }

    /**
     * Get xcoordinate
     *
     * @return float 
     */
    public function getXcoordinate()
    {
        return $this->xcoordinate;
    }

    /**
     * Set ycoordinate
     *
     * @param float $ycoordinate
     * @return Location
     */
    public function setYcoordinate($ycoordinate)
    {
        $this->ycoordinate = $ycoordinate;
    
        return $this;
    }

    /**
     * Get ycoordinate
     *
     * @return float 
     */
    public function getYcoordinate()
    {
        return $this->ycoordinate;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Location
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

    /**
     * Set description
     *
     * @param string $description
     * @return Location
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}