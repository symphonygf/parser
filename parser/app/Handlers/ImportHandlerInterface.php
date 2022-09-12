<?php

namespace App\Handlers;

use App\Enums\Import;
use Symfony\Component\HttpFoundation\File\File;

interface ImportHandlerInterface
{
    public function canHandle(Import $import): bool;

    public function handle(File $file): void;

    public static function getDefaultPriority(): int;
}
