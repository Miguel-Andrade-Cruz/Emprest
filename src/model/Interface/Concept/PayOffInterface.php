<?php

namespace minuz\emprest\model\Interface\Concept;

interface PayOffInterface
{
    public function payOff(string $password): void;
}