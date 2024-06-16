<?php

namespace minuz\emprest\model\Interface\Derivatives\Nacional;

// Extenders
use minuz\emprest\model\Interface\Concept\AccountInterfaceAbstraction;
use minuz\emprest\model\Interface\Derivatives\InvestInterface\InvestInterface;

// Bank
use minuz\emprest\model\Bank\Derivatives\Nacional;


class NacionalInvestInterface extends InvestInterface implements AccountInterfaceAbstraction
{
    public function __construct(string $title, string $cardCode, Nacional $Bank)
    {
        parent::__construct($title, $cardCode, $Bank);
    }

}