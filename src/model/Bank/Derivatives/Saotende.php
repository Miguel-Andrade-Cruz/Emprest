<?php

namespace minuz\emprest\model\Banks\Banks;

use minuz\emprest\model\Banks\Manager\Manager;
use minuz\emprest\model\Banks\Structure\Bank;

final class Saotende extends Bank
{
    protected static $BANK_ID = "05";
    protected static Manager $Manager;
    
    protected static float $Safe = 200_000_000;



    public function __construct()
    {
        self::$Manager = new Manager($this, self::$BANK_ID);
    }
}