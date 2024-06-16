<?php

namespace minuz\emprest\model\Interface\Structure;

use minuz\emprest\model\Bank\Concept\BankAbstraction;
use minuz\emprest\model\Bank\Structure\LoanbleBank;
use minuz\emprest\model\Bank\Concept\PayOffFeature;
use minuz\emprest\model\Interface\Concept\AccountInterfaceAbstraction;

abstract class AccountInterface implements AccountInterfaceAbstraction
{
    protected string $title;
    protected string $cardCode;
    protected BankAbstraction|LoanbleBank|PayOffFeature $Bank;



    public function __construct(string $title, string $cardCode, BankAbstraction|LoanbleBank|PayOffFeature $Bank)
    {
        $this->title = $title;
        $this->cardCode = $cardCode;
        $this->Bank = $Bank;
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


    public function shareTransferenceCode(string $password): array
    {
        if ( ! $this->Bank->allowClientAcess($this->cardCode, $password) ) {
        
            throw new \DomainException("Erro: Acesso inválido.");
        }

        return ["Bank ID" => $this->Bank, "Account code" => $this->cardCode];
    }


    public function tranference(string $password, array $transferecncedata, float $value): void
    {
        $this->Bank->transference($this->cardCode, $password, $transferecncedata, $value);
    }



    public function viewBudget(string $password): float
    {
        return $this->Bank->viewBudget($this->cardCode, $password);
    }



    public function acessAccount(string $cardCode, string $password): object
    {
        if ($this->Bank->allowClientAcess($cardCode, $password)) {
            return $this;
        }

        throw new \DomainException("Erro: Acesso invalido.");
    }
}