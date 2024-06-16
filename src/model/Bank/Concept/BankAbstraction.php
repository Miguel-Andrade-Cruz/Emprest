<?php

namespace minuz\emprest\model\Bank\Concept;

interface BankAbstraction
{
    public function doDeopsit(string $cardCode, string $password, float $value): void;

    public function doDraft(string $cardCode, string $password, float $value): void;

    public function viewBudget($cardCode, $password): float;

    public function allowClientAcess(string $cardCode, string $password): bool;

    public function transference(string $cardCode, string $password, array $transferenceData, float $value): void;

}