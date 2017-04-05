<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Interface TransactionManagerInterface
 */
interface TransactionManagerInterface
{

    /**
     * @param IncomeInterface $income
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    public function createIncomeTrx(IncomeInterface $income, PaymentMethodInterface $paymentMethod, $amount);

    /**
     * @param ExpenseInterface $expense
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    public function createExpenseTrx(ExpenseInterface $expense, PaymentMethodInterface $paymentMethod, $amount);
}
