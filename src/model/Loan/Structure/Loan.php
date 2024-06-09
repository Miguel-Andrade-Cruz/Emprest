<?php

namespace minuz\emprest\model\Loan\Structure;

use DateTimeImmutable;

class Loan
{
    protected DateTimeImmutable $purchaseDate;
    protected float $amount;
    protected array $portions;


    public function __construct(string $date, float $amount, array $portions)
    {
        $this->purchaseDate = new DateTimeImmutable($date);
        $this->amount = $amount;
        $this->portions = $portions;
    }



    public function viewLoanStatus(): string
    {
        $status = "Montante a pagar: $this->amount" . PHP_EOL;
        foreach ( $this->portions as $portion => $value ) {

            $status .= " Dia $portion: R$ $value" . PHP_EOL;
        }

        return $status;
    }



    public function payPortions(int $portionsToPay): float
    {
        $portionsPaid = array_splice($this->portions, 0, $portionsToPay);

        $valuePaid = array_reduce($portionsPaid, function( $carry, $portion ) { $carry += $portion; return $carry; });

        return $valuePaid;
    }



    public function checkLoan(): bool
    {
        if ( $this->amount == 0) {
            return true;
        }
        return false;
    }
}