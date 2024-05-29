<?php

namespace minuz\emprest\test\service;

use minuz\emprest\model\Banks\Structure\Bank;
use minuz\emprest\model\Clients\Client;
use minuz\emprest\model\Banks\Banks\{
    BankEmprest,
    NoBank,
    Itayou
};

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class LoanTest extends TestCase
{
    private static Bank $Bank;
    private static string $cardCode;
    private static string $password;
    



    #[DataProvider('additionProvider')]
    public function testVerifyLoansInfo($bank, $cardCode, $password, $loan)
    {
        self::$Bank = $bank;
        self::$cardCode = $cardCode;
        self::$password = $password;

        $client = new Client("Client");
        $client->openAccount("Title", $password, "Poupança", $bank);
        
        $acc = $client->acessAccount("Title", $cardCode, $password);
        $acc->takeLoan($password, $loan);

    }
    
    
    
    
    public function tearDown(): void
    {
        self::$Bank->closeAccount(self::$cardCode, self::$password);
    }

    // DATA PROVIDER

    public static function additionProvider(): array
    {
        return [
            "BankEmprest" => [new BankEmprest, "07-0001", "abc", 200],
            "NoBank" => [new NoBank, "02-0001", "abc", 200],
            "Itayou" => [new Itayou, "09-0001", "abc", 200],
        ];
    }

}
