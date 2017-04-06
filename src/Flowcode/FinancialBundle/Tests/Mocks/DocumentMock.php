<?php
namespace Flowcode\FinancialBundle\Tests\Mocks;

use Flowcode\FinancialBundle\Entity\Document\Document as BaseDocument;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Flowcode\FinancialBundle\Model\Document\DocumentItemInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Flowcode\FinancialBundle\Tests\Mocks\DocumentMock
 */
class DocumentMock extends BaseDocument implements DocumentInterface
{
    public function __construct(){
        $this->items = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }
    /**
     * Add items
     */
    public function addItem(DocumentItemInterface $items)
    {
        $this->items[] = $items;
        return $this;
    }
    /**
     * Remove items
     */
    public function removeItem(DocumentItemInterface $items)
    {
        $this->items->removeElement($items);
        return $this->items;
    }

    /**
     * Get items
     */
    public function getItems()
    {
        return $this->items;
    }
    /**
     * Add Transaction
     */
    public function addTransaction(TransactionInterface $transaction)
    {
        $this->transactions[] = $transaction;
        return $this;
    }
    /**
     * Remove Transaction
     */
    public function removeTransaction(TransactionInterface $transaction)
    {
        $this->transactions->removeElement($transaction);
        return $this->transactions;
    }

    /**
     * Get Transactions
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Add Payment
     */
    public function addPayment(PaymentInterface $payment)
    {
        $this->payments[] = $payment;
        return $this->payments;
    }
    /**
     * Remove Payment
     */
    public function removePayment(PaymentInterface $payment)
    {
        $this->payments->removeElement($payment);
        return $this->payments;
    }

    /**
     * Get Payments
     */
    public function getPayments()
    {
        return $this->payments;
    }
}
