<?php

namespace Flowcode\FinancialBundle\Model\Core;


interface TransactionInterface
{
    /**
     * Add journalEntries
     *
     * @param JournalEntryInterface $journalEntry
     * @return TransactionInterface
     */
    public function addJournalEntry(JournalEntryInterface $journalEntry);


    /**
     * Get journalEntries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJournalEntries();
}