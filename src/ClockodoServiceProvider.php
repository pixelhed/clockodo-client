<?php

namespace Fs98\Clockodo;

use Fs98\Clockodo\Commands\ClockodoCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ClockodoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('clockodo-client')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_clockodo-client_table')
            ->hasCommand(ClockodoCommand::class);
    }
}
