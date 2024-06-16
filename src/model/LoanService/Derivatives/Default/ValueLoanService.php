<?php

namespace minuz\emprest\model\LoanService\Derivatives\Default;

use DateTimeImmutable;
use minuz\emprest\model\LoanService\Concept\LoanServiceAbstraction;
use minuz\emprest\model\LoanService\Structure\LoanService;

class ValueLoanService extends LoanService implements LoanServiceAbstraction
{
    public function __construct($interest, $portionsQtd, string $loanType)
    {
        parent::__construct($interest, $portionsQtd, $loanType);
    }
    
    
    
    protected function calculateAmount(float $value): float
    {
        return $value * ($this->interest + 1);
    }



    protected function moldPortions(DateTimeImmutable $purchaseDate, float $amount): array
    {
        $time = new \DateInterval("P1M");
        $portionValue = round($amount / $this->portionsQtd, 2);
        
        $portions = [];
        for ( $i = 0; $i<= $this->portionsQtd; $i++ ) {

            $nextDate = $purchaseDate->add($time)->format("d/m/Y");
            $portions[$nextDate] = $portionValue;
        }
        
        return $portions;
    }
}