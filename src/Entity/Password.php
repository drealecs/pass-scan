<?php
namespace Entity;

/**
 * @Entity
 */
class Password {

    /**
     * @Column(type="integer") @Id
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=128)
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }


}
