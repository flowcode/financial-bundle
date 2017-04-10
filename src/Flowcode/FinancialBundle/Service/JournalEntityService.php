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
    /**
     * Carga en el journal y en la cuenta el balance actual.
     * @param  JournalEntryInterface $journal [description]
     * @return [type]                         [description]
     */
    public function updateBalance(JournalEntryInterface $journal)
    {
        $account = $journal->getAccount();
        // Me tiene que dar debito menos credito
        $balance = $account->getBalance();
        if ($account->getType() == Account::TYPE_ASSET) {
            $balance = $balance + ($journal->getDebit() - $journal->getCredit());
        }
        if ($account->getType() == Account::TYPE_LIABILITY) {
            $balance = $balance + (-$journal->getDebit() + $journal->getCredit());
        }
        if ($account->getType() == Account::TYPE_INCOME) {
            $balance = $balance + (- $journal->getDebit() + $journal->getCredit());
        }
        if ($account->getType() == Account::TYPE_EXPENSE) {
            $balance = $balance + ($journal->getDebit() - $journal->getCredit());
        }
        $journal->setBalance($balance);
        $account->setBalance($balance);
        return $journal;
    }
}
