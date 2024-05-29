<?php

namespace minuz\emprest\model\Accounts\Structure;

use minuz\emprest\model\Banks\Safety\AcessValidator;
use minuz\emprest\model\Accounts\Concept\AccountAbstraction;
use minuz\emprest\model\Banks\Concept\Bank;

abstract class Account implements AccountAbstraction
{
    public readonly string $title;
    protected string $cardCode;
    protected string $password;
    protected float $budget = 0;


    public function __construct(string $title, string $password, string $cardCode)
    {        
        $this->title = $title;
        $this->password = $password;
        $this->cardCode = $cardCode;
    }



    public function validate($password): bool
    {
        return $password == $this->password ? true : false;
    }


    public function viewBudget(): float
    {
        return $this->budget;
    }


    public function deposit(float $value): void
    {
        $this->budget += $value;

        return;
    }


    public function draft(float $value): void
    {
        $this->budget -= $value;
        
        return;
    }
}