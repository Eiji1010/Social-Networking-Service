<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreateCommentTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                userId INT NOT NULL,
                postId INT NOT NULL,
                content VARCHAR(255) NOT NULL,
                postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (postId) REFERENCES posts(id),
                FOREIGN KEY (userId) REFERENCES users(id)
            )"
        ];
    }

    public function down(): array
    {
        return[
            "DROP TABLE comments"
        ];
    }
}