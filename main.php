<?php

require_once __DIR__ . "../vendor/autoload.php";

use minuz\emprest\model\Banks\Banks\{BankEmprest, NoBank, Itayou};
use minuz\emprest\model\Clients\Client;


$Itayou = new Itayou();


$Joao = new Client("João");

$Joao->openAccount("Conta", "abc", "Poupança", $Itayou);

$contaJoao = $Joao->acessAccount("Conta", "09-0001", "abc");

$contaJoao->purchaseLoan("abc", 2_000);

print_r($contaJoao->viewLoan("abc"));
