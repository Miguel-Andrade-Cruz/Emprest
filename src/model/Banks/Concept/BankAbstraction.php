<?php

namespace minuz\emprest\model\Banks\Concept;

use minuz\emprest\model\Loans\Loan;


interface BankAbstraction
{
    public function doDeopsit(string $cardCode, string $password, float $value): void;

    public function doDraft(string $cardCode, string $password, float $value): void;

    public function viewBudget($cardCode, $password): float;
}