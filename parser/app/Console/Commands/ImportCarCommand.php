<?php

namespace App\Console\Commands;

use App\Enums\Import;
use App\Exceptions\ImportException;
use App\Handlers\Resolvers\ImportHandlerResolverInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\File\File;
use Throwable;

class ImportCarCommand extends Command
{
    public const FILE_PATH = __DIR__ . '/../../../storage/app/public/data.xml';

    /**
     * @var string
     */
    protected $signature = 'import:car';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import car from feed';

    public function __construct(private ImportHandlerResolverInterface $importHandlerResolver)
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $path = $helper->ask(
            $input,
            $output,
            new Question('Путь к файлу: ', self::FILE_PATH)
        );

        $io = new SymfonyStyle($input, $output);
        $io->info('Начал импортировать');

        try {
            $this->importHandlerResolver->getHandler(Import::CAR)->handle(new File($path));
            $io->success('Импорт закончился успешно');
        } catch (ImportException $exception) {
            $io->warning('По некоторым строкам валидация не прошла');
            dd($exception->getErrors());
        }
        return 0;
    }
}
