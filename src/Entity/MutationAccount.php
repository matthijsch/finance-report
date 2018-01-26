<?php

namespace App\Entity;

/**
 * MutationAccount.
 */
class MutationAccount
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
