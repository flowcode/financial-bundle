<?php

namespace Flowcode\FinancialBundle\Entity\Payment;

use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;

/**
 * Payment
 */
abstract class Payment implements PaymentInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var PaymentMethodInterface
     */
    protected $method;

    /**
     * @var float
     */
    protected $amount;


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
     * Set type
     *
     * @param string $type
     *
     * @return Payment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return PaymentMethodInterface
     */
    public function getAccount(): PaymentMethodInterface
    {
        return $this->account;
    }

    /**
     * @param PaymentMethodInterface $account
     */
    public function setAccount(PaymentMethodInterface $account)
    {
        $this->account = $account;
    }
}
