<?php

namespace minuz\emprest\model\Client\Structure;

use minuz\emprest\model\Bank\Structure\Bank;

use minuz\emprest\model\Interface\Concept\PayOffInterface;

use minuz\emprest\model\Interface\Derivatives\Default\{
    
    InvestInterface,
    SavingsInterface
};

class Client
{

    public readonly string $name;
    protected array $myAccounts;



    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function openAccount(string $title, string $password, string $accountPlan, Bank $Bank): void
    {
        $account = $Bank->openAccount($title, $password, $accountPlan);

        $this->myAccounts[$title] = $account;
    }


    public function acessAccount(string $title, string $cardCode, string $password): SavingsInterface|InvestInterface|PayOffInterface   {
        if (! array_key_exists($title, $this->myAccounts)) {
            throw new \DomainException("Acesso negado: Essa conta não existe.");
        }
        $account = $this->myAccounts[$title];
        
        $account->acessAccount($cardCode, $password);
        
        return $account;
    }
    
    
    public function shareTranferenceData(string $title, string $password): array
    {
        if (! array_key_exists($title, $this->myAccounts)) {
            throw new \DomainException("Acesso negado: Essa conta não existe.");
        }

        $account = $this->myAccounts[$title];
        $tranferenceData = $account->shareTransferenceData($password);

        return $tranferenceData;
    }
}