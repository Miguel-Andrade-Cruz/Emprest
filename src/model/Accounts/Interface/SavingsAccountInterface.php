<?php

namespace minuz\emprest\model\Accounts\Interface;

use minuz\emprest\model\Banks\Structure\Bank;

class SavingsAccountInterface implements AccountInterfaceAbstraction
{
    protected Bank $Bank;
    protected string $cardCode;
    public readonly string $title;

    public function __construct($Bank, $cardCode, $title)
    {
        $this->Bank = $Bank;
        $this->cardCode = $cardCode;
        $this->title = $title;
    }


    public function acessAccount(string $cardCode, string $password): object
    {
        if (! $this->Bank->allowClientAcess($cardCode, $password)) {
            throw new \DomainException("Acesso a conta negado.");
        }

        return $this;
    }


    public function deposit(string $password, float $value): void
    {
        $this->Bank->doDeopsit($this->cardCode, $password, $value);
        
        return;
    }


    public function draft(string $password, float $value): void
    {
        $this->Bank->doDraft($this->cardCode, $password, $value);

        return;
    }


    public function viewBudget(string $password): float
    {
        return $this->Bank->viewBudget($this->cardCode, $password);
    }


    public function takeLoan(string $password, float $value): void
    {
        $this->Bank->purchaseLoan($this->cardCode, $password, $value);

        return;
    }


    public function viewLoan(string $password): void
    {

    }
}