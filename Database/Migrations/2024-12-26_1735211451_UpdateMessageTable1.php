<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class UpdateMessageTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "ALTER TABLE messages MODIFY COLUMN receiverId INT"
        ];
    }

    public function down(): array
    {
        return[
            "ALTER TABLE messages MODIFY COLUMN receiverId INT NOT NULL"
        ];
    }
}