<?php

namespace minuz\emprest\model\Account\Concept;

use minuz\emprest\model\Loan\Concept\LoanAbstraction;
use minuz\emprest\model\Loan\Concept\PayOffableLoan;

interface AllowLoan
{
    public function acessLoan(): LoanAbstraction|PayOffableLoan;
    
    public function applyLoan(LoanAbstraction $loan): void;
    
    public function checkLoan(): bool;

    public function viewLoanStatus(): string;
    
    public function payPortions(int $portionsQtd): bool;
}