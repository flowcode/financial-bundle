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
use Flowcode\FinancialBundle\Model\Core\AccountInterface;
use Flowcode\FinancialBundle\Entity\Payment\Payment;

/**
 * Class FinanceService
 */
class FinanceService implements FinanceManagerInterface
{

    private $transactionService;
    private $documentService;
    private $paymentService;

    public function __construct(
    TransactionManagerInterface $transactionService, DocumentManagerInterface $documentService, PaymentManagerInterface $paymentService, PaymentDocumentManagerInterface $paymentDocumentService
    )
    {
        $this->transactionService = $transactionService;
        $this->documentService = $documentService;
        $this->paymentService = $paymentService;
        $this->paymentDocumentService = $paymentDocumentService;
    }

    public function createInstantSale(
    DocumentInterface $document, IncomeInterface $income, PaymentMethodInterface $paymentMethod
    )
    {
        $amount = $document->getTotal();
        $payment = $this->paymentService->createPayment($paymentMethod, $amount);
        $payment->setType(Payment::TYPE_INCOME);
        $paymentDocument = $this->paymentDocumentService->createPaymentDocumentForPayment($payment, $amount);
        $currency = $document->getCurrency();
        $transaction = $this->transactionService->createIncomeTrx($income, $currency, $paymentDocument, $amount);
        $document->addTransaction($transaction);
        $document->addPaymentDocument($paymentDocument);

        $this->transactionService->updateBalancesByTransaction($transaction);
        $this->documentService->updateDocument($document);
        return $document;
    }

    public function createSaleOrder(
    DocumentInterface $document, IncomeInterface $income, AccountInterface $clientAccount
    )
    {
        $amount = $document->getTotal();

        $transaction = $this->transactionService->createSaleOrderTrx($income, $clientAccount, $amount);
        $document->addTransaction($transaction);

        $this->transactionService->updateBalancesByTransaction($transaction);
        return $document;
    }

    public function createSaleOrderPayment(
    DocumentInterface $document, AccountInterface $clientAccount, PaymentMethodInterface $paymentMethod, $paymentAmount
    )
    {
        $payment = $this->paymentService->createPayment($paymentMethod, $paymentAmount);
        $paymentDocument = $this->paymentDocumentService->createPaymentDocumentForPayment($payment, $paymentAmount);
        $transaction = $this->transactionService->createSaleOrderPaymentTrx($clientAccount, $paymentDocument, $paymentAmount);
        $document->addTransaction($transaction);
        $document->addPaymentDocument($paymentDocument);

        $this->transactionService->updateBalancesByTransaction($transaction);
        $this->documentService->updateDocument($document);
        return $document;
    }

    public function createInstantExpense(
    DocumentInterface $document, ExpenseInterface $expense, PaymentMethodInterface $paymentMethod
    )
    {
        $amount = $document->getTotal();
        $payment = $this->paymentService->createPayment($paymentMethod, $amount);
        $payment->setType(Payment::TYPE_EXPENSE);
        $paymentDocument = $this->paymentDocumentService->createPaymentDocumentForPayment($payment, $amount);
        $currency = $document->getCurrency();
        $transaction = $this->transactionService->createExpenseTrx($expense, $currency, $paymentDocument, $amount);
        $document->addTransaction($transaction);
        $document->addPaymentDocument($paymentDocument);

        $this->transactionService->updateBalancesByTransaction($transaction);
        $this->documentService->updateDocument($document);
        return $document;
    }

}
