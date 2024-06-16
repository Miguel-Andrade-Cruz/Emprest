<?php

namespace minuz\emprest\model\Bank\Concept;

interface Loanble extends BankAbstraction
{
    public function purchaseLoan(string $cardCode, string $password, float $loanValue): void;

    public function recievePaymentPortions(string $cardCode, string $password, int $portionsQtd): void;

    public function viewLoanStatus(string $cardCode, string $password): string;

}