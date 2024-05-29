<?php

namespace minuz\emprest\model\Banks\Banks;

use minuz\emprest\model\Banks\Structure\Bank;

final class NoBank extends Bank
{
    protected const BANK_ID = "02-";

    protected static float $vault = 15_000_000;
    protected static int $nextAccountCode = 0;
    protected static array $storage = [];



    public static array $loanPlans = [
        "Pricy plan" => ["Portions" => 3, "Interest" => 1.4],
        "Medium plan" => ["Portions" => 10, "Interest" => 1.2],
        "Soft plan" => ["Portions" => 24, "Interest" => 1.1]
    ];


}
