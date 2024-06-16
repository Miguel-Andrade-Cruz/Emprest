<?php

namespace minuz\emprest\model\LoanService\Concept;

use minuz\emprest\model\Loan\Concept\LoanAbstraction;

interface LoanServiceAbstraction
{
    public function newLoan(float $value): LoanAbstraction;
}