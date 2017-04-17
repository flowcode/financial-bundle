<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Currency\CurrencyInterface;

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
    public function createIncomeTrx(IncomeInterface $income, CurrencyInterface $currency, PaymentDocumentInterface $paymentDocumentInterface, $amount);

    /**
     * @param ExpenseInterface $expense
     * @param PaymentMethodInterface $paymentDocumentInterface
     * @param $amount
     * @return mixed
     */
    public function createExpenseTrx(ExpenseInterface $expense, CurrencyInterface $currency, PaymentDocumentInterface $paymentDocumentInterface, $amount);
}
