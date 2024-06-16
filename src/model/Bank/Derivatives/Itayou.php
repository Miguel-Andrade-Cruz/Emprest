<?php

namespace minuz\emprest\model\Bank\Derivatives;

// Bank
use minuz\emprest\model\Bank\Concept\Loanble;
use minuz\emprest\model\Bank\Structure\LoanbleBank;

// Manager
use minuz\emprest\model\Manager\Structure\Manager;

// Loan Service
use minuz\emprest\model\LoanService\Structure\LoanService;
use minuz\emprest\model\LoanService\Derivatives\Default\MonthLoanService;

// Account
use minuz\emprest\model\Account\Derivatives\Default\{
    
    SavingsAccount,
    InvestAccount
};

// Interface
use minuz\emprest\model\Interface\Derivatives\Default\{
    
    SavingsInterface,
    InvestInterface
};
use minuz\emprest\model\Loan\Structure\Loan;

final class Itayou extends LoanbleBank implements Loanble
{
    const BANK_ID = "07";
    
    protected static array $SafeBox = [];
    protected static float $Vault = 15_00_000;

    protected static int $nextAccountCode = 0;

    protected static array $bankAccounts = ["Savings" => SavingsAccount::class, "Invest" => InvestAccount::class];
    protected static array $bankInterfaces = ["Savings" => SavingsInterface::class, "Invest" => InvestInterface::class];

    protected static LoanService $loanService;
    protected static string $loanType = Loan::class;





    public function __construct()
    {
        self::$loanService = new MonthLoanService(0.22, 12, self::$loanType);

    }
}