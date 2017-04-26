<?php

namespace Flowcode\FinancialBundle\Entity\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentCategoryInterface;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Flowcode\FinancialBundle\Model\Document\DocumentItemInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;

/**
 * Flowcode\FinancialBundle\Entity\Document\Document
 */
abstract class Document implements DocumentInterface
{

    const STATUS_CANCELLED = 'status_cancelled';
    const STATUS_DRAFT = 'status_draft';
    const STATUS_PENDING = 'status_pending';
    const STATUS_PAID = 'status_paid';
    const TYPE_CUSTOMER = 'customer';
    const TYPE_SUPPLIER = 'supplier';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var DocumentCategoryInterface
     */
    protected $category;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $subType;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var float
     * Lo que falta que pagen. Total - total pagado.
     */
    protected $balance;

    /**
     * @var \DateTime
     */
    protected $dueDate;

    /**
     * @var Currency
     */
    protected $currency;
    /**
     * @var float
     */
    protected $total;
    /**
     * @var float
     */
    protected $subTotal;
    /**
     * @var float
     */
    protected $tax;

    /**
     * @var float
     */
    protected $totalPayed;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var ArrayCollection
     */
    protected $paymentsDocuments;

    /**
     * @var ArrayCollection
     */
    protected $items;

    /**
     * @var ArrayCollection
     */
    protected $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->paymentsDocuments = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Document
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set subType
     *
     * @param string $subType
     *
     * @return Document
     */
    public function setSubType($subType)
    {
        $this->subType = $subType;

        return $this;
    }

    /**
     * Get subType
     *
     * @return string
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Document
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set balance
     *
     * @param float $balance
     *
     * @return Document
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Document
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }
    /**
    * Get tax
    * @return float
    */
    public function getTax()
    {
        return $this->tax;
    }
    
    /**
    * Set tax
    * @return $this
    */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }
    /**
    * Get subTotal
    * @return float
    */
    public function getSubTotal()
    {
        return $this->subTotal;
    }
    
    /**
    * Set subTotal
    * @return $this
    */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;
        return $this;
    }
    /**
     * Set total
     *
     * @param float $total
     *
     * @return Document
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set totalPayed
     *
     * @param float $totalPayed
     *
     * @return Document
     */
    public function setTotalPayed($totalPayed)
    {
        $this->totalPayed = $totalPayed;

        return $this;
    }

    /**
     * Get totalPayed
     *
     * @return float
     */
    public function getTotalPayed()
    {
        return $this->totalPayed;
    }

    /**
     * Get status
     * @return String
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }


    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get type
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return DocumentCategoryInterface
     */
    public function getCategory(): DocumentCategoryInterface
    {
        return $this->category;
    }

    /**
     * @param DocumentCategoryInterface $category
     */
    public function setCategory(DocumentCategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Add PaymentDocumentInterface
     */
    public function addPaymentDocument(PaymentDocumentInterface $payment)
    {
        $this->paymentsDocuments[] = $payment;
        return $this->paymentsDocuments;
    }
    /**
     * Remove PaymentDocumentInterface
     */
    public function removePaymentDocument(PaymentDocumentInterface $payment)
    {
        $this->paymentsDocuments->removeElement($payment);
        return $this->paymentsDocuments;
    }
    /**
     * Get Payments
     */
    public function getPaymentsDocuments()
    {
        return $this->paymentsDocuments;
    }

    /**
     * Add Transaction
     */
    public function addTransaction(TransactionInterface $transaction)
    {
        $this->transactions[] = $transaction;
        return $this;
    }
    /**
     * Remove Transaction
     */
    public function removeTransaction(TransactionInterface $transaction)
    {
        $this->transactions->removeElement($transaction);
        return $this->transactions;
    }

    /**
     * Get Transactions
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
    /**
     * Add items
     */
    public function addItem(DocumentItemInterface $items)
    {
        $this->items[] = $items;
        return $this;
    }
    /**
     * Remove items
     */
    public function removeItem(DocumentItemInterface $items)
    {
        $this->items->removeElement($items);
        return $this->items;
    }

    /**
     * Get items
     */
    public function getItems()
    {
        return $this->items;
    }
    /**
     * Se actualiza el total pagado calculando nuevamente el valor.
     * @return  Document                  [description]
     */
    public function updateTotalPayed()
    {
        $totalToPay = $this->getTotal();
        $totalPayed = 0;
        foreach ($this->getPaymentsDocuments() as $paymentDocument) {
            $totalPayed += $paymentDocument->getPayment()->getAmount();
        }
        $this->setTotalPayed($totalPayed);
        return $this;
    }

    /**
     * Se actualiza el balance de acuerdo a el total pagado y total a pagar en la entidad
     * @return  [type]                  [description]
     */
    public function updateBalance()
    {
        $totalToPay = $this->getTotal();
        $totalPayed = $this->getTotalPayed();
        $this->setBalance($totalToPay - $totalPayed);
        return $this;
    }
}
