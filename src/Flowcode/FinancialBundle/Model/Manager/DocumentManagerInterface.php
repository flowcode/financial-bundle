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
    function changeStatusTo(DocumentInterface $document, $statusTo);

}