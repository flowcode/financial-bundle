<?php

namespace Flowcode\FinancialBundle\Model\Core;

use Doctrine\Common\Collections\ArrayCollection;
use Flowcode\FinancialBundle\Model\Currency\CurrencyInterface;

/**
 * Interface Flowcode\FinancialBundle\Model\Core\AccountInterface
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

    public function setBalance($balance);

    public function getBalance();

    public function setCurrency(CurrencyInterface $currency);

    public function getCurrency(): CurrencyInterface;
}
