<?php

namespace minuz\emprest\model\Clients;

use minuz\emprest\model\Banks\Structure\Bank;
use DomainException;
use minuz\emprest\model\Accounts\Interface\{
    InvestAccountInterface,
    SavingsAccountInterface
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
        $title = $account->title;

        $this->myAccounts[$title] = $account;
    }


    public function acessAccount(string $title, string $cardCode, string $password): SavingsAccountInterface|InvestAccountInterface
    {
        if (! array_key_exists($title, $this->myAccounts)) {
            throw new DomainException("Acesso negado: Essa conta não existe.");
        }
        $account = $this->myAccounts[$title];
        
        $account->acessAccount($cardCode, $password);
        
        return $account;
    }
}