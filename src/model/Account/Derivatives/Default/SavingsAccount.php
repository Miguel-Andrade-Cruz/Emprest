<?php
namespace minuz\emprest\model\Account\Derivatives\Default;

// Account

use minuz\emprest\model\Account\Concept\AccountAbstraction;
use minuz\emprest\model\Account\Concept\AllowLoan;
use minuz\emprest\model\Account\Structure\Account;
use minuz\emprest\model\Loan\Concept\LoanAbstraction;
use minuz\emprest\model\Loan\Concept\PayOffableLoan;

class SavingsAccount extends Account implements AccountAbstraction, AllowLoan
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



    public function applyLoan(LoanAbstraction $loan): void
    {
        $this->loan = $loan;

        return;
    }



    public function viewLoanStatus(): string
    {
        return $this->loan->viewLoanStatus();
    }



    public function payPortions(int $portionsQtd): bool
    {
        if ( $this->loan->checkLoan() ) {

            $this->loan = false;
        }

        return $this->loan->payPortions($portionsQtd);
    }



    public function acessLoan(): LoanAbstraction|PayOffableLoan
    {
        return $this->loan;
    }



    public function checkLoan(): bool
    {
        return $this->loan->checkLoan();
    }
}