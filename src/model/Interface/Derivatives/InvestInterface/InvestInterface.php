<?php

namespace minuz\emprest\model\Interface\Derivatives\InvestInterface;
use minuz\emprest\model\Interface\Structure\AccountInterface;

class InvestInterface extends AccountInterface
{
    public function __construct($title, $cardCode, $Bank)
    {
        parent::__construct($title, $cardCode, $Bank);
    }
}