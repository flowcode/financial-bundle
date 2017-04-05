<?php

namespace Flowcode\FinancialBundle\Model\Payment;

/**
 * Interface PaymentInterface
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