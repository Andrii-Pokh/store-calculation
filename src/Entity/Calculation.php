<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Calculation
{
    /**
     * @Assert\NotNull()
     */
    private $companySymbol;

    /**
     * @Assert\Type("\DateTimeInterface")
     * @Assert\LessThanOrEqual(value = "today")
     */
    private $startDate;

    /**
     * @Assert\Type("\DateTimeInterface")
     * @Assert\LessThanOrEqual(value = "today")
     * @Assert\Expression("this.getEndDate() >= this.getStartDate()")
     */
    private $endDate;
    /**
     * @Assert\Email()
     */
    private string $email;

    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
    }

    public function getCompanySymbol(): ?CompanySymbol
    {
        return $this->companySymbol;
    }

    public function setCompanySymbol(CompanySymbol $companySymbol): void
    {
        $this->companySymbol = $companySymbol;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate(\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }
}
