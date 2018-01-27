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
     * @var string
     */
    private $image;

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
    public function setCompany(string $company): self
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
    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of Image.
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of Image.
     *
     * @param string image
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
