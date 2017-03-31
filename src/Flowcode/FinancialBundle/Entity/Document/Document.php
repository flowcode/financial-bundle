<?php

namespace Flowcode\FinancialBundle\Entity\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentTypeInterface;

/**
 * Document
 */
abstract class Document
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var DocumentTypeInterface
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
     * @return DocumentTypeInterface
     */
    public function getType(): DocumentTypeInterface
    {
        return $this->type;
    }

    /**
     * @param DocumentTypeInterface $type
     */
    public function setType(DocumentTypeInterface $type)
    {
        $this->type = $type;
    }


}

