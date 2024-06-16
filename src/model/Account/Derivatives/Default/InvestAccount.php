<?php

namespace minuz\emprest\model\Account\Derivatives\Default;

// Account
use minuz\emprest\model\Account\Structure\Account;
use minuz\emprest\model\Account\Concept\AccountAbstraction;

class InvestAccount extends Account implements AccountAbstraction
{
    public readonly string $title;
    protected readonly string $cardCode;
    protected string $password;

    protected float $budget = 0;



    public function __construct(string $title, string $password, string $accountCode)
    {
        parent::__construct($title, $password, $accountCode);
    }
}