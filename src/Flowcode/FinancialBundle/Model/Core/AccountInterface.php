<?php

namespace Flowcode\FinancialBundle\Model\Core;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface AccountInterface
 */
interface AccountInterface
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * @return ArrayCollection
     */
    public function getJournalEntries(): ArrayCollection;

    /**
     * @param ArrayCollection $journalEntries
     */
    public function setJournalEntries(ArrayCollection $journalEntries);
}
