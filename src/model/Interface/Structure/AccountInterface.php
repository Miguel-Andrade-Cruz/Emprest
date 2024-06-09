<?php

namespace minuz\emprest\model\Interface\Structure;

use DomainException;
use minuz\emprest\model\Bank\Structure\Bank;

abstract class AccountInterface
{
    protected string $title;
    protected string $cardCode;
    protected Bank $Bank;



    public function __construct(string $title, string $cardCode, Bank $Bank)
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



    public function viewBudget(string $password): float
    {
        return $this->Bank->viewBudget($this->cardCode, $password);
    }



    public function acessAccount(string $cardCode, string $password): object
    {
        if ($this->Bank->allowClientAcess($cardCode, $password)) {
            return $this;
        }

        throw new DomainException("Erro: Tentativa de acesso a conta invalido.");
    }
}