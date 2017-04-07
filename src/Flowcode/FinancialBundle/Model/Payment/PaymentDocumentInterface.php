<?php

namespace Flowcode\FinancialBundle\Model\Payment;

use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;

/**
 * Interface Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface
 */
interface PaymentDocumentInterface
{
    public function getId();
    public function setAmount($amount);
    public function getAmount();
    public function getDocument();
    public function setDocument(DocumentInterface $document);
    public function getPayment();
    public function setPayment(PaymentInterface $payment);
    public function getJournalEntry();
    public function setJournalEntry(JournalEntryInterface $journalEntry);
}
