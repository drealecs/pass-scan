<?php
namespace Entity;

/** @Entity */
class LoginAttempt {

    /**
     * @Column(type="integer") @Id
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Account", cascade={"all"}, inversedBy="loginAttempts", fetch="LAZY")
     * @var Account
     */
    private $account;

    /**
     * @ManyToOne(targetEntity="Password", cascade={"all"}, fetch="LAZY")
     * @var Password
     */
    private $password;

    /**
     * @Column(type="boolean")
     * @var bool
     */
    private $successful = false;

    public function __construct($account, $password)
    {
        $this->account = $account;
        $this->password = $password;
    }

    public function isSuccessful()
    {
        return $this->successful;
    }

    /**
     * Mark the login attempt as successful
     * @return LoginAttempt
     */
    public function setSuccessful()
    {
        $this->successful = true;
        $this->account->setPassword($this->password);
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
     * @return Password
     */
    public function getPassword()
    {
        return $this->password;
    }

}
