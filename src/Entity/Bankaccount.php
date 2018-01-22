<?php

namespace App\Entity;

/**
 * Bankaccount.
 */
class Bankaccount
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var string
     */
    private $category;

    /**
     * Get the value of Id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Company.
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * Set the value of Company.
     *
     * @param string company
     */
    public function setCompany($company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get the value of Account Number.
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * Set the value of Account Number.
     *
     * @param string accountNumber
     */
    public function setAccountNumber($accountNumber): self
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get the value of Category.
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set the value of Category.
     *
     * @param string category
     */
    public function setCategory($category): self
    {
        $this->category = $category;

        return $this;
    }
}
