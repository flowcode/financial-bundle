<?php

namespace Flowcode\FinancialBundle\Entity\Payment;

use Flowcode\FinancialBundle\Model\Core\AccountInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PaymentMethod
 */
abstract class PaymentMethod implements PaymentMethodInterface
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;
    protected $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PaymentMethod
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
     * @return ArrayCollection<AccountInterface>
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param ArrayCollection<AccountInterface> $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @param AccountInterface $account
     */
    public function addAccount($account)
    {
        $this->accounts->add($account);
    }

}
