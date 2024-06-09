<?php

namespace minuz\emprest\model\Bank\Derivatives;

use minuz\emprest\model\Manager\Structure\Manager;
use minuz\emprest\model\Bank\Structure\Bank;

use minuz\emprest\model\Interface\Derivatives\{
    
    InvestInterface\InvestInterface,
    SavingsInterface\SavingsInterface
};
use minuz\emprest\model\LoanService\Derivatives\MonthLoanService;
use minuz\emprest\model\LoanService\Derivatives\ValueLoanService;
use minuz\emprest\model\LoanService\Structure\LoanService;

final class Saotende extends Bank
{
    protected static string $BANK_ID = "05";
    protected static Manager $Manager;
    protected static float $Safe = 200_000_000;
    protected static LoanService $loanService;
    protected static $bankSavingsInterface = SavingsInterface::class;
    protected static $bankInvestInterface = InvestInterface::class;
    



    public function __construct()
    {
        self::$Manager = new Manager($this, self::$BANK_ID, self::$bankSavingsInterface , self::$bankInvestInterface);
        self::$loanService = new ValueLoanService(0.01, 6);
    }
}