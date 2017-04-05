<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Interface FinanceManagerInterface
 */
interface FinanceManagerInterface
{
    public function createInstantSale(
        DocumentInterface $document,
        IncomeInterface $income,
        PaymentMethodInterface $paymentMethod
    );
}
