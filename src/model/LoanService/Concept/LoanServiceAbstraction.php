<?php

namespace minuz\emprest\model\LoanService\Concept;

use minuz\emprest\model\Loan\Structure\Loan;

interface LoanServiceAbstraction
{
    public function newLoan(float $value): Loan;
}