<?php

namespace App\Providers;

use App\Command\ImportCarCommandHandler;
use App\Command\ImportCarCommandHandlerInterface;
use App\Enums\Import;
use App\Factories\ValidatorFactory;
use App\Factories\ValidatorFactoryInterface;
use App\Handlers\ImportCarHandler;
use App\Handlers\Resolvers\ImportHandlerResolver;
use App\Handlers\Resolvers\ImportHandlerResolverInterface;
use App\Parsers\Xml\XmlParser;
use App\Parsers\Xml\XmlParserInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(XmlParserInterface::class, XmlParser::class);
        $this->app->bind(ImportHandlerResolverInterface::class, ImportHandlerResolver::class);
        $this->app->bind(ImportCarCommandHandlerInterface::class, ImportCarCommandHandler::class);
        $this->app->bind(ValidatorFactoryInterface::class, ValidatorFactory::class);
        $this->app->tag([ImportCarHandler::class], Import::PROVIDER_TAG->value);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
