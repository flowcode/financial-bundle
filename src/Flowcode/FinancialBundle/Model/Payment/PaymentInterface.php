<?php

namespace Flowcode\FinancialBundle\Model\Payment;

use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Interface Flowcode\FinancialBundle\Model\Payment\PaymentInterface
 */
interface PaymentInterface
{
    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount();
    public function setAmount($amount);
    public function setMethod(PaymentMethodInterface $method);
}
