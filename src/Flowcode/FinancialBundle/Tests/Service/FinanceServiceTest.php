<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Service\FinanceService;
use Flowcode\FinancialBundle\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Entity\Core\Transaction;
use Flowcode\FinancialBundle\Entity\Core\Account;
use Flowcode\FinancialBundle\Entity\Payment\Payment;
use Flowcode\FinancialBundle\Entity\Payment\PaymentDocument;
use Flowcode\FinancialBundle\Entity\Payment\Income;
use Flowcode\FinancialBundle\Entity\Payment\Expense;
use Flowcode\FinancialBundle\Entity\Payment\PaymentMethod;
use Flowcode\FinancialBundle\Service\InstanceService;
use Flowcode\FinancialBundle\Service\AccountService;
use Flowcode\FinancialBundle\Service\JournalEntityService;
use Flowcode\FinancialBundle\Entity\Document\Document;
use Flowcode\FinancialBundle\Service\PaymentService;
use Flowcode\FinancialBundle\Service\DocumentService;
use Flowcode\FinancialBundle\Service\PaymentDocumentService;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Tests\Mocks\DocumentMock;

class FinanceServiceTest extends BaseTestCase
{
    /**
     * Probamos que al enviar un documento con un amount, un income y el metodo de pago se creen
     * correctamente toda la informacion relacionado a el documento de a una venta instantanea.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateInstantSale_returnDocumentWithCorrectInformation()
    {
        $document = new DocumentMock();
        $income = $this->getMockBuilder(Income::class)
                       ->getMockForAbstractClass();
        $incomeFinantialAccount = $this->getMockBuilder(Account::class)
                                       ->getMockForAbstractClass();
        $income->setAccount($incomeFinantialAccount);

        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                              ->getMockForAbstractClass();
        $paymentMethodFinancialAccount = $this->getMockBuilder(Account::class)
                                              ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinancialAccount);

        $paymentService = $this->getPaymentService();
        $paymentDocumentService = $this->getPaymentDocumentService();

        $documentService = $this->getMockBuilder(DocumentService::class)
                                ->disableOriginalConstructor()
                                ->getMockForAbstractClass();

        $transactionService = $this->getTransactionService();
        $this->accountManagerInterface->expects($this->exactly(2))->method('updateBalance');
        $this->journalEntityManagerInterface->expects($this->exactly(2))->method('updateBalance');
        $financeService = new FinanceService(
            $transactionService,
            $documentService,
            $paymentService,
            $paymentDocumentService
        );
        $amount = 1000;
        $document->setTotal($amount);
        $document = $financeService->createInstantSale($document, $income, $paymentMethod);
        
        $this->assertEquals($amount, $document->getTotalPayed());
        // No debe haber nada pendiente de pago
        $this->assertEquals(0, $document->getBalance());
        $this->assertEquals(Document::STATUS_PAID, $document->getStatus());

        $transactions = $document->getTransactions();
        $this->assertEquals(1, count($transactions));
        $transaction = $transactions[0];

        $this->assertEquals(2, count($transaction->getJournalEntries()));

        $this->assertEquals(1, count($document->getPaymentsDocuments()));
        $this->assertEquals($amount, $document->getPaymentsDocuments()[0]->getAmount());

        $this->assertEquals($amount, $transaction->getJournalEntries()[0]->getCredit());
        $this->assertEquals($incomeFinantialAccount, $transaction->getJournalEntries()[0]->getAccount());
        $this->assertEquals(0, $transaction->getJournalEntries()[0]->getDebit());

        $this->assertEquals($amount, $transaction->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinancialAccount, $transaction->getJournalEntries()[1]->getAccount());

        
    }

    /**
     * Probamos que al enviar un documento con un amount, un expense y el metodo de pago se creen
     * correctamente toda la informacion relacionado a el documento de un gasto instantanea.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateExpenseSale_returnDocumentWithCorrectInformation()
    {
        $document = new DocumentMock();
        $expense = $this->getMockBuilder(Expense::class)
                       ->getMockForAbstractClass();
        $expenseFinantialAccount = $this->getMockBuilder(Account::class)
                                       ->getMockForAbstractClass();
        $expense->setAccount($expenseFinantialAccount);

        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                              ->getMockForAbstractClass();
        $paymentMethodFinancialAccount = $this->getMockBuilder(Account::class)
                                              ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinancialAccount);

        $paymentService = $this->getPaymentService();

        $documentService = $this->getMockBuilder(DocumentService::class)
                                ->disableOriginalConstructor()
                                ->getMockForAbstractClass();

        $transactionService = $this->getTransactionService();
        $paymentDocumentService = $this->getPaymentDocumentService();
        $financeService = new FinanceService(
            $transactionService,
            $documentService,
            $paymentService,
            $paymentDocumentService
        );
        $amount = 1000;
        $document->setTotal($amount);
        $document = $financeService->createInstantExpense($document, $expense, $paymentMethod);

        $this->assertEquals($amount, $document->getTotalPayed());
        // No debe haber nada pendiente de pago
        $this->assertEquals(0, $document->getBalance());
        $this->assertEquals(Document::STATUS_PAID, $document->getStatus());

        $transactions = $document->getTransactions();
        $this->assertEquals(1, count($transactions));
        $transaction = $transactions[0];
        $this->assertEquals(2, count($transaction->getJournalEntries()));
        $this->assertEquals(1, count($document->getPaymentsDocuments()));
        $this->assertEquals($amount, $document->getPaymentsDocuments()[0]->getAmount());

        $this->assertEquals(0, $transaction->getJournalEntries()[0]->getCredit());
        $this->assertEquals($amount, $transaction->getJournalEntries()[0]->getDebit());
        $this->assertEquals($expenseFinantialAccount, $transaction->getJournalEntries()[0]->getAccount());

        $this->assertEquals(0, $transaction->getJournalEntries()[1]->getDebit());
        $this->assertEquals($amount, $transaction->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinancialAccount, $transaction->getJournalEntries()[1]->getAccount());
    }

    private function getTransactionService()
    {
        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $this->accountManagerInterface = $this->getMockBuilder(AccountService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $this->journalEntityManagerInterface = $this->getMockBuilder(JournalEntityService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));
        return new TransactionService($instanceManagerInterface, $this->accountManagerInterface, $this->journalEntityManagerInterface);
    }
    
    private function getPaymentService()
    {
        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));
        return new PaymentService($instanceManagerInterface);
    }
    private function getPaymentDocumentService()
    {
        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));
        return new PaymentDocumentService($instanceManagerInterface);
    }

    private function getMockCallbackForGetInstanceFromInterface()
    {
        return (
            function ($class) {
                $entity = null;
                switch ($class) {
                    case PaymentInterface::class:
                        $entity = $this->getMockBuilder(Payment::class)
                             ->getMockForAbstractClass();
                        break;
                    case JournalEntryInterface::class:
                        $entity = $this->getMockBuilder(JournalEntry::class)
                             ->getMockForAbstractClass();
                        break;
                    case TransactionInterface::class:
                        $entity = $this->getMockBuilder(Transaction::class)
                             ->getMockForAbstractClass();
                        break;
                    case PaymentDocumentInterface::class:
                        $entity = $this->getMockBuilder(PaymentDocument::class)
                             ->getMockForAbstractClass();
                        break;
                    default:
                        $entity = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Transaction')
                             ->getMockForAbstractClass();
                        break;
                }
                return $entity;
            }
        );
        
    }
}
