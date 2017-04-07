<?php

namespace Flowcode\FinancialBundle\Model\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentItemInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;

/**
 * Interface Flowcode\FinancialBundle\Model\Document\DocumentInterface
 */
interface DocumentInterface
{

    /**
     * Add items
     */
    public function addItem(DocumentItemInterface $items);
    /**
     * Remove items
     */
    public function removeItem(DocumentItemInterface $items);

    /**
     * Get items
     */
    public function getItems();
    /**
     * Add Transaction
     */
    public function addTransaction(TransactionInterface $transaction);
    /**
     * Remove Transaction
     */
    public function removeTransaction(TransactionInterface $transaction);
    /**
     * Get Transactions
     */
    public function getTransactions();
    
    public function addPaymentDocument(PaymentDocumentInterface $payment);
    
    public function removePaymentDocument(PaymentDocumentInterface $payment);
    
    public function getPaymentsDocuments();

    public function getTotal();

    public function updateTotalPayed();

    public function updateBalance();
    
    public function getTotalPayed();

    public function setStatus($status);
}
