<?php

namespace Flowcode\FinancialBundle\Entity\Payment;

use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;

/**
 * Payment
 */
abstract class Payment implements PaymentInterface
{

    const TYPE_INCOME = 'income';
    const TYPE_EXPENSE = 'expense';

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
    protected $paymentDocuments;

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

    public function getMethod(): PaymentMethodInterface
    {
        return $this->method;
    }

    public function setMethod(PaymentMethodInterface $method)
    {
        $this->method = $method;
    }

}
