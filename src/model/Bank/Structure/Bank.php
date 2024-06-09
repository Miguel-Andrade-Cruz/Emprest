<?php

namespace minuz\emprest\model\Bank\Structure;

use minuz\emprest\model\Bank\Concept\BankAbstraction;
use minuz\emprest\model\Manager\Structure\Manager;
use minuz\emprest\model\Account\Structure\Account;

use minuz\emprest\model\Account\Derivatives\{
    
    SavingsAccount\SavingsAccount,
    INvestAccount\InvestAccount
};
use minuz\emprest\model\LoanService\Structure\LoanService;

abstract class Bank implements BankAbstraction
{
    protected static string $BANK_ID;
    
    protected static float $Safe;
    public static array $LoanPlans;
    protected static Manager $Manager;
    protected static LoanService $loanService;

    public function __construct()
    {

    }



    public function openAccount(string $title, string $password, $accountPlan)
    {
        return static::$Manager->openAccount($title, $password, $accountPlan);
    }



    public function closeAccount(string $cardCode, string $password): void
    {
        static::$Manager->closeAccount($cardCode, $password);
    }



    protected function Auth(string $cardCode, string $password): SavingsAccount|InvestAccount
    {
        $account = static::$Manager->acessAccount($cardCode);
        $account->validate($password);

        return $account;
    }



    protected function internalTranference(Account $account, string $destinyAccountID, float $value): void
    {
        $destinyAccount = static::$Manager->acessAccount($destinyAccountID);
        
        $value = round($value, 2);
        $account->draft($value);
        $destinyAccount->deposit($value);
        
        return;
    }
    
    
    
    protected function externalTransference(Account $account, string $destinyAccountID, Bank $tranferenceBank, string $value): void
    {
        $value = round($value, 2);
        
        $account->draft($value);
        $tranferenceBank->recieveTransference($destinyAccountID, $value);
        
        return;
    }
    
    
    protected function recieveTransference(string $destinyAccountID, float $value): void
    {
        $recieveAccount = $this->Manager->acessAccount($destinyAccountID);
        $recieveAccount->deposit($value);

        return;
    }



    public function allowClientAcess(string $cardCode, string $password): bool
    {
        return static::$Manager->allowClientAcess($cardCode, $password);
    }



    public function transference(string $cardCode, string $password, array $transferenceData, float $value): void
    {
        $account = $this->Auth($cardCode, $password);
        $destinyAccountID = $transferenceData["Account ID"];
        $tranferenceBank = $transferenceData["Bank"];
        
        if ($tranferenceBank->BANK_ID != $this->BANK_ID) {

            $this->externalTransference($account, $destinyAccountID, $tranferenceBank, $value);
            
            return;
        }

        $this->internalTranference($account, $destinyAccountID, $value);
        
        return;
    }



    public function doDeopsit(string $cardCode, string $password, float $value): void
    {
        $account = $this->Auth($cardCode, $password);
        $account->deposit(round($value, 2));
        
        return;
    }



    public function doDraft(string $cardCode, string $password, float $value): void
    {
        $account = $this->Auth($cardCode, $password);
        
        $account->draft(round($value, 2));
    }



    public function viewBudget($cardCode, $password): float
    {
        $account = $this->Auth($cardCode, $password);
        
        return $account->viewBudget();
    }



    public function purchaseLoan(string $cardCode, string $password, float $loanValue): void
    {
        $account = $this->Auth($cardCode, $password);

        $loan = static::$loanService->newLoan($loanValue);

        $account->applyLoan($loan);
    }



    public function viewLoanStatus(string $cardCode, string $password): string
    {
        $account = $this->Auth($cardCode, $password);
        
        return $account->viewLoanStatus();
    }



    public function payPortions(string $cardCode, string $password, int $portionsQtd): void
    {
        $account = $this->Auth($cardCode, $password);
        
        $portion = $account->payPortions($portionsQtd);
        $this->Safe += $portion;

        return;
    }
}