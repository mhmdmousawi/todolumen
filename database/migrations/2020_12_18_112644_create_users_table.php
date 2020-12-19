<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `first_name` VARCHAR(255) NOT NULL,
        `last_name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `mobile_number` VARCHAR(255) NOT NULL,
        `birthday` TIMESTAMP NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }

    public function down(): void
    {
        $sql = <<<SQL
    DROP TABLE `users`;
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }
}
