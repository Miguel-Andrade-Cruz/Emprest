<?php

namespace minuz\emprest\model;

use minuz\emprest\model\Account;


class Client
{
    public readonly string $name;
    protected array $myAccounts;

    public function __construct(string $name, Account $account)
    {
        $this->name = $name;
        $this->myAccounts[$account->getAccountCode()] = $account;
    }


    public function createNewAccount(string $accountCode, string $password): void
    {
        $newAccount = BankEmprest::createAccount($this->name, $accountCode, $password);
        $this->myAccounts[$newAccount->getAccountCode()] = $newAccount;
    }


    public function deposit($account, $amount): void
    {
        $this->myAccounts[$account]->deposit($account, $amount);
    }


    public function purchaseLoan(string $account, int  $amount, string $plan): void
    {
        $this->myAccounts[$account]->purchaseLoan($amount, $plan);
        return;
    }


    public function checkLoanAmount(string $account): int|false
    {
        if (! $loanAmount = $this->myAccounts[$account]->checkLoanAmount()) {
            echo PHP_EOL . "Não há empréstimos nessa conta." . PHP_EOL;
            return false;
        }
        return $loanAmount;
    }


    public function  checkRemainedPortions(string $account): int
    {
        return $this->myAccounts[$account]->checkRemainedPortions();
    }


    public function checkPortionsPrice(string $account): int
    {
        return $this->myAccounts[$account]->checkPortionsPrice();
    }


    public function getAccount(string $accountCode, string $password): Account|false
    {
        if ($password != $this->myAccounts[$accountCode]->getPassword()) {
            return false;
        }
        return $this->myAccounts[$accountCode];
    }


    public function getName(): string
    {
        return $this->name;
    }
}