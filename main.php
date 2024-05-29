<?php

require_once __DIR__ . "../vendor/autoload.php";

use minuz\emprest\model\Banks\Banks\{BankEmprest, Itayou, NoBank};
use minuz\emprest\model\Clients\Client;


$client1 = new Client("Client");
$client2 = new Client("Client");
$client3 = new Client("Client");

$client1->openAccount("Title", "abc", "Poupança", new BankEmprest);
$client2->openAccount("Title", "abc", "Poupança", new NoBank);
$client3->openAccount("Title", "abc", "Poupança", new Itayou);

$acc1 = $client1->acessAccount("Title", "07-0001", "abc");
$acc2 = $client2->acessAccount("Title", "02-0001", "abc");
$acc3 = $client3->acessAccount("Title", "09-0001", "abc");

