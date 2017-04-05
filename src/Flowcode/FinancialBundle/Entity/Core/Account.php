<?php

namespace Flowcode\FinancialBundle\Entity\Core;

use Doctrine\Common\Collections\ArrayCollection;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;

/**
 * Account
 */
abstract class Account implements AccountInterface
{
    const TYPE_ASSET = 1;
    const TYPE_LIABILITY = 2;
    const TYPE_EQUITY = 3;
    const TYPE_INCOME = 4;
    const TYPE_EXPENSE = 5;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $subType;

    /**
     * @var bool
     */
    protected $editable;

    /**
     * @var ArrayCollection
     */
    protected $journalEntries;

    /**
     */
    protected $lft;

    /**
     */
    protected $lvl;

    /**
     */
    protected $rgt;

    /**
     * @var Account
     */
    protected $root;

    /**
     * @var Account
     */
    protected $parent;

    /**
     * @var Account
     */
    protected $children;

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function setParent(Account $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Account
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
     * Set name
     *
     * @param string $name
     *
     * @return AccountInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return AccountInterface
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subtype
     *
     * @param integer $subtype
     *
     * @return AccountInterface
     */
    public function setSubtype($subtype)
    {
        $this->subType = $subtype;

        return $this;
    }

    /**
     * Get subtype
     *
     * @return int
     */
    public function getSubtype()
    {
        return $this->subType;
    }

    /**
     * Set editable
     *
     * @param boolean $editable
     *
     * @return AccountInterface
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return bool
     */
    public function getEditable()
    {
        return $this->editable;
    }
}
