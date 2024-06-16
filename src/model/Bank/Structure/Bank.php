<?php

namespace minuz\emprest\model\Bank\Structure;

// Bank
use minuz\emprest\model\Bank\Concept\BankAbstraction;
use minuz\emprest\model\Manager\Structure\Manager;

// Account
use minuz\emprest\model\Account\Structure\Account;
use minuz\emprest\model\Account\Derivatives\Default\SavingsAccount;
use minuz\emprest\model\Account\Derivatives\Default\InvestAccount;
use minuz\emprest\model\Interface\Concept\AccountInterfaceAbstraction;
// Interface
use minuz\emprest\model\Interface\Derivatives\Default\{
    InvestInterface,
    SavingsInterface
};

abstract class Bank implements BankAbstraction
{
    const BANK_ID = "XX";
    
    protected static array $SafeBox = [];
    protected static float $Vault = 0;

    protected static int $nextAccountCode = 0;

    protected static array $bankAccounts = ["Savings" => SavingsAccount::class, "Invest" => InvestAccount::class];
    protected static array $bankInterfaces = ["Savings" => SavingsInterface::class, "Invest" => InvestInterface::class];



    protected function Auth(string $cardCode, string $password): SavingsAccount|InvestAccount|false
    {
        if (! array_key_exists($cardCode, static::$SafeBox)) {
        
            return false;
        }
        
        $account = static::$SafeBox[$cardCode];
        $account->validate($password);
        
        return $account;
    }



    protected function searchAccount(string $cardCode): SavingsAccount|InvestAccount
    {
        if ( ! array_key_exists($cardCode, static::$SafeBox) ) {
        
            throw new \DomainException("Conta a transferir não encontrada.");
        }
        $account = static::$SafeBox[$cardCode];
        
        return $account;
    }



    public function allowClientAcess(string $cardCode, string $password): bool
    {
        if ( ! $this->Auth($cardCode, $password) ) {

            return false;
        }
        return true;
    }



    public function openAccount(string $title, string $password, string $accountPlan): AccountInterfaceAbstraction
    {
        $cardCode = static::BANK_ID . "-" . sprintf("%'.04d", ++static::$nextAccountCode);

        return match ($accountPlan) {

            "Poupança" => $this->openSavingsAccount($title, $password, $cardCode),
            
            "Investimento" => $this->openInvestAccount($title, $password, $cardCode),
            
            default => throw new \DomainException("Criação de conta cancelada: Plano de conta inválido.")
        };
    }




    private function openSavingsAccount(string $title, string $password, string $cardCode): AccountInterfaceAbstraction
{
    $accountType = static::$bankAccounts["Savings"];
    $interfaceType = static::$bankInterfaces["Savings"];
    
    $account = new $accountType($title, $password, $cardCode);
    $interface = new $interfaceType($title, $cardCode, $this);
    
    static::$SafeBox[$cardCode] = $account;
    
    return $interface;
}


private function openInvestAccount(string $title, string $password, string $cardCode): AccountInterfaceAbstraction
{
    $accountType = static::$bankAccounts["Invest"];
    $interfaceType = static::$bankInterfaces["Invest"];
    
    $account = new $accountType($title, $password, $cardCode);
    $interface = new $interfaceType($title, $cardCode, $this);
    
    static::$SafeBox[$cardCode] = $account;
    
    return $interface;
}



public function closeAccount(string $cardCode, string $password): void
{
    if ( ! $this->Auth($cardCode, $password) ) {
        
        throw new \DomainException("Cancelamento interrompido: Dados inválidos.");
    }

    unset(static::$SafeBox[$cardCode]);
    $this->nextAccountCode--;
    
    return;
}



    protected function internalTranference(Account $account, string $destinyCardCode, float $value): void
    {
        $destinyAccount = $this->searchAccount($destinyCardCode);
        
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
        $recieveAccount = $this->searchAccount($destinyAccountID);
        $recieveAccount->deposit($value);

        return;
    }



    public function transference(string $cardCode, string $password, array $transferenceData, float $value): void
    {
        $account = $this->Auth($cardCode, $password);
        $destinyAccountID = $transferenceData["Account code"];
        $tranferenceBank = $transferenceData["Bank ID"];
        
        if ( static::BANK_ID != $tranferenceBank::BANK_ID ) {

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




}