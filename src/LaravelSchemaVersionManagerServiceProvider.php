<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager;

use HansoftTechnologies\LaravelSchemaVersionManager\Commands\CheckCommand;
use HansoftTechnologies\LaravelSchemaVersionManager\Commands\CreateNewVersionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HansoftTechnologies\LaravelSchemaVersionManager\Commands\LaravelSchemaVersionManagerCommand;
use HansoftTechnologies\LaravelSchemaVersionManager\Commands\MigrateCommand;

class LaravelSchemaVersionManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-schema-version-manager')
            ->hasMigration('create_schema_version_table')
            ->hasCommands(
                CheckCommand::class,
                MigrateCommand::class,
                CreateNewVersionCommand::class,
            );
    }
}
