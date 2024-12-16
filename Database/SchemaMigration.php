<?php
namespace Database;

interface SchemaMigration
{
    public function up();
    public function down();
}
