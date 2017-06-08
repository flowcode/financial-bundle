<?php
namespace Flowcode\FinancialBundle\Repository\Core;

use Doctrine\ORM\EntityRepository;

/**
 * Flowcode\FinancialBundle\Repository\TransactionRepository
 */
class TransactionRepository extends EntityRepository
{

    public function getByDocument($documentId)
    {
        $qb = $this->createQueryBuilder("t");
        $qb->where("t.document = :document_id")
            ->setParameter("document_id", $documentId);
        return $qb->getQuery()->getResult();
    }
}
