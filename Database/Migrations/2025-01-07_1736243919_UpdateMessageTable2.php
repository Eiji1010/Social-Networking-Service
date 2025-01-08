<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class UpdateMessageTable2 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "ALTER TABLE messages MODIFY COLUMN receiverId INT NOT NULL",
            "ALTER TABLE messages MODIFY COLUMN content TEXT NOT NULL"
        ];
    }

    public function down(): array
    {
        return[
            "ALTER TABLE messages MODIFY COLUMN receiverId INT",
            "ALTER TABLE messages MODIFY COLUMN content VARCHAR(255)"
        ];
    }
}