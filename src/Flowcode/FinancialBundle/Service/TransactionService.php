<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Manager\InstanceManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\AccountManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\JournalEntityManagerInterface;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;

/**
 * Class TransactionService
 */
class TransactionService implements TransactionManagerInterface
{
    /**
     * @var InstanceManagerInterface
     */
    protected $instanceService;

    public function __construct(
        InstanceManagerInterface $instanceService,
        AccountManagerInterface $accountService,
        JournalEntityManagerInterface $journalEntityService
    ) {
        $this->instanceService = $instanceService;
        $this->accountService = $accountService;
        $this->journalEntityService = $journalEntityService;
    }

    /**
     * Creación de movimientos para una venta instantanea
     * @param IncomeInterface $income
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createIncomeTrx(
        IncomeInterface $income,
        PaymentDocumentInterface $paymentDocument,
        $amount
    ) {
        //Ingreso
        $journalEntryIncome = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setCredit($amount);
        $journalEntryIncome->setAccount($income->getAccount());
        $journalEntryAsset->setDebit($amount);
        $journalEntryAsset->setAccount($paymentDocument->getPayment()->getMethod()->getAccount());
        $paymentDocument->setJournalEntry($journalEntryAsset);
        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        return $transaction;
    }
    public function updateBalancesByTransaction(TransactionInterface $transaction)
    {
        foreach ($transaction->getJournalEntries() as $journal) {
            $this->journalEntityService->updateBalance($journal);
        }
    }
    /**
     * Creación de movimientos para una venta que va a ser pagada en un futuro.
     * @param IncomeInterface $income
     * @param AccountInterface $clientAccount
     * @param $amount
     * @return mixed
     */
    public function createSaleOrderTrx(
        IncomeInterface $income,
        AccountInterface $clientAccount,
        $amount
    ) {
        //Ingreso
        $journalEntryIncome = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo Cuenta del cliente que debe
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setCredit($amount);
        $journalEntryIncome->setAccount($income->getAccount());
        $journalEntryAsset->setDebit($amount);
        $journalEntryAsset->setAccount($clientAccount);
        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        return $transaction;
    }

    /**
     * Creación de movimientos de pago de una deuda de un cliente.
     * @param AccountInterface $clientAccount
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createSaleOrderPaymentTrx(
        AccountInterface $clientAccount,
        PaymentDocumentInterface $paymentDocument,
        $amount
    ) {
        //Ingreso
        $journalEntryIncome = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo Cuenta del cliente que debe
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setDebit($amount);
        $journalEntryIncome->setAccount($paymentDocument->getPayment()->getMethod()->getAccount());
        $paymentDocument->setJournalEntry($journalEntryIncome);
        $journalEntryAsset->setCredit($amount);
        $journalEntryAsset->setAccount($clientAccount);
        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        return $transaction;
    }

    /**
     * @param ExpenseInterface $expense
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createExpenseTrx(
        ExpenseInterface $expense,
        PaymentDocumentInterface $paymentDocument,
        $amount
    ) {
        //Egreso
        $journalEntryExpense = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryExpense->setDebit($amount);
        $journalEntryExpense->setAccount($expense->getAccount());
        $journalEntryAsset->setCredit($amount);
        $journalEntryAsset->setAccount($paymentDocument->getPayment()->getMethod()->getAccount());
        $transaction->addJournalEntry($journalEntryExpense);
        $transaction->addJournalEntry($journalEntryAsset);
        return $transaction;
    }
}
