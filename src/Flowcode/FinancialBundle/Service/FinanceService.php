<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\FinanceManagerInterface;

/**
 * Class FinanceService
 */
class FinanceService implements FinanceManagerInterface
{
    public function __construct()
    {
        
    }
    public function createInstantSale(
        DocumentInterface $document,
        IncomeInterface $income,
        PaymentMethodInterface $paymentMethod
    ) {
        return $document;
    }
}
