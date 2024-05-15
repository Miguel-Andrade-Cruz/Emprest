<?php

require_once __DIR__ . "../vendor/autoload.php";

use minuz\emprest\model\Client;
use minuz\emprest\model\Account;



$alex = new Client("Alexandre", new Account("Alexandre", "111", "123123"));
        

$alex->purchaseLoan("111", 2000, "Soft plan");
