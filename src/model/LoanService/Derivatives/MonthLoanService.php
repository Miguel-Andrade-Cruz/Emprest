<?php

namespace minuz\emprest\model\LoanService\Derivatives;

use DateInterval;
use DateTime;
use minuz\emprest\model\LoanService\Concept\LoanServiceAbstraction;
use minuz\emprest\model\LoanService\Structure\LoanService;

class MonthLoanService extends LoanService implements LoanServiceAbstraction
{
    public function __construct(float $interest, int $portionsQtd)
    {
        parent::__construct($interest, $portionsQtd);
    }
    
    

    protected function calculateAmount(float $value): float
    {
        return round((($value / $this->portionsQtd) * ($this->interest + 1)) * $this->portionsQtd, 2);
    }



    protected function moldPortions(string $purchaseDate, float $amount): array
    {
        $date = new DateTime($purchaseDate);
        $time = new DateInterval("P1M");
        $portions = [];
        
        $portionValue = round($amount / $this->portionsQtd, 2);
        for ( $i = 0; $i<= $this->portionsQtd; $i++ ) {
            
            $nextDate = $date->add($time)->format("d/m/Y");
            $portions[$nextDate] = $portionValue;
        }

        return $portions;
    }
}