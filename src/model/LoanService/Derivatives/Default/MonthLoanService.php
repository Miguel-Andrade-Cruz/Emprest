<?php

namespace minuz\emprest\model\LoanService\Derivatives\Default;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use minuz\emprest\model\LoanService\Concept\LoanServiceAbstraction;
use minuz\emprest\model\LoanService\Structure\LoanService;

class MonthLoanService extends LoanService implements LoanServiceAbstraction
{
    public function __construct(float $interest, int $portionsQtd, string $loanType)
    {
        parent::__construct($interest, $portionsQtd, $loanType);
    }
    
    

    protected function calculateAmount(float $value): float
    {
        return round((($value / $this->portionsQtd) * ($this->interest + 1)) * $this->portionsQtd, 2);
    }



    protected function moldPortions(DateTimeImmutable $purchaseDate, float $amount): array
    {
        $time = new DateInterval("P1M");
        $portions = [];
        
        $portionValue = round($amount / $this->portionsQtd, 2);
        
        for ( $i = 0, $nextDate = $purchaseDate; $i != $this->portionsQtd; $i++ ) {
            $nextDate = $nextDate->add($time);
            $portions[$nextDate->format("d/m/Y")] = $portionValue;
        }

        return $portions;
    }
}