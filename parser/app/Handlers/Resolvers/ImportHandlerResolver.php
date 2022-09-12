<?php

namespace App\Handlers\Resolvers;

use App\Enums\Import;
use App\Handlers\ImportHandlerInterface;
use Psr\Container\ContainerInterface;

class ImportHandlerResolver implements ImportHandlerResolverInterface
{
    public function __construct(private readonly ContainerInterface $container)
    {
    }

    public function getHandler(Import $import): ImportHandlerInterface
    {
        /** @var ImportHandlerInterface $parsers */
        $handlers =  $this->container->tagged(Import::PROVIDER_TAG->value);

        foreach ($handlers as $handler) {
            if ($handler->canHandle($import)) {
                return $handler;
            }
        }

        throw new \RuntimeException(sprintf('No handler for import %s', $import->value));
    }
}
