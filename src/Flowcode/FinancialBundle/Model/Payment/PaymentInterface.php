<?php

namespace Flowcode\FinancialBundle\Model\Payment;

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
}
