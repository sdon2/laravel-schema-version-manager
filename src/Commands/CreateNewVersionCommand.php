<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager\Commands;

use HansoftTechnologies\LaravelSchemaVersionManager\Models\VersionManager;
use Illuminate\Console\Command;

class CreateNewVersionCommand extends Command
{
    public $signature = 'lsvm:new'; // Laravel Schema Version Manager

    public $description = 'Create new database version';

    public function handle(): int
    {
        $manager = VersionManager::query()->first();
        $schema = $manager->schema_version ?? time();
        $db = $manager->db_version ?? null;

        if ($schema === $db) {
            $this->createNewVersion($schema, $db);
        }
		else {
			$this->warn('Versions already match!!');
		}

        $this->comment('All done');

        return self::SUCCESS;
    }

    private function createNewVersion($schema_version, $db_version)
    {
        $schema_version = time();
        $data = [
            'schema_version' => $schema_version,
            'db_version' => $db_version,
        ];
		
		$manager = VersionManager::query()->first();
		
		if (!$manager) {
			VersionManager::query()->create($data);
		}
		else {
			$manager->update($data);
		}
    }
}
