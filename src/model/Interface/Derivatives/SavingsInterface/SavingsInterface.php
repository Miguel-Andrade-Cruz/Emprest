<?php

namespace minuz\emprest\model\Interface\Derivatives\SavingsInterface;

use minuz\emprest\model\Bank\Structure\Bank;
use minuz\emprest\model\Interface\Structure\AccountInterface;

class SavingsInterface extends AccountInterface
{
    public function __construct(string $title, string $cardCode, Bank $Bank)
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
}