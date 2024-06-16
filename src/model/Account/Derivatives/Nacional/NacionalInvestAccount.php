<?php

namespace minuz\emprest\model\Account\Derivatives\Nacional;

// Account
use minuz\emprest\model\Account\Derivatives\Default\InvestAccount;
use minuz\emprest\model\Account\Concept\AccountAbstraction;

// Loan
use minuz\emprest\model\Loan\Structure\Loan;

class NacionalInvestAccount extends InvestAccount implements AccountAbstraction
{
    public readonly string $title;
    protected readonly string $cardCode;
    protected string $password;

    protected float $budget = 0;



    public function __construct(string $title, string $password, string $accountCode)
    {
        parent::__construct($title, $password, $accountCode);
    }


    
}