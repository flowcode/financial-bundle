<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\FinanceManagerInterface;

use Flowcode\FinancialBundle\Model\Manager\DocumentManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\PaymentManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\PaymentDocumentManagerInterface;
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
        PaymentManagerInterface $paymentService,
        PaymentDocumentManagerInterface $paymentDocumentService
    ) {
        $this->transactionService = $transactionService;
        $this->documentService = $documentService;
        $this->paymentService = $paymentService;
        $this->paymentDocumentService = $paymentDocumentService;
    }
    public function createInstantSale(
        DocumentInterface $document,
        IncomeInterface $income,
        PaymentMethodInterface $paymentMethod
    ) {
        $amount = $document->getTotal();
        $payment = $this->paymentService->createPayment($paymentMethod, $amount);
        $paymentDocument = $this->paymentDocumentService->createPaymentDocumentForPayment($payment, $amount);
        
        $transaction = $this->transactionService->createIncomeTrx($income, $paymentDocument, $amount);
        $document->addTransaction($transaction);
        $document->addPaymentDocument($paymentDocument);
        
        $this->transactionService->updateBalancesByTransaction($transaction);
        $this->documentService->updateDocument($document);
        return $document;
    }
    public function createInstantExpense(
        DocumentInterface $document,
        ExpenseInterface $expense,
        PaymentMethodInterface $paymentMethod
    ) {
        $amount = $document->getTotal();
        $payment = $this->paymentService->createPayment($paymentMethod, $amount);
        $paymentDocument = $this->paymentDocumentService->createPaymentDocumentForPayment($payment, $amount);

        $transaction = $this->transactionService->createExpenseTrx($expense, $paymentDocument, $amount);
        $document->addTransaction($transaction);
        $document->addPaymentDocument($paymentDocument);

        $this->transactionService->updateBalancesByTransaction($transaction);
        $this->documentService->updateDocument($document);
        return $document;
    }
}
