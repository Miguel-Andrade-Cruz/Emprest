<?php

namespace minuz\emprest\model\Bank\Derivatives;

use minuz\emprest\model\Manager\Structure\Manager;
use minuz\emprest\model\Bank\Structure\Bank;

use minuz\emprest\model\Interface\Derivatives\{
    
    SavingsInterface\SavingsInterface,
    InvestInterface\InvestInterface
};
use minuz\emprest\model\LoanService\Derivatives\MonthLoanService;
use minuz\emprest\model\LoanService\Structure\LoanService;

final class Itayou extends Bank
{
    protected static string $BANK_ID = "09";
    protected static Manager $Manager;
    protected static float $Safe = 15_000_000;
    protected static LoanService $loanService;
    protected static $bankSavingsInterface = SavingsInterface::class;
    protected static $bankInvestInterface = InvestInterface::class;
    



    public function __construct()
    {
        self::$Manager = new Manager($this, self::$BANK_ID, self::$bankSavingsInterface , self::$bankInvestInterface);
        self::$loanService = new MonthLoanService(0.5, 12);
    }
}