<?php

namespace minuz\emprest\model\Banks\Banks;

use minuz\emprest\model\Banks\Manager\Manager;
use minuz\emprest\model\Banks\Structure\Bank;

final class Itayou extends Bank
{
    protected static string $BANK_ID = "09";
    protected static Manager $Manager;
    
    protected static float $Safe = 15_000_000;



    public function __construct()
    {
        self::$Manager = new Manager($this, self::$BANK_ID);
    }
}