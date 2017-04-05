<?php

namespace Flowcode\FinancialBundle\Entity\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentCategoryInterface;

/**
 * Document
 */
abstract class Document
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
     * @var Payment
     */
    protected $payments;
    /**
     * @var Transaction
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
     * @return DocumentCategoryInterface
     */
    public function getType(): DocumentCategoryInterface
    {
        return $this->type;
    }

    /**
     * @param DocumentCategoryInterface $type
     */
    public function setType(DocumentCategoryInterface $type)
    {
        $this->type = $type;
    }
}
