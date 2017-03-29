<?php

namespace Flowcode\FinancialBundle\Model\Core;

/**
 * JournalEntry
 */
class JournalEntry
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $debit;

    /**
     * @var float
     */
    private $credit;

    /**
     * @var \DateTime
     */
    private $date;


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
     * Set debit
     *
     * @param float $debit
     *
     * @return JournalEntry
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * Get debit
     *
     * @return float
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * Set credit
     *
     * @param float $credit
     *
     * @return JournalEntry
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return float
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return JournalEntry
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

