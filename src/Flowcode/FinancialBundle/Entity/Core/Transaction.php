<?php

namespace Flowcode\FinancialBundle\Entity\Core;

use Doctrine\Common\Collections\ArrayCollection;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;

/**
 * Transaction
 */
abstract class Transaction implements TransactionInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var ArrayCollection
     */
    protected $journalEntries;

    /**
     * @var Document
     */
    protected $document;

    /**
     * Transaction constructor.
     */
    public function __construct()
    {
        $this->journalEntries = new ArrayCollection();
    }

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
     * Set description
     *
     * @param string $description
     *
     * @return TransactionInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TransactionInterface
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

    /**
     * Add journalEntries
     *
     * @param JournalEntryInterface $journalEntry
     * @return TransactionInterface
     */
    public function addJournalEntry(JournalEntryInterface $journalEntry)
    {
        $this->journalEntries->add($journalEntry);

        return $this;
    }
    /**
     * Get journalEntries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJournalEntries()
    {
        return $this->journalEntries;
    }
}
