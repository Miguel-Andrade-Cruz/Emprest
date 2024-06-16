<?php

namespace minuz\emprest\model\Bank\Concept;

interface PayOffFeature
{
    public function payOff(string $cardCode, string $password): void;
}