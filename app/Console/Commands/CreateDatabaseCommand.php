<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDOException;
use function env;
use function sprintf;

class CreateDatabaseCommand extends Command
{
    protected $signature = 'db:create';

    protected $description = 'Creates or refresh the configured database';

    public function handle(): void
    {
        $database = env('DB_DATABASE', false);

        if (!$database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');
            return;
        }

        try {
            DB::statement(
                sprintf('CREATE DATABASE IF NOT EXISTS %s;', $database)
            );

            $this->info(sprintf('Successfully created %s database', $database));
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database, $exception->getMessage()));
        }
    }
}
