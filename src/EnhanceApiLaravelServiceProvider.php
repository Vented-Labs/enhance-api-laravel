<?php

namespace Vented\EnhanceApiLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vented\EnhanceApiLaravel\Commands\EnhanceApiLaravelCommand;

class EnhanceApiLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('enhance-api-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_enhance_api_laravel_table')
            ->hasCommand(EnhanceApiLaravelCommand::class);
    }
}
