<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;

/**
 * Interface PaymentDocumentManagerInterface
 */
interface PaymentDocumentManagerInterface
{

    public function createPaymentDocumentForPayment(
        PaymentInterface $payment,
        $amount
    );
}
