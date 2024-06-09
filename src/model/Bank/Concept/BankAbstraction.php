<?php

namespace minuz\emprest\model\Bank\Concept;

interface BankAbstraction
{
    public function doDeopsit(string $cardCode, string $password, float $value): void;

    public function doDraft(string $cardCode, string $password, float $value): void;

    public function viewBudget($cardCode, $password): float;
}