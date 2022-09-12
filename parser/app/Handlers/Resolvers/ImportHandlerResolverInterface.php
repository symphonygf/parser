<?php

namespace App\Handlers\Resolvers;

use App\Enums\Import;
use App\Handlers\ImportHandlerInterface;

interface ImportHandlerResolverInterface
{
    public function getHandler(Import $import): ImportHandlerInterface;
}
