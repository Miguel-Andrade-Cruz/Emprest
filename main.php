<?php

require_once __DIR__ . "../vendor/autoload.php";

use minuz\emprest\model\Bank\Derivatives\{BankEmprest, NoBank, Itayou, Saotende};
use minuz\emprest\model\Client\Structure\Client;


$Itayou = new Itayou();
$Saotende = new Saotende();

$Joao = new Client("João");
$Maria = new Client("Maria");

$Joao->openAccount("Conta", "abc", "Poupança", $Itayou);
$Maria->openAccount("Title", "qwe", "Poupança", $Saotende);

$contaJoao = $Joao->acessAccount("Conta", "09-0001", "abc");
$contaMaria = $Maria->acessAccount("Title", "05-0001", "qwe");

$contaJoao->purchaseLoan("abc", 2_000);
$contaMaria->purchaseLoan("qwe", 1_000);

echo $contaJoao->viewLoanStatus("abc");
echo $contaMaria->viewLoanStatus("qwe");