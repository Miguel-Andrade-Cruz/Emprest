<?php

namespace minuz\emprest\model\Account\Concept;

interface AccountAbstraction
{
    public function deposit(float $value): void;

    public function draft(float $value): void;

    public function viewBudget(): float;
}