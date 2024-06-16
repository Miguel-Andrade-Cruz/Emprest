<?php

namespace minuz\emprest\model\Interface\Derivatives\Default;

use minuz\emprest\model\Bank\Concept\PayOffFeature;
use minuz\emprest\model\Bank\Structure\LoanbleBank;
use minuz\emprest\model\Interface\Concept\AccountInterfaceAbstraction;
use minuz\emprest\model\Interface\Structure\AccountInterface;


class SavingsInterface extends AccountInterface implements AccountInterfaceAbstraction
{
    public function __construct(string $title, string $cardCode, LoanbleBank|PayOffFeature $Bank)
    {
        parent::__construct($title, $cardCode, $Bank);
    }



    public function purchaseLoan(string $password, float $value) {
        $this->Bank->purchaseLoan($this->cardCode, $password, $value);
    }



    public function viewLoanStatus(string $password): string
    {
        return $this->Bank->viewLoanStatus($this->cardCode, $password);
    }



    public function payLoanPortions(string $password, int $portionsQtd = 1)
    {
        $this->Bank->recievePaymentPortions($this->cardCode, $password, $portionsQtd);
    }
}