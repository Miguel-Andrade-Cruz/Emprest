<?php

namespace minuz\emprest\model\LoanService\Derivatives;

use minuz\emprest\model\LoanService\Concept\LoanServiceAbstraction;
use minuz\emprest\model\LoanService\Structure\LoanService;

class ValueLoanService extends LoanService implements LoanServiceAbstraction
{
    public function __construct($interest, $portionsQtd)
    {
        parent::__construct($interest, $portionsQtd);
    }
    
    
    
    protected function calculateAmount(float $value): float
    {
        return $value * ($this->interest + 1);
    }



    protected function moldPortions(string $purchaseDate, float $amount): array
    {
        $date = new \DateTime($purchaseDate);
        $time = new \DateInterval("P1M");
        $portionValue = round($amount / $this->portionsQtd, 2);
        
        $portions = [];
        for ( $i = 0; $i<= $this->portionsQtd; $i++ ) {

            $nextDate = $date->add($time)->format("d/m/Y");
            $portions[$nextDate] = $portionValue;
        }
        
        return $portions;
    }
}