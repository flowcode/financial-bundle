<?php

namespace Flowcode\FinancialBundle\Model\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentItemInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
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
    /**
     * Add Payment
     */
    public function addPayment(PaymentInterface $payment);
    /**
     * Remove Payment
     */
    public function removePayment(PaymentInterface $payment);

    /**
     * Get Payments
     */
    public function getPayments();

    public function getTotal();

    public function updateTotalPayed();

    public function updateBalance();
    
    public function getTotalPayed();

    public function setStatus($status);
}
