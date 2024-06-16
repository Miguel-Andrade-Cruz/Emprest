<?php

namespace minuz\emprest\model\LoanService\Derivatives\Nacional;

// Loan Service
use minuz\emprest\model\LoanService\Concept\LoanServiceAbstraction;
use minuz\emprest\model\LoanService\Derivatives\Default\MonthLoanService;

// Loan

class NacionalMonthLoanService extends MonthLoanService implements LoanServiceAbstraction
{
    public function __construct(float $interest, int $portionsQtd, string $loanType)
    {
        parent::__construct($interest, $portionsQtd, $loanType);
    }
}