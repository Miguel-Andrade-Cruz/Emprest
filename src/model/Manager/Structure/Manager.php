<?php

namespace minuz\emprest\model\Manager\Structure;

use minuz\emprest\model\Interface\Derivatives\{
    
    SavingsInterface\SavingsInterface,
    InvestInterface\InvestInterface
};
use minuz\emprest\model\Account\Structure\Account;
use minuz\emprest\model\Bank\Structure\Bank;

use minuz\emprest\model\Account\Derivatives\{
    
    SavingsAccount\SavingsAccount,
    InvestAccount\InvestAccount
};


class Manager
{
    protected string $BANK_ID;
    protected Bank $BankService;
    protected $bankSavingsInterface;
    protected $bankInvestInterface;

    protected array $Vault = [];
    protected int $nextAccountCode = 0;


    public function __construct(
        Bank $BankService,
        string $BANK_ID,
        $bankSavingsInterface,
        $bankInvestInterface
    ) {
        $this->BankService = $BankService;
        $this->BANK_ID = $BANK_ID;
        $this->bankSavingsInterface = $bankSavingsInterface;
        $this->bankInvestInterface = $bankInvestInterface;
    }



    public function acessAccount(string $cardCode): SavingsAccount|InvestAccount|false
    {
        if (! array_key_exists($cardCode, $this->Vault)) {
            return false;
        }

        return  $this->Vault[$cardCode];
    }



    public function allowClientAcess(string $cardCode, string $password): bool
    {
        if(! $account = $this->acessAccount($cardCode)) {
            return false;
        }
        if(! $account->validate($password)) {
            return false;
        }

        return true;
    }



    private function validate(Account $account, string $password): bool
    {
        return $account->validate($password);
    }



    public function openAccount(string $title, string $password, string $accountPlan): SavingsInterface|InvestInterface
    {
        $cardCode = $this->BANK_ID . "-" . sprintf("%'.04d", $this->nextAccountCode +1);

        if ($accountPlan == "Poupança") {
            $account = new SavingsAccount($title, $password, $cardCode);
            $interface = new $this->bankSavingsInterface($title, $cardCode, $this->BankService);
            
            $this->Vault[$cardCode] = $account;
            $this->nextAccountCode = count($this->Vault);
            
            return $interface;
        }
        else if ($accountPlan == "Investimento") {
            $account = new InvestAccount($title, $password, $cardCode);
            $interface = new $this->bankInvestInterface($title, $cardCode, $this->BankService);
            
            $this->Vault[$cardCode] = $account;
            $this->nextAccountCode = count($this->Vault);
            
            return $interface;
        }

    
        throw new \DomainException("Criação de conta cancelada: Plano de conta inválido.");
    }



    public function closeAccount(string $cardCode, string $password): void
    {
        if (! $account = $this->acessAccount($cardCode)) {
            throw new \DomainException("Ação interrompida: Conta não existe.");
        }

        if ( ! $this->validate($account, $password) ) {
            throw new \DomainException("Ação interrompida: Senha incorreta.");
        }


        unset($this->Vault[$cardCode]);
        $this->nextAccountCode = count($this->Vault);
        
        return;
    }

}