<?php

namespace App\Handlers;

use App\Command\ImportCarCommandHandlerInterface;
use App\DTO\CarDTO;
use App\Enums\CarImport;
use App\Enums\Import;
use App\Import\CarImportRow;
use App\Import\ImportRowInterface;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\DomCrawler\Crawler;

final class ImportCarHandler extends AbstractImportFeedHandler
{
    public final const ROOT_NODE_FILTER = 'auto-catalog > offers > offer';

    public function canHandle(Import $import): bool
    {
        return Import::CAR === $import;
    }

    /**
     * @param CarImportRow $row
     */
    public function handleRow(ImportRowInterface $row): void
    {
        $this->getImportCarCommandHandler()->handle($row->getCar());
    }

    /**
     * @throws UnknownProperties
     */
    public function getImportRow(int $rowIndex, mixed $row): CarImportRow
    {
        $car = new CarDTO(
            id: $row->filter(CarImport::ID->value)->text(),
            mark: $row->filter(CarImport::MARK->value)->text(),
            model: $row->filter(CarImport::MODEL->value)->text(),
            generation: $row->filter(CarImport::GENERATION->value)->text(),
            year: $row->filter(CarImport::YEAR->value)->text(),
            run: $row->filter(CarImport::RUN->value)->text(),
            color: $row->filter(CarImport::COLOR->value)->text(),
            bodyType: $row->filter(CarImport::BODY_TYPE->value)->text(),
            engineType: $row->filter(CarImport::ENGINE_TYPE->value)->text(),
            transmission: $row->filter(CarImport::TRANSMISSION->value)->text(),
            gearType: $row->filter(CarImport::GEAR_TYPE->value)->text(),
            generationId: $row->filter(CarImport::GENERATION_ID->value)->text(),
        );

        return new CarImportRow($rowIndex, $car);
    }

    public function getRules(): array
    {
        return
            [
                'id' => 'required|digits_between:1,11',
                'mark' => 'required|max:255',
                'model' => 'required|max:255',
                'generation' => 'required|max:255',
                'year' => 'required|integer|digits:4',
                'run' => 'required|integer|digits_between:1,11',
                'color' => 'required|max:255',
                'bodyType' => 'required|max:255',
                'engineType' => 'required|max:255',
                'transmission' => 'required|max:255',
                'gearType' => 'required|max:255',
                'generationId' => 'required|integer|digits_between:1,11',
            ];
    }

    private function getImportCarCommandHandler(): ImportCarCommandHandlerInterface
    {
        return $this->container->get(ImportCarCommandHandlerInterface::class);
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            ImportCarCommandHandlerInterface::class,
        ]);
    }
}
