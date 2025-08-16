<?php

namespace Vented\EnhanceApiLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vented\EnhanceApiLaravel\Client\Configuration;

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
            ->hasConfigFile('enhance');
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(Configuration::class, function ($app) {
            $config = $app['config']['enhance'];
            
            $configuration = new Configuration();
            
            if (!empty($config['api_key'])) {
                $configuration->setAccessToken($config['api_key']);
            }
            
            if (!empty($config['base_url'])) {
                $configuration->setHost($config['base_url']);
            }
            
            return $configuration;
        });

        $this->app->singleton(EnhanceApiLaravel::class, function ($app) {
            return new EnhanceApiLaravel($app->make(Configuration::class));
        });
    }
}
