<?php

namespace minuz\emprest\model\Account\Derivatives\InvestAccount;

use minuz\emprest\model\Accounts\Structure\Account;
use minuz\emprest\model\Loans\Loan;

class InvestAccount extends Account
{
    public readonly string $title;
    protected string $cardCode;
    protected string $password;

    protected float $budget = 0;



    public function __construct(string $title, string $password, string $accountCode)
    {
        parent::__construct($title, $password, $accountCode);
    }
}