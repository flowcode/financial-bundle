<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\FinanceManagerInterface;

use Flowcode\FinancialBundle\Model\Manager\DocumentManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\PaymentManagerInterface;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Class FinanceService
 */
class FinanceService implements FinanceManagerInterface
{
    private $transactionService;
    private $documentService;
    private $paymentService;
    
    public function __construct(
        TransactionManagerInterface $transactionService,
        DocumentManagerInterface $documentService,
        PaymentManagerInterface $paymentService
    ) {
        $this->transactionService = $transactionService;
        $this->documentService = $documentService;
        $this->paymentService = $paymentService;
    }
    public function createInstantSale(
        DocumentInterface $document,
        IncomeInterface $income,
        PaymentMethodInterface $paymentMethod
    ) {
        $amount = $document->getTotal();
        $transaction = $this->transactionService->createIncomeTrx($income, $paymentMethod, $amount);
        $document->addTransaction($transaction);
        $payment = $this->paymentService->createPayment($paymentMethod, $amount);
        $document->addPayment($payment);
        $this->documentService->updateDocument($document);
        return $document;
    }
    public function createInstantExpense(
        DocumentInterface $document,
        ExpenseInterface $expense,
        PaymentMethodInterface $paymentMethod
    ) {
        $amount = $document->getTotal();
        $transaction = $this->transactionService->createExpenseTrx($expense, $paymentMethod, $amount);
        $document->addTransaction($transaction);
        $payment = $this->paymentService->createPayment($paymentMethod, $amount);
        $document->addPayment($payment);
        $this->documentService->updateDocument($document);
        return $document;
    }
}
