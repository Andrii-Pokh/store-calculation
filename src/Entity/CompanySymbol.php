<?php

namespace App\Entity;

class CompanySymbol
{
    private string $companyName;
    private string $financialStatus;
    private string $marketCategory;
    private int $roundLotSize;
    private string $securityName;
    private string $symbol;
    private string $testIssue;

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getFinancialStatus(): string
    {
        return $this->financialStatus;
    }

    public function setFinancialStatus(string $financialStatus): void
    {
        $this->financialStatus = $financialStatus;
    }

    public function getMarketCategory(): string
    {
        return $this->marketCategory;
    }

    public function setMarketCategory(string $marketCategory): void
    {
        $this->marketCategory = $marketCategory;
    }

    public function getRoundLotSize(): int
    {
        return $this->roundLotSize;
    }

    public function setRoundLotSize(int $roundLotSize): void
    {
        $this->roundLotSize = $roundLotSize;
    }

    public function getSecurityName(): string
    {
        return $this->securityName;
    }

    public function setSecurityName(string $securityName): void
    {
        $this->securityName = $securityName;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    public function getTestIssue(): string
    {
        return $this->testIssue;
    }

    public function setTestIssue(string $testIssue): void
    {
        $this->testIssue = $testIssue;
    }
}
