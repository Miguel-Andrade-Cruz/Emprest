<?php

namespace minuz\emprest\model\Banks\Banks;

use minuz\emprest\model\Banks\Structure\Bank;
use minuz\emprest\model\Banks\Manager\AccountManager;


final class Itayou extends Bank
{
    protected const BANK_ID = "09-";
    
    protected static float $vault = 15_000_000;
    protected static int $nextAccountCode = 0;
    protected static array $storage = [];



    public static array $loanPlans = [
        "Pricy plan" => ["Portions" => 2, "Interest" => 1.7],
        "Medium plan" => ["Portions" => 4, "Interest" => 1.3],
        "Soft plan" => ["Portions" => 6, "Interest" => 1.05]
    ];
}