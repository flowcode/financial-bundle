<?php

namespace Flowcode\FinancialBundle\Model\Payment;

/**
 * Interface PaymentMethodInterface
 */
interface PaymentMethodInterface
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName();
}