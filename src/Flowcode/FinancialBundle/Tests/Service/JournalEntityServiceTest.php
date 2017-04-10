<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Entity\Core\Account;
use Flowcode\FinancialBundle\Service\JournalEntityService;

class JournalEntityServiceTest extends BaseTestCase
{
    public function testUpdateAccountAndJournalBalance_DEBIT_ASSET_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_ASSET);
        $journal->setDebit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(2000, $journal->getBalance());
        $this->assertEquals(2000, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_CREDIT_ASSET_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_ASSET);
        $journal->setCredit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(0, $journal->getBalance());
        $this->assertEquals(0, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_DEBIT_LIABILITY_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_LIABILITY);
        $journal->setDebit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(0, $journal->getBalance());
        $this->assertEquals(0, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_CREDIT_LIABILITY_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_LIABILITY);
        $journal->setCredit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(2000, $journal->getBalance());
        $this->assertEquals(2000, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_DEBIT_INCOME_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_INCOME);
        $journal->setDebit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(0, $journal->getBalance());
        $this->assertEquals(0, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_CREDIT_INCOME_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_INCOME);
        $journal->setCredit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(2000, $journal->getBalance());
        $this->assertEquals(2000, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_DEBIT_EXPENSE_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_EXPENSE);
        $journal->setDebit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(2000, $journal->getBalance());
        $this->assertEquals(2000, $account->getBalance());
    }
    public function testUpdateAccountAndJournalBalance_CREDIT_EXPENSE_returnAccountAndJournalWithCorrectBalance()
    {
        $journalEntityManagerInterface = new JournalEntityService();
        $journal = $this->getMockBuilder(JournalEntry::class)
                                         ->getMockForAbstractClass();
        $account = $this->getMockBuilder(Account::class)
                                         ->getMockForAbstractClass();
        $account->setBalance(1000);
        $account->setType(Account::TYPE_EXPENSE);
        $journal->setCredit(1000);
        $journal->setAccount($account);
        $journalEntityManagerInterface->updateBalance($journal);
        $this->assertEquals(0, $journal->getBalance());
        $this->assertEquals(0, $account->getBalance());
    }
}
