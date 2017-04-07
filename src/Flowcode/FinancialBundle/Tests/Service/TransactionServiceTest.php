<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Entity\Core\Transaction;
use Flowcode\FinancialBundle\Entity\Core\Account;
use Flowcode\FinancialBundle\Entity\Payment\Income;
use Flowcode\FinancialBundle\Entity\Payment\PaymentMethod;
use Flowcode\FinancialBundle\Entity\Payment\PaymentDocument;
use Flowcode\FinancialBundle\Service\InstanceService;
use Flowcode\FinancialBundle\Service\AccountService;
use Flowcode\FinancialBundle\Service\JournalEntityService;
use Flowcode\FinancialBundle\Entity\Payment\Expense;
use Flowcode\FinancialBundle\Entity\Payment\Payment;

class TransactionServiceTest extends BaseTestCase
{
    /**
     * Probamos que al enviar una cuenta de income, paymentmethod y amount se cree una entidad
     * de transaccion con la las journalEntities correctas para un ingreso.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateIncomeTransaction_returnTransactionWithJournalEntites()
    {
        $income = $this->getMockBuilder(Income::class)
            ->getMockForAbstractClass();
        $incomeFinantialAccount = $this->getMockBuilder(Account::class)
            ->getMockForAbstractClass();
        $income->setAccount($incomeFinantialAccount);

        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
            ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
            ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinantialAccount);
        $payment = $this->getMockBuilder(Payment::class)
            ->getMockForAbstractClass();
        $payment->setMethod($paymentMethod);

        $paymentDocument = $this->getMockBuilder(PaymentDocument::class)
            ->getMockForAbstractClass();
        $paymentDocument->setPayment($payment);

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createIncomeTrx($income, $paymentDocument, $amount);

        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($incomeFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }
    private function getTransactionService()
    {
        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $accountManagerInterface = $this->getMockBuilder(AccountService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $journalEntityManagerInterface = $this->getMockBuilder(JournalEntityService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));
        return new TransactionService($instanceManagerInterface, $accountManagerInterface, $journalEntityManagerInterface);
    }
    /**
     * Probamos que al enviar una cuenta de expense, paymentmethod y amount se cree una entidad
     * de transaccion con la las journalEntities correctas para un gasto.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateExpenseTransaction_returnTransactionWithJournalEntites()
    {
        $expense = $this->getMockBuilder(Expense::class)
            ->getMockForAbstractClass();
        $expenseFinantialAccount = $this->getMockBuilder(Account::class)
            ->getMockForAbstractClass();
        $expense->setAccount($expenseFinantialAccount);
        
        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
            ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
            ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinantialAccount);
        $payment = $this->getMockBuilder(Payment::class)
            ->getMockForAbstractClass();
        $payment->setMethod($paymentMethod);

        $paymentDocument = $this->getMockBuilder(PaymentDocument::class)
            ->getMockForAbstractClass();
        $paymentDocument->setPayment($payment);

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createExpenseTrx($expense, $paymentDocument, $amount);

        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($expenseFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }
    
    private function getMockCallbackForGetInstanceFromInterface()
    {
        return (
            function ($class) {
                if ($class == "Flowcode\FinancialBundle\Model\Core\JournalEntryInterface") {
                    return $this->getMockBuilder(JournalEntry::class)
                            ->getMockForAbstractClass();
                }
                return $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Transaction')
                        ->getMockForAbstractClass();
            }
        );
        
    }
}
