<?php

require_once __DIR__ . "../vendor/autoload.php";

use minuz\emprest\model\Bank\Derivatives\{BankEmprest, NoBank, Itayou, Saotende, Nacional};
use minuz\emprest\model\Client\Structure\Client;



$Itayou = new Itayou();
$Saotende = new Saotende();
$Nacional = new Nacional();



$Joao = new Client("João");
$Maria = new Client("Maria");
$Pedro = new Client("Pedro");


$Pedro->openAccount("Conta do Pedro", "pp", "Poupança", $Nacional);
$Joao->openAccount("title", "pass", "Poupança", $Itayou);

$contaPedro = $Pedro->acessAccount("Conta do Pedro", "04-0001", "pp");

$contaPedro->purchaseLoan('pp', 2_000);
echo $contaPedro->viewLoanStatus("pp");



$contaPedro->payOff("pp");
echo $contaPedro->viewLoanStatus("pp");




