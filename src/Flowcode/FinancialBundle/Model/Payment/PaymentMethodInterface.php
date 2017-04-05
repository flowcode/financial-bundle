<?php

namespace Flowcode\FinancialBundle\Model\Payment;

/**
 * Interface Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface
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
