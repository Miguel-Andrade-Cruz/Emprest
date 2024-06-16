<?php

namespace minuz\emprest\model\Bank\Derivatives;

// Bank
use minuz\emprest\model\Bank\Structure\Bank;

// Manager
use minuz\emprest\model\Manager\Structure\Manager;

// LoanService
use minuz\emprest\model\LoanService\Derivatives\Default\ValueLoanService;
use minuz\emprest\model\LoanService\Structure\LoanService;

// Account
use minuz\emprest\model\Account\Derivatives\Default\{
    
    SavingsAccount,
    InvestAccount
};
use minuz\emprest\model\Bank\Concept\BankAbstraction;
// Interface
use minuz\emprest\model\Interface\Derivatives\Default\{
    
    InvestInterface,
    SavingsInterface
};


final class Saotende extends Bank implements BankAbstraction
{
    const BANK_ID = "09";
    
    protected static array $SafeBox = [];
    protected static float $Vault = 25_00_000;

    protected static int $nextAccountCode = 0;

    protected static array $bankAccounts = ["Savings" => SavingsAccount::class, "Invest" => InvestAccount::class];
    protected static array $bankInterfaces = ["Savings" => SavingsInterface::class, "Invest" => InvestInterface::class];




    public function __construct()
    {
        
    }

}