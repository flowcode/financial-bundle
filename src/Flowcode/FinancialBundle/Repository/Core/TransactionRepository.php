<?php
namespace Flowcode\FinancialBundle\Repository\Core;


/**
 * Flowcode\FinancialBundle\Repository\TransactionRepository
 */
class TransactionRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByDocument($documentId)
    {
        $qb = $this->createQueryBuilder("t");
        $qb->where("t.document = :document_id")
            ->setParameter("document_id", $documentId);
        return $qb->getQuery()->getResult();
    }
}
