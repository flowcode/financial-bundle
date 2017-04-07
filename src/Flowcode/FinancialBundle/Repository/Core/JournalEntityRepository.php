<?php

namespace Flowcode\FinancialBundle\Repository\Core;

use Doctrine\ORM\EntityRepository;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;

/**
 * Flowcode\FinancialBundle\Repository\JournalEntityRepository
 */
class JournalEntityRepository extends EntityRepository
{
    /**
     * Se envia una cuenta y debe dar para la misma debito menos credito de todos
     * los movimientos que esta cuenta tiene.
     * @fecha   2017-04-07
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @param   AccountInterface        $account [description]
     * @return  [number]                           [description]
     */
    public function getBalance(AccountInterface $account)
    {
        $qb = $this->createQueryBuilder("a");
        $qb->select("SUM(a.debit) - SUM(a.credit)");
        $qb->where("a.id = :account")
            ->setParameter("account", $account);
        return $qb->getQuery()->getSingleScalarResult();
    }
}
