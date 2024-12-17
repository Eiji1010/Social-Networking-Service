<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreateUserTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        return[
            "DROP TABLE users"
        ];
    }
}