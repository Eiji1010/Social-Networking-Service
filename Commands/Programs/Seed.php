<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;

class Seed extends AbstractCommand
{
    protected static ?string $alias = 'seed';
    protected static bool $requiredCommandValue = false;

    public static function getArguments(): array
    {
        return [
            (new Argument('name'))->description("Name of the seeder file that is to be generate")->required(true),
            (new Argument('count'))->description("Number of rows to be seeded")->required(false),
        ];
    }

    public function execute(): int
    {
        $fileName = $this->getArgumentValue('name');

        $count = $this->getArgumentValue('count') ?? 1;
        if ($count === null || $count === false) {
            $count = 1;
        }
        $this->log("Seeding data for.......".$fileName);
        $this->log("Number of rows to be seeded.......".$count);

        return $this->seedData($fileName, $count) ? 0: 1;
    }

    private function seedData(string $fileName, int $count): bool
    {
        $seederFile =sprintf('%s/../../Database/Seeds/%s.php', __DIR__, $fileName);
        if (!file_exists($seederFile)) {
            $this->log("Seeder file does not exist");
            return false;
        }
        include_once $seederFile;

        $seederClass = sprintf('Database\Seeds\%s', pathinfo($fileName, PATHINFO_FILENAME));
        if (!class_exists($seederClass)) {
            $this->log("Seeder class does not exist");
            return false;
        }

        $seederInstance = new $seederClass(new MySQLWrapper());
        $seederInstance->seed($count);
        return true;
    }
}