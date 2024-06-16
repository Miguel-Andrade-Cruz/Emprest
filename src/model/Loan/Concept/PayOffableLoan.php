<?php

namespace minuz\emprest\model\Loan\Concept;

interface PayOffableLoan
{
    public function payOff(): float;
}