<?php

require_once __DIR__ . "../vendor/autoload.php";

use minuz\emprest\model\Bank\Derivatives\Itayou;
use minuz\emprest\model\Client\Structure\Client;

$Itayou = new Itayou();

$Charlie = new Client("Bob");


$cardCode = $Charlie->openAccount("Charlie's Account", "23232", "Poupança", $Itayou);
$charlieAccount = $Charlie->acessAccount("Charlie's Account", $cardCode, "23232");


$charlieAccount->purchaseLoan("23232", 5_000);

$charlieAccount->payLoanPortions("23232", 2);

$charlieAccount->viewLoanStatus("23232"); // Outputs amount, portion date and portion value to pay
