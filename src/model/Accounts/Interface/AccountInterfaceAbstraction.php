<?php

namespace minuz\emprest\model\Accounts\Interface;

interface AccountInterfaceAbstraction
{
    public function viewBudget(string $password): float;

    public function deposit(string $password, float $value): void;

    public function draft(string $password, float $value): void;
}