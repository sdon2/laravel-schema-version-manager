<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class CheckCommand extends Command
{
    public $signature = 'lsvm:check'; // Laravel Schema Version Manager

    public $description = 'Check database version is same as schema version';

    public function handle(): int
    {
        $manager = DB::table('version_manager')->first();
        $schema = $manager->schema_version ?? time();
        $db = $manager->db_version ?? null;

        if ($schema !== $db) {
            $this->warn('DB versions mismatch. Please run `php artisan lsvm:migrate`');
        }
		else {
			$this->warn('Yaay!! Versions match!!');
		}

        $this->comment('All done');

        return self::SUCCESS;
    }
}
