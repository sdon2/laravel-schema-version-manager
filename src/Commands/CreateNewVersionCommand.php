<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateNewVersionCommand extends Command
{
    public $signature = 'lsvm:new'; // Laravel Schema Version Manager

    public $description = 'Create new database version';

    public function handle(): int
    {
        $manager = DB::table('version_manager')->first();
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
        $schema_version++;
        $data = [
            'schema_version' => $schema_version,
            'db_version' => $db_version,
        ];

        $manager = DB::table('version_manager')->first();

        if (!$manager) {
            DB::table('version_manager')->insert($data);
        }
        else {
            $manager->update($data);
        }
    }
}
