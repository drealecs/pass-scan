<?php
namespace Entity;

/**
 * @Entity
 */
class Target {

    /**
     * @Column(type="integer") @Id
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=64)
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
} 
