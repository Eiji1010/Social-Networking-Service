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
        $this->log("Creating migration table");
        $mysqli = new MySQLWrapper();

        $result = $mysqli->query("
            CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            filename VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");

        if ($result === false) throw new \Exception("Failed to create migration table");

        $this->log("Migration table created");
    }

    private function getLastMigrationFile(): ?string
    {
        $mysqli = new MySQLWrapper();
        $result = $mysqli->query("SELECT filename FROM migrations ORDER BY id DESC LIMIT 1");

        if ($result && $result->num_rows === 0){
            $rows = $result->fetch_assoc();
            return $rows['filename'];
        }
        return null;
    }

    private function getAllMigrations(string $order='asc'): array
    {
        $directory = sprintf("%s/../../Database/Migrations", __DIR__);
        $allFiles = glob($directory . '/*.php');

        usort ($allFiles, function($a, $b) use($order){
            $compareResult = strcmp($a, $b);
            return $order === 'desc' ? -$compareResult: $compareResult;
        });
        return $allFiles;
    }

    private function getClassNameFromMigrationFile(string $filename): string
    {
        if (preg_match("/([^_]+)\.php$/", $filename, $matches)) return sprintf("Database\Migrations\%s", $matches[1]);
        else throw new \Exception("Unexpected migration file name");
    }

    private function processQueries(array $queries)
    {
        $mysqli = new MySQLWrapper();

        foreach ($queries as $query){
            $result = $mysqli->query($query);
            if ($result === false) throw new \Exception("Failed to run query: $query");
        }
    }

    private function insertMigration(string $filename): void
    {
        $mysqli = new MySQLWrapper();
        $statement = $mysqli->prepare("INSERT INTO migrations (filename, created_at) VALUES (?, NOW())");
        $statement->bind_param('s', $filename);
        if (!$statement->execute()) throw new \Exception("Failed to insert migration table");

        $statement->close();
    }
}