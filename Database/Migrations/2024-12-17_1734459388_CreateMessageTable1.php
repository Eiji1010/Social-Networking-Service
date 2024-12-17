<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreateMessageTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                senderId INT NOT NULL,
                receiverId INT NOT NULL,
                content VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (senderId) REFERENCES users(id),
                FOREIGN KEY (receiverId) REFERENCES users(id)
            )"
        ];
    }

    public function down(): array
    {
        return[];
    }
}