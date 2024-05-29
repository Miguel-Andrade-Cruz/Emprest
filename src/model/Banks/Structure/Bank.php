<?php

namespace minuz\emprest\model\Banks\Structure;

use minuz\emprest\model\Loans\Loan;
use minuz\emprest\model\Banks\Manager\Manager;
use minuz\emprest\model\Banks\Concept\BankAbstraction;
use minuz\emprest\model\Accounts\{
    SavingsAccount,
    InvestAccount
};
use minuz\emprest\model\Accounts\Structure\Account;
use minuz\emprest\model\Accounts\Interface\{
    InvestAccountInterface,
    SavingsAccountInterface
};

abstract class Bank implements BankAbstraction
{
    protected const BANK_ID = 'XX-';
    
    protected static array $storage = [];
    protected static float $vault;
    protected static int $nextAccountCode = 0;
    public static array $loanPlans;


    // protected Manager $accountManager;


    private function accountExists(string $cardCode): Account|false
    {
        if (! array_key_exists($cardCode, static::$storage)) {
            return false;
        }

        return static::$storage[$cardCode];
    }

    private function validate(Account $account, string $password): bool
    {
        return $account->validate($password);
    }


    public function openAccount(string $title, string $password, string $accountPlan): SavingsAccountInterface|InvestAccountInterface
    {
        $cardCode = static::BANK_ID . sprintf("%'.04d", static::$nextAccountCode +1);

        if ($accountPlan == "Poupança") {
            $account = new SavingsAccount($title, $password, $cardCode);
            $interface = new SavingsAccountInterface(new static, $cardCode, $title);
            
            static::$storage[$cardCode] = $account;
            static::$nextAccountCode = count(static::$storage);
            
            return $interface;
        }
        else if ($accountPlan == "Investimento") {
            $account = new InvestAccount($title, $password, $cardCode);
            $interface = new InvestAccountInterface(new static, $cardCode, $title);
            
            static::$storage[$cardCode] = $account;
            static::$nextAccountCode = count(static::$storage);
            
            return $interface;
        }

    
        throw new \DomainException("Criação de conta cancelada: Plano de conta inválido.");
    }


    public function closeAccount(string $cardCode, string $password): void
    {
        if (! $account = $this->accountExists($cardCode)) {
            throw new \DomainException("Ação interrompida: Conta não existe.");
        }

        if ( ! $this->validate($account, $password) ) {
            throw new \DomainException("Ação interrompida: Senha incorreta.");
        }


        unset(static::$storage[$cardCode]);
        static::$nextAccountCode = count(static::$storage);
        
        return;
    }


    public function allowClientAcess(string $cardCode, string $password): bool
    {
        if(! $account = $this->accountExists($cardCode)) {
            return false;
        }
        if(! $account->validate($password)) {
            return false;
        }

        return true;
    }


    public function acessAccount($cardCode): SavingsAccount|InvestAccount
    {
        if (! $account = $this->accountExists($cardCode)) {
            throw new \DomainException("Ação interrompida: Conta não existe.");
        }

        return $account;
    }



    public function doDeopsit(string $cardCode, string $password, float $value): void
    {
        $account = $this->acessAccount($cardCode);
        $account->validate($password);

        $account->deposit(round($value, 2));

        return;
    }



    public function doDraft(string $cardCode, string $password, float $value): void
    {
        $account = $this->acessAccount($cardCode);
        $account->validate($password);

        $account->draft(round($value, 2));
    }


    public function purchaseLoan(string $cardCode, string $password, float $value): void
    {
        $account = $this->acessAccount($cardCode);
        $account->validate($password);
        
        $interest = static::$loanPlans["Interest"];
        $portions = static::$loanPlans["Portions"];
        
        $amount = round($value, 2) * $interest;
        $portionsPrice = round($amount / $portions, 2);

        $loan = new Loan($value, $amount, $portions, $portionsPrice);
        $account->recieveLoan($loan);

        return;
    }


    public function viewBudget($cardCode, $password): float
    {
        $account = $this->acessAccount($cardCode);
        $account->validate($password);

        return $account->viewBudget();
    }

}