<?php

namespace Flowcode\FinancialBundle\Model\Core;


interface JournalEntryInterface
{

    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set debit
     *
     * @param float $debit
     *
     * @return JournalEntryInterface
     */
    public function setDebit($debit);

    /**
     * Get debit
     *
     * @return float
     */
    public function getDebit();

    /**
     * Set credit
     *
     * @param float $credit
     *
     * @return JournalEntryInterface
     */
    public function setCredit($credit);

    /**
     * Get credit
     *
     * @return float
     */
    public function getCredit();
}