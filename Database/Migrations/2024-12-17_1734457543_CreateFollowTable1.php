<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class CreateFollowTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE follows (
                id INT AUTO_INCREMENT PRIMARY KEY,
                followeeId INT NOT NULL,
                followerId INT NOT NULL,
                FOREIGN KEY (followeeId) REFERENCES users(id),
                FOREIGN KEY (followerId) REFERENCES users(id)
            )"
        ];
    }

    public function down(): array
    {
        return[
            "DROP TABLE follows"
        ];
    }
}