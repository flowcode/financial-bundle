<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Document\DocumentInterface;

/**
 * Interface DocumentManagerInterface
 */
interface DocumentManagerInterface
{

    /**
     * @param DocumentInterface $document
     * @param string $statusTo
     * @return mixed
     */
    public function changeStatusTo(DocumentInterface $document, $statusTo);

    /**
     * En este metodo se debe actualizar el estado del documento, el balance y totalPayed.
     * @fecha   2017-04-05
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @param   DocumentInterface       $document [description]
     * @return  [type]                            [description]
     */
    public function updateDocument(DocumentInterface $document);
}
