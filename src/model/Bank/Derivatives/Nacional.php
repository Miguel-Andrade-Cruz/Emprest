<?php

namespace minuz\emprest\model\Bank\Derivatives;

// Bank
use minuz\emprest\model\Bank\Concept\BankAbstraction;
use minuz\emprest\model\Bank\Concept\Loanble;
use minuz\emprest\model\Bank\Concept\PayOffFeature;
use minuz\emprest\model\Loan\Derivatives\Nacional\NacionalBankLoan;
use minuz\emprest\model\LoanService\Derivatives\Nacional\NacionalMonthLoanService;
use minuz\emprest\model\Manager\Structure\Manager;
use minuz\emprest\model\Bank\Structure\LoanbleBank;

// Account
use minuz\emprest\model\Account\Derivatives\{
    
    Nacional\NacionalSavingsAccount,
    Nacional\NacionalInvestAccount
    };
// Account Interface
use minuz\emprest\model\Interface\Derivatives\{

    Nacional\NacionalSavingsInterface,
    Nacional\NacionalInvestInterface
};

// Loan Service
use minuz\emprest\model\LoanService\Structure\LoanService;

final class Nacional extends LoanbleBank implements BankAbstraction, Loanble, PayOffFeature
{
    const BANK_ID = "04";
    
    protected static array $SafeBox = [];
    protected static float $Vault = 15_00_000;

    protected static int $nextAccountCode = 0;

    protected static array $bankAccounts = ["Savings" => NacionalSavingsAccount::class, "Invest" => NacionalInvestAccount::class];
    protected static array $bankInterfaces = ["Savings" => NacionalSavingsInterface::class, "Invest" => NacionalInvestInterface::class];

    protected static LoanService $loanService;
    protected static string $loanType = NacionalBankLoan::class;





    public function __construct()
    {
        self::$loanService = new NacionalMonthLoanService(0.1, 20, self::$loanType);
    }

    public function payOff(string $cardCode, string $password): void
    {
        $account = $this->Auth($cardCode, $password);
        $loan = $account->acessLoan();

        $payment = $loan->payOff();
        self::$Vault += $payment;

        return;
    }
}