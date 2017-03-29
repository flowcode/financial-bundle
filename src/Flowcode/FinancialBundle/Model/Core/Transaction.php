<?php

namespace Flowcode\FinancialBundle\Model\Core;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Transaction
 */
class Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * @param \Flower\FinancesBundle\Entity\JournalEntry $journalEntry
     * @return Transaction
     */
    public function addJournalEntry(\Flower\FinancesBundle\Entity\JournalEntry $journalEntry)
    {
        $this->journalEntries->add($journalEntry);

        return $this;
    }

    /**
     * Remove journalEntries
     *
     * @param \Flower\FinancesBundle\Entity\JournalEntry $journalEntry
     */
    public function removeJournalEntry(\Flower\FinancesBundle\Entity\JournalEntry $journalEntry)
    {
        $this->journalEntries->removeElement($journalEntry);
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

