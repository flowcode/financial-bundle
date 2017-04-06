<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Interface PaymentManagerInterface
 */
interface PaymentManagerInterface
{

    public function createPayment(PaymentMethodInterface $paymentMethod, $amount);
}
