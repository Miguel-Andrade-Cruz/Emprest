<?php

namespace minuz\emprest\test\service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use minuz\emprest\model\Accounts\Concept\Account;
use minuz\emprest\model\Clients\Client;
use minuz\emprest\model\Banks\Structure\Bank;
use minuz\emprest\model\Banks\Banks\{
    BankEmprest,
    NoBank,
    Itayou
};


final class AccountTest extends TestCase
{
    private static Bank $Bank;
    private static string $cardCode;
    private static string $password;

    public function tearDown(): void
    {
        self::$Bank->closeAccount(self::$cardCode, self::$password);
    }
    
    
    #[DataProvider('bankDepositsDataProvider')]
    public function testDeposits($bank, $cardCode, $password, $value, $expectedValue)
    {
        $client = new Client("Client");
        $client->openAccount("Title", "abc", "Poupança", $bank);
        
        $acc = $client->acessAccount("Title", $cardCode, $password);

        self::$Bank = $bank;
        self::$cardCode = $cardCode;
        self::$password = $password;
        
        $acc->deposit($password, $value);

        $this->assertEquals($expectedValue, $acc->viewBudget($password));
    }



    #[DataProvider('bankDraftsDataProvider')]
    public function testDrafts($bank, $cardCode, $password, $value, $expectedValue)
    {
        $client = new Client("Client");
        $client->openAccount("Title", $password, "Poupança", $bank);
        
        $acc = $client->acessAccount("Title", $cardCode, $password);

        self::$Bank = $bank;
        self::$cardCode = $cardCode;
        self::$password = $password;
        
        $acc->draft($password, $value);

        $this->assertEquals($expectedValue, $acc->viewBudget($password));
    }



    public static function bankDepositsDataProvider(): array
    {

        return [
            "BankEmprest account int value" => [new BankEmprest, "07-0001", "abc", 200, 200],
            "NoBank account int value"      => [new NoBank, "02-0001", "abc", 200, 200],
            "Itayou account int value"      => [new Itayou, "09-0001", "abc", 200, 200],

            "BankEmprest account float value" => [new BankEmprest, "07-0001", "abc", 10.15, 10.15],
            "NoBank account float value"      => [new NoBank, "02-0001", "abc", 10.15, 10.15],
            "Itayou account float value"      => [new Itayou, "09-0001", "abc", 10.15, 10.15],

            "BankEmprest account multiple decimals" => [new BankEmprest, "07-0001", "abc", 2.232524, 2.23],
            "NoBank account multiple decimals"      => [new NoBank, "02-0001", "abc", 2.232524, 2.23],
            "Itayou account multiple decimals"      => [new Itayou, "09-0001", "abc", 2.232524, 2.23],
        ];
    }



    public static function bankDraftsDataProvider(): array
    {
        return [
            "Draft BankEmprest account int value" => [new BankEmprest, "07-0001", "abc", 200, -200],
            "Draft Itayou account int value"      => [new Itayou, "09-0001", "abc", 200, -200],

            "Draft BankEmprest account float value" => [new BankEmprest, "07-0001", "abc", 10.15, -10.15],
            "Draft NoBank account float value"      => [new NoBank, "02-0001", "abc", 10.15, -10.15],
            "Draft Itayou account float value"      => [new Itayou, "09-0001", "abc", 10.15, -10.15],

            "Draft BankEmprest account multiple decimals" => [new BankEmprest, "07-0001", "abc", 2.232524, -2.23],
            "Draft NoBank account multiple decimals"      => [new NoBank, "02-0001", "abc", 2.232524, -2.23],
            "Draft Itayou account multiple decimals"      => [new Itayou, "09-0001", "abc", 2.232524, -2.23],
        ];
    }
}