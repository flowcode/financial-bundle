<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;

/**
 * Interface JournalEntityManagerInterface
 */
interface JournalEntityManagerInterface
{

    public function updateBalance(JournalEntryInterface $journalEntryInterface);
}
