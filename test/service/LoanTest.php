<?php

namespace minuz\emprest\test\service;

use minuz\emprest\model\Banks\Structure\static;
use minuz\emprest\model\Clients\Client;
use minuz\emprest\model\Banks\BanksData\{
    BankEmprest,
    NoBank,
    Itayou
};
use minuz\emprest\model\Banks\Structure\Bank;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class LoanTest extends TestCase
{
    private static Bank $Bank;
    private static string $cardCode;
    private static string $password;
    



    #[DataProvider('additionProvider')]
    public function testVerifyLoansInfo($bank, $cardCode, $password, $loan, $expected)
    {
        self::$Bank = $bank;
        self::$cardCode = $cardCode;
        self::$password = $password;

        $client = new Client("Client");
        $client->openAccount("Title", $password, "Poupança", $bank);
        
        $acc = $client->acessAccount("Title", $cardCode, $password);
        
        $acc->takeLoan($password, $loan, "Pricy plan");


        $this->assertEquals($expected, $acc->viewLoan($password)["Amount"]);
    }
    
    
    
    
    public function tearDown(): void
    {
        self::$Bank->closeAccount(self::$cardCode, self::$password);
    }

    // DATA PROVIDER

    public static function additionProvider(): array
    {
        return [
            "BankEmprest" => [new static(BankEmprest::transferData()), "07-0001", "abc", 2_000, 3_200],
            "NoBank" => [new static(NoBank::transferData()), "02-0001", "abc", 2_000, 2_799.97, ],
            "Itayou" => [new static(Itayou::transferData()), "09-0001", "abc", 2_000, 3_400],
        ];
    }

}
