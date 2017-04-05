<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\DocumentManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;

/**
 * Class FinanceService
 */
class FinanceService implements DocumentManagerInterface
{
    private $transactionManagerInterface;
    
    public function __construct(TransactionManagerInterface $transactionManagerInterface)
    {
        $this->transactionManagerInterface = $transactionManagerInterface;
    }
}
