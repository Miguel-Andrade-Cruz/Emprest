<?php

namespace minuz\emprest\model;

class Loan
{
    protected ?float $loan;
    protected ?float $amount;
    protected ?float $portionsPrice;
    protected ?float $portions;
    
    public function __construct($loan, $amount, $portions)
    {
        $this->loan          = $loan;
        $this->amount        = $amount;
        $this->portions      = $portions;
        $this->portionsPrice = $amount / $portions;
    }


    public function getAmount(): int
    {
        return $this->amount;
    }


    public function payment()
    {
        $this->amount -= $this->portionsPrice;
        $this->portions -= 1;

        if ($this->amount == 0) {
            echo PHP_EOL . "Empréstimo pago." . PHP_EOL;
        }
    }


    public function getPortionsLeft(): int
    {
        return $this->portions;
    }


    public function getPortionsPrice(): int
    {
        return $this->portionsPrice;
    }
}