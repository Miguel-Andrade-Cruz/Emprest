<?php

namespace minuz\emprest\model\Interface\Concept;

interface AccountInterface
{
    public function deopsit(): void;

    public function draft(): void;

    public function viewBudget(): void;
}