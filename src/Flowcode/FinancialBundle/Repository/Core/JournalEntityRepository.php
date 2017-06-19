<?php

namespace Flowcode\FinancialBundle\Repository\Core;

use Doctrine\ORM\EntityRepository;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;

/**
 * Flowcode\FinancialBundle\Repository\JournalEntityRepository
 */
class JournalEntityRepository extends EntityRepository
{
    public function getBalance(AccountInterface $account)
    {
        $qb = $this->createQueryBuilder("a");
        $qb->select("SUM(a.debit) - SUM(a.credit)");
        $qb->where("a.id = :account")
            ->setParameter("account", $account);
        return $qb->getQuery()->getSingleScalarResult();
    }
}
