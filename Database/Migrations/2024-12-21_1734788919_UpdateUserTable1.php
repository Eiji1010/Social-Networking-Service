<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class UpdateUserTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "ALTER TABLE users ADD COLUMN age INT",
            "ALTER TABLE users ADD COLUMN place VARCHAR(255)",
            "ALTER TABLE users ADD COLUMN biography TEXT",
        ];
    }

    public function down(): array
    {
        return[
            "ALTER TABLE users DROP COLUMN age",
            "ALTER TABLE users DROP COLUMN place",
            "ALTER TABLE users DROP COLUMN biography",
        ];
    }
}