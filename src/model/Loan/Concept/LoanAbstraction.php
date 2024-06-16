<?php

namespace minuz\emprest\model\Loan\Concept;

interface LoanAbstraction
{
    public function viewLoanStatus(): string;

    public function payPortions(int $portionsToPay = 1): float;

    public function checkLoan(): bool;

}