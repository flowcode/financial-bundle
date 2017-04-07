<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\JournalEntityManagerInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Entity\Core\Account;
use Flowcode\FinancialBundle\Repository\JournalEntityRepository;
use Doctrine\ORM\EntityRepository;

/**
 * Class Flowcode\FinancialBundle\Service\JournalEntityService
 */
class JournalEntityService implements JournalEntityManagerInterface
{
    private $journalEntityRepository;
    public function __construct(EntityRepository $journalEntityRepository)
    {
        $this->journalEntityRepository = $journalEntityRepository;
    }
    public function updateBalance(JournalEntryInterface $journal)
    {
        $account = $journal->getAccount();
        // Me tiene que dar debito menos credito
        $balance = $account->getBalance();
        if ($account->getType() == Account::TYPE_ASSET) {
            $journal->setBalance($balance + ($journal->getDebit() - $journal->getCredit()));
        }
        if ($account->getType() == Account::TYPE_LIABILITY) {
            $journal->setBalance($balance + (-$journal->getDebit() + $journal->getCredit()));
        }
        if ($account->getType() == Account::TYPE_INCOME) {
            $journal->setBalance($balance + (- $journal->getDebit() + $journal->getCredit()));
        }
        if ($account->getType() == Account::TYPE_EXPENSE) {
            $journal->setBalance($balance + ($journal->getDebit() - $journal->getCredit()));
        }
        return $journal;
    }
}
