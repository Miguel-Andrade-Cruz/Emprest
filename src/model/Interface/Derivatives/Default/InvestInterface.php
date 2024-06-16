<?php

namespace minuz\emprest\model\Interface\Derivatives\Default;

use minuz\emprest\model\Bank\Concept\BankAbstraction;
use minuz\emprest\model\Interface\Concept\AccountInterfaceAbstraction;
use minuz\emprest\model\Interface\Structure\AccountInterface;

class InvestInterface extends AccountInterface implements AccountInterfaceAbstraction
{
    public function __construct(string $title, string $cardCode, BankAbstraction $Bank)
    {
        parent::__construct($title, $cardCode, $Bank);
    }
}