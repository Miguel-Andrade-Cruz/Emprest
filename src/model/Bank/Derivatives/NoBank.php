<?php

namespace minuz\emprest\model\Bank\Derivatives;
use minuz\emprest\model\LoanService\Derivatives\MonthLoanService;
use minuz\emprest\model\Manager\Structure\Manager;
use minuz\emprest\model\Bank\Structure\Bank;

use minuz\emprest\model\Interface\Derivatives\{
    
    SavingsInterface\SavingsInterface,
    InvestInterface\InvestInterface
};
use minuz\emprest\model\LoanService\Structure\LoanService;

final class NoBank extends Bank
{
    protected static string $BANK_ID = "02";
    protected static Manager $Manager;
    protected static float $Safe = 15_000_000;
    protected static LoanService $loanService;
    protected static $bankSavingsInterface = SavingsInterface::class;
    protected static $bankInvestInterface = InvestInterface::class;
    



    public function __construct()
    {
        self::$Manager = new Manager($this, self::$BANK_ID, $this->bankSavingsInterface , $this->bankInvestInterface);
        self::$loanService = new MonthLoanService(0.05, 12);
    }
}