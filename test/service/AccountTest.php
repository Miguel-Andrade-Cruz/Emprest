<?php
namespace minuz\emprest\test\service;

use minuz\emprest\model\Account;
use minuz\emprest\model\BankEmprest;
use minuz\emprest\model\Client;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;


final class AccountTest extends TestCase
{    
    #[DataProviderExternal(PaymentPortionTestData::class, 'additionProvider')]
    public function testPortionToPay($portion, $expected)
    {
        $this->assertEquals($expected, $portion);
    }
    

    
    #[DataProviderExternal(AccountBalanceTestData::class, 'additionProvider')]
    public function testAccountBalance($accountToCheck, $anotherAccount, $recieving, $paying, $expected)
    {
        $anotherAccount->transfer($accountToCheck, $recieving, "123123");
        $accountToCheck->transfer($anotherAccount, $paying, "123123");
        
        $this->assertEquals($expected, $accountToCheck->checkBalance());
    }
}




final class PaymentPortionTestData
{
    public static function additionProvider(): array
    {
        $ana = new Client("Ana", BankEmprest::createAccount("Ana", "111", "123123"));
        $alan = new Client("Alan", BankEmprest::createAccount("Alan", "222", "123123"));
        $roy = new Client("Roy", BankEmprest::createAccount("Roy", "333", "123123"));
        
        $ana->purchaseLoan("111", 4000, "Soft plan");
        $alan->purchaseLoan("222", 12000, "Medium plan");
        $roy->purchaseLoan("333", 700, "Pricy plan");

        return [
            "Soft plan test" => [$ana->checkPortionsPrice("111"), 400],
            "Medium plan test" => [$alan->checkPortionsPrice("222"), 2100],
            "Pricy plan test" => [$roy->checkPortionsPrice("333"), 280]
        ];
    }
}


final class AccountBalanceTestData
{
    public static function additionProvider(): array
    {
        $alan = new Client("Alan", BankEmprest::createAccount("Alan", "111", "123123"));        
        $ana = new Client("Ana", BankEmprest::createAccount("Ana", "222", "123123"));
        
        return [
            "First transaction" => [$alan->getAccount("111", "123123"), $ana->getAccount("222", "123123"), 250, 200, 50],
            "Second transaction" => [$alan->getAccount("111", "123123"), $ana->getAccount("222", "123123"), 4300, 4000, 350],
            "Third transaction" => [$alan->getAccount("111", "123123"), $ana->getAccount("222", "123123"), 100, 0, 450]
        ];
    }
}


