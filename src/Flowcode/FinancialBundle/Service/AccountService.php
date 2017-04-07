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
}
