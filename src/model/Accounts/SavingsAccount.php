<?php
namespace minuz\emprest\model\Accounts;

use minuz\emprest\model\Accounts\Structure\Account;
use minuz\emprest\model\Loans\Loan;

class SavingsAccount extends Account {

    public readonly string $title;
    protected string $cardCode;
    protected string $password;

    protected float $budget = 0;
    protected Loan $loan;



    public function __construct(string $title, string $password, string $accountCode)
    {
        parent::__construct($title, $password, $accountCode);
    }


    public function recieveLoan(Loan $loan): void
    {
        $this->loan = $loan;

        return;
    }
}