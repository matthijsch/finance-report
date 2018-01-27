<?php

namespace App\Entity;

use DateTime;

/**
 * Mutation.
 */
class Mutation
{
    /**
     * @var string
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
     * @var MutationAccount
     */
    private $mutationAccount;

    /**
     * Get the value of Id.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the value of Id.
     *
     * @param string $id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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
     * Get the value of MutationAccount.
     */
    public function getMutationAccount(): MutationAccount
    {
        return $this->mutationAccount;
    }

    /**
     * Set the value of MutationAccount.
     *
     * @param MutationAccount mutationAccount
     */
    public function setMutationAccount(MutationAccount $mutationAccount): self
    {
        $this->mutationAccount = $mutationAccount;

        return $this;
    }
}
