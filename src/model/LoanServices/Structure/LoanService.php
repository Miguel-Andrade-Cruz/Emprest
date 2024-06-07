<?php

namespace minuz\emprest\model\LoanServices\Structure;

abstract class LoanService
{
    protected float $interest;
    protected int $portions;



    public function __construct(float $interest, int $portions)
    {
        $this->interest = $interest;
        $this->portions = $portions;
    }



    public function newLoan(float $value)
    {

    }



    abstract protected function calculateAmount();
}