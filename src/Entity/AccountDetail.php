<?php
namespace Entity;

/** @Entity */
class AccountDetail {

    /**
     * @Column(type="integer") @Id
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Account", cascade={"all"}, inversedBy="details", fetch="LAZY")
     * @var Account
     */
    private $account;

    /**
     * @Column(type="string", length=64)
     * @var string
     */
    private $name = false;

    /**
     * @Column(type="string", length=500)
     * @var string
     */
    private $value = false;

    /**
     * @param Account $account
     * @param string $name
     */
    public function __construct($account, $name, $value = null)
    {
        $this->account = $account;
        $this->name = $name;
        if (isset($value)) {
            $this->value = $value;
        }
    }

    /**
     * @param string $value
     * @return AccountDetail
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}
