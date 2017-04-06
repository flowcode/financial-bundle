<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\DocumentManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Entity\Document\Document;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;

/**
 * Class Flowcode\FinancialBundle\Service\DocumentService
 */
class DocumentService implements DocumentManagerInterface
{
    private $transactionManagerInterface;

    public function __construct(TransactionManagerInterface $transactionManagerInterface)
    {
        $this->transactionManagerInterface = $transactionManagerInterface;
    }
    /**
     * En este metodo se debe actualizar el estado del documento, el balance y totalPayed.
     * @fecha   2017-04-05
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @param   DocumentInterface       $document [description]
     * @return  [type]                            [description]
     */
    public function updateDocument(DocumentInterface $document)
    {
        $document->updateTotalPayed()
                 ->updateBalance();
        if ($document->getTotalPayed() == 0) {
            $this->changeStatusTo($document, Document::STATUS_PAID);
        }
        return $document;
    }

    public function changeStatusTo(DocumentInterface $document, $statusTo)
    {
        return $document->setStatus($statusTo);
    }
}
