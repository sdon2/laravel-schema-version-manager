<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class MigrateCommand extends Command
{
    public $signature = 'lsvm:migrate'; // Laravel Schema Version Manager

    public $description = 'Migrate database version to schema version';

    public function handle(): int
    {
        $manager = DB::table('version_manager')->first();
        $schema = $manager->schema_version ?? time();
        $db = $manager->db_version ?? null;

        if ($schema !== $db) {
            $this->runMigrations();
        }
		else {
			$this->warn('Versions match!! Nothing to migrate!');
		}

        $this->comment('All done');

        return self::SUCCESS;
    }

    private function runMigrations()
    {
        ini_set('set_time_limit', 0);

        Artisan::call('migrate');

        $manager = DB::table('version_manager')->first();

        $version = $manager->schema_version ?? time();

        $data = [
            'schema_version' => $version,
            'db_version' => $version,
        ];

        if (!$manager) {
            DB::table('version_manager')->insert($data);
        }
        else {
            $manager->update($data);
        }
    }
}
