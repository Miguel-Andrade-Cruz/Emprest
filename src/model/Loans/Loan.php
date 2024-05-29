<?php

namespace minuz\emprest\model\Loans;

class Loan
{
    protected ?float $loan;
    protected ?float $amount;
    protected ?int $portions;
    protected ?float $portionsPrice;



    public function __construct($loan, $amount, $portions, $portionsPrice)
    {
        $this->loan          = $loan;
        $this->amount        = $amount;
        $this->portions      = $portions;
        $this->portionsPrice = $portionsPrice;
    }


    public function payment(): float
    {
        $this->amount -= $this->portionsPrice;
        $this->portions -= 1;

        return $this->amount;
    }


    public function loanInfo(): array
    {
        return [
            "Amount" => $this->amount,
            "Portions" => $this->portions,
            "Price" => $this->portionsPrice
        ];
    }
}