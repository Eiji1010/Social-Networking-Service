<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class Migrate extends AbstractCommand
{
    protected static ?string $alias = 'migrate';

    public static function getArguments(): array
    {
        return [
            (new Argument('rollback')->description('Rollback the last migration')->allowAsShort(true)->required(false)),
            (new Argument('init')->description('Create migration table if it does not exist')->allowAsShort(true)->required(false)),
        ];
    }

    public function execute(): int
    {
        $rollback = $this->getArgumentValue('rollback');

        if ($this->getArgumentValue('init')) {
            $this->createMigrationTable();
        }

        if ($rollback === false){
            $this->log("Starting migration");
            $this->migrate();
        }
        else{
            $rollbackN = $rollback === true ? 1: (int)$rollback;
            $this->rollback($rollbackN);
        }
        return 0;
    }

    private function migrate(): void
    {
        $this->log("Running migrations...");

        $lastMigrationFile = $this->getLastMigrationFile();

        /* @var string[] $allMigrationFiles */
        $allMigrationFiles = $this->getAllMigrations();
        $startIndex = ($lastMigrationFile)? array_search($lastMigrationFile, $allMigrationFiles) + 1: 0;

        for ($i = $startIndex; $i < count($allMigrationFiles); $i++){
            $filename = $allMigrationFiles[$i];
            include_once($filename);

            $migrateClassName = $this->getClassNameFromMigrationFile($filename);
            $migration = new $migrateClassName();

            /* @var string[] $queries */
            $queries = $migration->up();

            if (empty($queries)) throw new \Exception("Migration must return queries");

            $this->processQueries($queries);
            $this->insertMigration($filename);
        }
        $this->log("Migration completed");
    }

    private function rollback(int $rollbackN)
    {
    }

    private function createMigrationTable()
    {
    }

    private function getLastMigrationFile(): string
    {
    }

    private function getAllMigrations(): array
    {
    }

    private function getClassNameFromMigrationFile(string $filename): string
    {
    }

    private function processQueries(array $queries)
    {
    }

    private function insertMigration(string $filename)
    {
    }
}