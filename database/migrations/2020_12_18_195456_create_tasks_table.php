<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTasksTable extends Migration
{
    public function up(): void
    {
        $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS `tasks` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `description` TEXT NULL,
        `status` VARCHAR(255) NOT NULL,
        `time` TIMESTAMP NULL,
        `category_id` INT NULL,
        `user_id` INT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }

    public function down(): void
    {
        $sql = <<<SQL
    DROP TABLE `tasks`;
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }
}
