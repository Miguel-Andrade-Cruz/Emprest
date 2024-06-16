<?php

namespace minuz\emprest\model\Interface\Derivatives\Nacional;

// Extenders

use minuz\emprest\model\Interface\Concept\AccountInterfaceAbstraction;
use minuz\emprest\model\Interface\Derivatives\Default\SavingsInterface;

// Bank
use minuz\emprest\model\Bank\Derivatives\Nacional;
use minuz\emprest\model\Interface\Concept\PayOffInterface;

class NacionalSavingsInterface extends SavingsInterface implements AccountInterfaceAbstraction, PayOffInterface
{
    public function __construct(string $title, string $cardCode, Nacional $Bank)
    {
        parent::__construct($title, $cardCode, $Bank);
    }



    public function payOff(string $password): void
    {
        $this->Bank->payOff($this->cardCode, $password);
    }
}