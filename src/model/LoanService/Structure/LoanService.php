<?php

namespace minuz\emprest\model\LoanService\Structure;

use DateTime;
use minuz\emprest\model\Loan\Structure\Loan;

abstract class LoanService
{
    protected float $interest;
    protected int $portionsQtd;



    public function __construct(float $interest, int $portionsQtd)
    {
        $this->interest = $interest;
        $this->portionsQtd = $portionsQtd;
    }



    public function newLoan(float $value): Loan
    {
        $purchaseDate = new DateTime("now");
        $purchaseDate = $purchaseDate->format("d/m/Y");

        $amount = $this->calculateAmount($value);
        $portions = $this->moldPortions($purchaseDate, $amount);

        $loan = new Loan($purchaseDate, $amount, $portions);
        
        return $loan;
    }



    abstract protected function calculateAmount(float $value): float; 
    
    abstract protected function moldPortions(string $purchaseDate, float $amount): array;
}