<?php
namespace minuz\emprest\model;

use minuz\emprest\model\Loan;

class Account {

    public readonly string $title;
    protected string $accountCode;
    protected string $password;

    protected int $budget = 0;
    protected Loan $loan;



    public function __construct(string $title, string $accountCode, string $password)
    {
        $this->title = $title;
        $this->accountCode = $accountCode;
        $this->password = $password;
    }


    public function purchaseLoan($loan, $plan): void
    {
        if (!empty($this->loan)) {            
            echo PHP_EOL . "Empréstimo negado: Outro empréstimo em pagamento." . PHP_EOL;
            return;
        }

        $this->loan = BankEmprest::purchaseLoan($loan, $plan);
        return;
    }


    public function checkBalance(): int
    {
        return $this->budget;
    }


    public function payLoan(): void
    {
        $this->loan->payment();
    }


    public function checkLoanAmount(): int
    {
        return $this->loan->getAmount();
    }


    public function checkRemainedPortions(): int
    {
        return $this->loan->getPortionsLeft();
    }


    public function checkPortionsPrice(): int
    {
        return $this->loan->getPortionsPrice();
    }


    public function transfer(Account $accountToTransfer, int $amount, string $password): void
    {
        if ($password != $this->password) {
            return;
        }
        
        $this->budget -= $amount;
        BankEmprest::transaction($this, $accountToTransfer, $amount);
    }


    public function deposit(int $amount): void
    {
        $this->budget += $amount;
    }


    public function getAccountCode(): string
    {
        return $this->accountCode;
    }


    public function getTitle(): string
    {
        return $this->title;
    }
}