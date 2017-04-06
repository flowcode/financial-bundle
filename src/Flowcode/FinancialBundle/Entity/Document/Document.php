<?php

namespace Flowcode\FinancialBundle\Entity\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentCategoryInterface;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;

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
     * @var float
     */
    protected $total;

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
    protected $payments;
    /**
     * @var ArrayCollection
     */
    protected $items;
    /**
     * @var ArrayCollection
     */
    protected $transactions;

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
    public function setStatus(String $status)
    {
        $this->status = $status;
        return $this;
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
     * Se actualiza el total pagado calculando nuevamente el valor.
     * @fecha   2017-04-05
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  Document                  [description]
     */
    public function updateTotalPayed()
    {
        $totalToPay = $this->getTotal();
        $totalPayed = 0;
        foreach ($this->getPayments() as $payment) {
            $totalPayed += $payment->getAmount();
        }
        $this->setTotalPayed($totalPayed);
        return $this;
    }

    /**
     * Se actualiza el balance de acuerdo a el total pagado y total a pagar en la entidad
     * @fecha   2017-04-05
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
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
