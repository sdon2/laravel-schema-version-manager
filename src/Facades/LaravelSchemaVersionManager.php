<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hansoft Technologies\LaravelSchemaVersionManager\LaravelSchemaVersionManager
 */
class LaravelSchemaVersionManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \HansoftTechnologies\LaravelSchemaVersionManager\LaravelSchemaVersionManager::class;
    }
}
