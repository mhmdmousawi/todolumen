<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCategoryTable extends Migration
{
    public function up(): void
    {
        $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS `categories` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `user_id` INT NOT NULL
    )
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }

    public function down(): void
    {
        $sql = <<<SQL
    DROP TABLE `categories`;
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }
}
