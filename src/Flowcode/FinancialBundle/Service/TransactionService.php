<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Class TransactionService
 */
class TransactionService implements TransactionManagerInterface
{

    /**
     * @param IncomeInterface $income
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    function createIncomeTrx(IncomeInterface $income, PaymentMethodInterface $paymentMethod, $amount)
    {
        // TODO: Implement createIncomeTrx() method.
    }

    /**
     * @param ExpenseInterface $expense
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    function createExpenseTrx(ExpenseInterface $expense, PaymentMethodInterface $paymentMethod, $amount)
    {
        // TODO: Implement createExpenseTrx() method.
    }
}