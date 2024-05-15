<?php

namespace minuz\emprest\model;

use minuz\emprest\model\Account;

class BankEmprest
{
    protected static array $accounts = [];
    
    public static array $plans = [
        "Pricy plan" => ["Portions" => 4, "Interest" => 1.6],
        "Medium plan" => ["Portions" => 8, "Interest" => 1.4],
        "Soft plan" => ["Portions" => 12, "Interest" => 1.2]
    ];
    
    
    public static function createAccount(string $name, string $accountCode, string $password)
    {
        $newAccount = new Account($name, $accountCode, $password);
        self::$accounts[$accountCode] = $newAccount;
        return $newAccount;
    }


    public static function purchaseLoan($loan, $choosedPlan): Loan|false
    {
        $is_Valid_plan = array_key_exists($choosedPlan, self::$plans);
        if (! $is_Valid_plan) {
            echo PHP_EOL . "Empréstimo negado. Analise as informações e tente novamente." . PHP_EOL;
            return false;
        }

        $amount = $loan * self::$plans[$choosedPlan]["Interest"];
        $portions = self::$plans[$choosedPlan]["Portions"];
        
        return new Loan($loan, $amount, $portions);
    }


    public static function transaction(Account $accountFrom, Account $accountTo, int $amount): void
    {
        self::$accounts[$accountTo->getAccountCode()]->deposit($amount);
    }
}