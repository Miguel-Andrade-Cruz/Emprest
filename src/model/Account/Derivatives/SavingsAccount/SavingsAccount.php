<?php
namespace minuz\emprest\model\Account\Derivatives\SavingsAccount;

use minuz\emprest\model\Account\Structure\Account;
use minuz\emprest\model\Loan\Structure\Loan;

class SavingsAccount extends Account {

    public readonly string $title;
    protected string $cardCode;
    protected string $password;

    protected float $budget = 0;
    protected Loan|false $loan = false;



    public function __construct(string $title, string $password, string $accountCode)
    {
        parent::__construct($title, $password, $accountCode);
    }



    public function applyLoan(Loan $loan): void
    {
        $this->loan = $loan;

        return;
    }



    public function viewLoanStatus(): string
    {
        return $this->loan->viewLoanStatus();
    }



    public function payPortions(int|true $portionsQtd = true): bool
    {
        if ( $this->loan->checkLoan() ) {

            $this->loan = false;
        }

        return $this->loan->payPortions($portionsQtd);
    }



    public function checkLoan(): bool
    {
        return $this->loan->checkLoan();
    }
}