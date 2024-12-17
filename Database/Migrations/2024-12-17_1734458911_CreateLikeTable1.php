<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreateLikeTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE likes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                userId INT NOT NULL,
                postId INT NOT NULL,
                FOREIGN KEY (userId) REFERENCES users(id),
                FOREIGN KEY (postId) REFERENCES posts(id)
            )"
        ];
    }

    public function down(): array
    {
        return[
            "DROP TABLE likes"
        ];
    }
}