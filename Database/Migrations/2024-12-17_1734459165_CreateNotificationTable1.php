<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreateNotificationTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE notifications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                userId INT NOT NULL,
                type VARCHAR(50) NOT NULL,
                sourceId INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                is_read BOOLEAN DEFAULT FALSE,
                FOREIGN KEY (userId) REFERENCES users(id),
                FOREIGN KEY (sourceId) REFERENCES users(id)
            )"
        ];
    }

    public function down(): array
    {
        return[
            "DROP TABLE notifications"
        ];
    }
}