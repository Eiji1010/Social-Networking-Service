<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class CodeGeneration extends AbstractCommand
{
    protected static ?string $alias = 'code-gen';
    protected static bool $requiredCommandValue = true;

    public static function getArguments(): array
    {
        return [
            (new Argument('name'))->description("Name of the file that is to be generate")->required(false),
        ];
    }

    public function execute(): int
    {
        $codeGenType = $this->getCommandValue();
        $this->log("Generating code for.......".$codeGenType);
        if ($codeGenType === 'migration'){
            $migrationFile = $this->getArgumentValue('name');
            $this->generateMigrationFile($migrationFile);
        }
        return 0;
    }

    private function generateMigrationFile(string $migrationFile): void
    {
        $filename = sprintf('%s_%s_%s.php', date('Y-m-d'), time(), $migrationFile);
        $migrationContent = $this->getMigrationContent($migrationFile);
        $path = sprintf("%s/../../Database/Migrations/%s", __DIR__, $filename);
        file_put_contents($path, $migrationContent);
    }

    private function getMigrationContent(string $migrationFile): string
    {
        $className = $this->pascalCase($migrationFile);
        return <<<MIGRATION
<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class {$className} implements SchemaMigration
{
    public function up(): array
    {
        return [];
    }

    public function down(): array
    {
        return[];
    }
}
MIGRATION;
    }

    private function pascalCase(string $migrationFile): string
    {
        return str_replace(" ", "", ucwords(str_replace(['-', '_'], ' ', $migrationFile)));
    }
}