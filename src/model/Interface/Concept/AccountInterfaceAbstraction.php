<?php

namespace minuz\emprest\model\Interface\Concept;

interface AccountInterfaceAbstraction
{
    public function deposit(string $password, float $value): void;

    public function draft(string $password, float $value): void;

    public function viewBudget(string $password): float;

    public function shareTransferenceCode(string $password): array;

    public function tranference(string $password, array $transferecncedata, float $value): void;

    public function acessAccount(string $cardCode, string $password): object;

}