<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreatePostTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                userId INT NOT NULL,
                content VARCHAR(255) NOT NULL,
                mediaUrl VARCHAR(255),
                isScheduled BOOLEAN DEFAULT FALSE,
                scheduled_at TIMESTAMP,
                postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (userId) REFERENCES users(id)
                )"
        ];
    }

    public function down(): array
    {
        return[
            "DROP TABLE posts"
        ];
    }
}