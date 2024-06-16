<?php

namespace minuz\emprest\model\Account\Derivatives\Nacional;

// Account

use minuz\emprest\model\Account\Concept\AccountAbstraction;
use minuz\emprest\model\Account\Concept\AllowLoan;
use minuz\emprest\model\Account\Derivatives\Default\SavingsAccount;
use minuz\emprest\model\Loan\Concept\LoanAbstraction;
use minuz\emprest\model\Loan\Concept\PayOffableLoan;
// Loan

class NacionalSavingsAccount extends SavingsAccount implements AccountAbstraction, AllowLoan
{
    public readonly string $title;
    protected readonly string $cardCode;
    protected string $password;

    protected float $budget = 0;
    protected LoanAbstraction|PayOffableLoan|false $loan = false;



    public function __construct(string $title, string $password, string $accountCode)
    {
        parent::__construct($title, $password, $accountCode);
    }



    public function payOff(): void
    {
        $this->loan->payOff();
    }
}