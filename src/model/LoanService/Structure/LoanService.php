<?php

namespace minuz\emprest\model\LoanService\Structure;

use minuz\emprest\model\Loan\Concept\LoanAbstraction;
use minuz\emprest\model\LoanService\Concept\LoanServiceAbstraction;

abstract class LoanService implements LoanServiceAbstraction
{
    protected float $interest;
    protected int $portionsQtd;
    protected string $loanType;


    public function __construct(float $interest, int $portionsQtd, string $loanType)
    {
        $this->interest = $interest;
        $this->portionsQtd = $portionsQtd;
        $this->loanType = $loanType;
    }



    public function newLoan(float $value): LoanAbstraction
    {
        $purchaseDate = new \DateTimeImmutable("now");

        $amount = $this->calculateAmount($value);
        $portions = $this->moldPortions($purchaseDate, $amount);

        $loan = new $this->loanType($purchaseDate, $amount, $portions);
        
        return $loan;
    }



    abstract protected function calculateAmount(float $value): float; 
    
    abstract protected function moldPortions(\DateTimeImmutable $purchaseDate, float $amount): array;
}