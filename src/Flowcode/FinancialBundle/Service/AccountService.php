<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\AccountManagerInterface;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;
use Flowcode\FinancialBundle\Repository\JournalEntityRepository;
use Doctrine\ORM\EntityRepository;
use Flowcode\FinancialBundle\Entity\Core\Account;

/**
 * Class Flowcode\FinancialBundle\Service\AccountService
 */
class AccountService implements AccountManagerInterface
{
    private $journalEntityRepository;
    public function __construct(EntityRepository $journalEntityRepository)
    {
        $this->journalEntityRepository = $journalEntityRepository;
    }
    public function updateBalance(AccountInterface $account)
    {
        // Me tiene que dar debito menos credito
        $balance = $this->journalEntityRepository->getBalance($account);
        if ($account->getType() == Account::TYPE_ASSET) {
            $account->setBalance($balance);
        }
        if ($account->getType() == Account::TYPE_LIABILITY) {
            $account->setBalance(-$balance);
        }
        if ($account->getType() == Account::TYPE_INCOME) {
            $account->setBalance(-$balance);
        }
        if ($account->getType() == Account::TYPE_EXPENSE) {
            $account->setBalance($balance);
        }
        return $account;
    }
}
