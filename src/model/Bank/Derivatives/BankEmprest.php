<?php

namespace minuz\emprest\model\Banks\Banks;

use minuz\emprest\model\Banks\Manager\Manager;
use minuz\emprest\model\Banks\Structure\Bank;

final class BankEmprest extends Bank
{
    protected static string $BANK_ID = "07";
    protected static Manager $Manager;
    
    protected static float $Safe = 10_000_000;



    public function __construct()
    {
        self::$Manager = new Manager($this, self::$BANK_ID);
    }
}