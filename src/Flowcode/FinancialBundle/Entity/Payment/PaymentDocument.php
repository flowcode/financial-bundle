<?php

namespace Flowcode\FinancialBundle\Entity\Payment;

use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;

/**
 * Flowcode\FinancialBundle\Entity\Payment\PaymentDocument
 */
abstract class PaymentDocument implements PaymentDocumentInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    protected $amount;

    protected $document;

    protected $journalEntry;

    protected $payment;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return float
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
    * Get document
    * @return Document
    */
    public function getDocument()
    {
        return $this->document;
    }
    
    /**
    * Set document
    * @return $this
    */
    public function setDocument(DocumentInterface $document)
    {
        $this->document = $document;
        return $this;
    }

    /**
    * Get payment
    * @return Payment
    */
    public function getPayment()
    {
        return $this->payment;
    }
    
    /**
    * Set payment
    * @return $this
    */
    public function setPayment(PaymentInterface $payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
    * Get journalEntry
    * @return JournalEntryInterface
    */
    public function getJournalEntry()
    {
        return $this->journalEntry;
    }
    
    /**
    * Set journalEntry
    * @return $this
    */
    public function setJournalEntry(JournalEntryInterface $journalEntry)
    {
        $this->journalEntry = $journalEntry;
        return $this;
    }
}
