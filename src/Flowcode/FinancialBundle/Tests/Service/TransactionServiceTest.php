<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Entity\Core\Transaction;
use Flowcode\FinancialBundle\Entity\Core\Account;

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
        $income = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Payment\Income')
            ->getMockForAbstractClass();
        $incomeFinantialAccount = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Account')
            ->getMockForAbstractClass();
        $income->setAccount($incomeFinantialAccount);

        $paymentMethod = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Payment\PaymentMethod')
            ->getMockForAbstractClass();
        $paymentMethodFinantialAccount = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Account')
            ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinantialAccount);
        $instanceManagerInterface = $this->getMockBuilder('Flowcode\FinancialBundle\Service\InstanceService')
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));

        $transactionService = new TransactionService($instanceManagerInterface);
        $amount = 1000;
        $transaction2 = $transactionService->createIncomeTrx($income, $paymentMethod, $amount);

        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(1000, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($incomeFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals(1000, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
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
        $expense = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Payment\Expense')
            ->getMockForAbstractClass();
        $expenseFinantialAccount = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Account')
            ->getMockForAbstractClass();
        $expense->setAccount($expenseFinantialAccount);

        $paymentMethod = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Payment\PaymentMethod')
            ->getMockForAbstractClass();
        $paymentMethodFinantialAccount = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Account')
            ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinantialAccount);
        $instanceManagerInterface = $this->getMockBuilder('Flowcode\FinancialBundle\Service\InstanceService')
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));

        $transactionService = new TransactionService($instanceManagerInterface);
        $amount = 1000;
        $transaction2 = $transactionService->createExpenseTrx($expense, $paymentMethod, $amount);

        $this->assertEquals(1000, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($expenseFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(1000, $transaction2->getJournalEntries()[1]->getCredit());
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
