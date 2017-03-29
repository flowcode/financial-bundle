<?php

namespace Flowcode\FinancialBundle\Model\Core;

/**
 * Account
 */
class Account
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $subtype;

    /**
     * @var bool
     */
    private $editable;


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
     * @return Account
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
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
     * @return Account
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
     * @return Account
     */
    public function setSubtype($subtype)
    {
        $this->subtype = $subtype;

        return $this;
    }

    /**
     * Get subtype
     *
     * @return int
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * Set editable
     *
     * @param boolean $editable
     *
     * @return Account
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

