<?php

namespace minuz\emprest\model\Accounts\Interface;

use minuz\emprest\model\Banks\Structure\Bank;

class InvestAccountInterface implements AccountInterfaceAbstraction
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


    public function acessAccount(): object
    {
        return $this;
    }


    public function viewBudget(string $password): float
    {
        return $this->Bank->viewBudget($this->cardCode, $password);
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

}