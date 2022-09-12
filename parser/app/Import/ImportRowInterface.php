<?php

namespace App\Import;

interface ImportRowInterface
{
    public function getRowIndex(): int;
    public function getData(): array;
}
