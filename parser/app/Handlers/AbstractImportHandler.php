<?php

namespace App\Handlers;

use App\Exceptions\ImportException;
use App\Factories\ValidatorFactoryInterface;
use App\Import\ImportRowInterface;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Throwable;
use Generator;

abstract class AbstractImportHandler implements ImportHandlerInterface, ServiceSubscriberInterface
{
    final public function __construct(protected readonly ContainerInterface $container)
    {
    }

    public function handle(File $file): void
    {
        $errors = [];
        $rowIndex = 0;

        foreach ($this->getIterator($file) as $row) {
            ++$rowIndex;

            $importRow = $this->getImportRow($rowIndex, $row);
            $validator = $this->getValidatorFactory()->createValidation($importRow->getData(), $this->getRules());

            if (!$validator->fails()) {
                $this->handleRow($importRow);
            } else {
                Log::info(
                    "В файле импорта {$file->getFilename()} на строке {$rowIndex} ошибки: " .
                    serialize($validator->errors()->messages())
                );

                $errors[] = ['messages' => $validator->errors()->messages(), 'row' => $importRow];
            }
        }

        if ($errors) {
            throw new ImportException($errors);
        }
    }


    private function getValidatorFactory(): ValidatorFactoryInterface
    {
        return $this->container->get(ValidatorFactoryInterface::class);
    }


    abstract protected function getIterator(File $file): Generator;
    abstract public function getImportRow(int $rowIndex, mixed $row): ImportRowInterface;
    abstract public function getRules(): array;
    abstract protected function handleRow(ImportRowInterface $row): void;

    public static function getSubscribedServices(): array
    {
        return
        [
            ValidatorFactoryInterface::class,
        ];
    }

    public static function getDefaultPriority(): int
    {
        return 0;
    }
}
