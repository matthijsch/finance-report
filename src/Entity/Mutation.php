<?php

/*
 * This file is part of the JMT catalog package.
 *
 * (c) Connect Holland.
 */

namespace App\Entity;

use DateTime;

/**
 * Mutation.
 */
class Mutation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var Bankaccount
     */
    private $bankaccount;

    /**
     * Get the value of Id.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of Amount.
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set the value of Amount.
     *
     * @param int amount
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of Date.
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set the value of Date.
     *
     * @param DateTime date
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of Bankaccount.
     */
    public function getBankaccount(): Bankaccount
    {
        return $this->bankaccount;
    }

    /**
     * Set the value of Bankaccount.
     *
     * @param Bankaccount bankaccount
     */
    public function setBankaccount(Bankaccount $bankaccount): self
    {
        $this->bankaccount = $bankaccount;

        return $this;
    }
}
