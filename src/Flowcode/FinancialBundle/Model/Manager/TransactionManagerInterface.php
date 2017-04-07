<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;

/**
 * Interface Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface
 */
interface TransactionManagerInterface
{

    /**
     * @param IncomeInterface $income
     * @param PaymentMethodInterface $paymentDocumentInterface
     * @param $amount
     * @return mixed
     */
    public function createIncomeTrx(IncomeInterface $income, PaymentDocumentInterface $paymentDocumentInterface, $amount);

    /**
     * @param ExpenseInterface $expense
     * @param PaymentMethodInterface $paymentDocumentInterface
     * @param $amount
     * @return mixed
     */
    public function createExpenseTrx(ExpenseInterface $expense, PaymentDocumentInterface $paymentDocumentInterface, $amount);
}
