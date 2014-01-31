<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @Entity
 */
class Account {

    /**
     * @Column(type="integer") @Id
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Target", cascade={"all"}, fetch="LAZY")
     * @var Target
     */
    private $target;

    /**
     * @Column(type="string", length=128)
     * @var string
     */
    private $loginName;

    /**
     * @OneToMany(targetEntity="LoginAttempt", cascade={"all"}, orphanRemoval=true, mappedBy="account", fetch="EXTRA_LAZY")
     * @var LoginAttempt[]
     */
    private $loginAttempts;

    /**
     * @OneToMany(targetEntity="AccountDetail", cascade={"all"}, orphanRemoval=true, mappedBy="account", fetch="EXTRA_LAZY")
     * @var AccountDetail[]
     */
    private $details;

    /**
     * @OneToOne(targetEntity="Password")
     * @var Password
     */
    private $password;

    /**
     * @param Target $target
     * @param string $loginName
     */
    public function __construct($target, $loginName)
    {
        $this->target = $target;
        $this->loginName = $loginName;
        $this->loginAttempts = new ArrayCollection();
        $this->details = new ArrayCollection();
    }

    public function getLoginAttempts()
    {
        return $this->loginAttempts;
    }

    /**
     * @param Password $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return Password
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function addDetail($name, $value)
    {
        $this->details[] = new AccountDetail($this, $name, $value);
    }

    public function getDetail($name)
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('name', $name))->setMaxResults(1);
        $details = $this->details->matching($criteria);

        if (count($details) > 0) {
            return $details->first()->getValue();
        }

        return null;
    }
}
