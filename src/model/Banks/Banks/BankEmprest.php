<?php

namespace minuz\emprest\model\Banks\Banks;

use minuz\emprest\model\Banks\Structure\Bank;
use minuz\emprest\model\Banks\Manager\Manager;

final class BankEmprest extends Bank
{
    
    protected const BANK_ID = "07-";

    protected static float $vault = 10_000_000;
    protected static int $nextAccountCode = 0;
    protected static array $storage = [];

    public static array $loanPlans = [
        "Pricy plan" => ["Portions" => 4, "Interest" => 1.6],
        "Medium plan" => ["Portions" => 8, "Interest" => 1.4],
        "Soft plan" => ["Portions" => 12, "Interest" => 1.2]
    ];
}