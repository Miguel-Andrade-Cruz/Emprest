<?php

namespace minuz\emprest\model\Loan\Derivatives\Nacional;

use DateTimeImmutable;
use minuz\emprest\model\Loan\Concept\LoanAbstraction;
use minuz\emprest\model\Loan\Concept\PayOffableLoan;
use minuz\emprest\model\Loan\Structure\Loan;

class NacionalBankLoan extends Loan implements LoanAbstraction, PayOffableLoan
{
    protected DateTimeImmutable $purchaseDate;
    protected float $amount;
    protected array $portions;


    public function __construct(DateTimeImmutable $date, float $amount, array $portions)
    {
        $this->purchaseDate = $date;
        $this->amount = $amount;
        $this->portions = $portions;
    }
    
    
    public function payOff(): float
    {
        $valuePaid = array_reduce($this->portions, function( $carry, $portion ) { $carry += $portion; return $carry; });
        
        $this->portions = [];
        $this->amount -= $valuePaid;

        return $valuePaid;

    }
}