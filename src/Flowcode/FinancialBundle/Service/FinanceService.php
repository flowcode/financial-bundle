<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Manager\FinanceManagerInterface;

use Flowcode\FinancialBundle\Model\Manager\DocumentManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;

/**
 * Class FinanceService
 */
class FinanceService implements FinanceManagerInterface
{
    private $transactionManagerInterface;
    private $documentManagerInterface;
    
    public function __construct(TransactionManagerInterface $transactionService, DocumentManagerInterface $documentService)
    {
        $this->transactionService = $transactionService;
        $this->documentService = $documentService;
    }
    public function createInstantSale(
        DocumentInterface $document,
        IncomeInterface $income,
        PaymentMethodInterface $paymentMethod
    ) {
        $amount = $document->getTotal();
        $transaction = $this->transactionService->createIncomeTrx($income, $paymentMethod, $amount)
        $document->setTransaction
        return $document;
    }
}
