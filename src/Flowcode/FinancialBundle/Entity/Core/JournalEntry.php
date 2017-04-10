<?php

namespace Flowcode\FinancialBundle\Entity\Core;

use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;

/**
 * Flowcode\FinancialBundle\Entity\Core\JournalEntry
 */
abstract class JournalEntry implements JournalEntryInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    protected $debit;

    /**
     * @var float
     */
    protected $credit;

    /**
     * @var float
     */
    protected $balance;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var AccountInterface
     */
    protected $account;

    /**
     * @var TransactionInterface
     */
    protected $transaction;

    public function __construct()
    {
        $this->credit = 0;
        $this->debit = 0;
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
     * @inheritdoc
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * @inheritdoc
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCredit()
    {
        return $this->credit;
    }
    /**
    * Get balance
    * @return  float
    */
    public function getBalance()
    {
        return $this->balance;
    }
    
    /**
    * Set balance
    * @return $this
    */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
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

    /**
     * @return AccountInterface
     */
    public function getAccount(): AccountInterface
    {
        return $this->account;
    }

    /**
     * @param AccountInterface $account
     */
    public function setAccount(AccountInterface $account)
    {
        $this->account = $account;
    }

    /**
     * @return TransactionInterface
     */
    public function getTransaction(): TransactionInterface
    {
        return $this->transaction;
    }

    /**
     * @param TransactionInterface $transaction
     */
    public function setTransaction(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }
}
