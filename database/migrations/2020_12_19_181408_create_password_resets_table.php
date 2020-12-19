<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up(): void
    {
        $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS `password_resets` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(255) NOT NULL,
        `token` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP NULL
    );
    ALTER TABLE `password_resets` ADD INDEX `email` (`email`);
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }

    public function down():void
    {
        Schema::dropIfExists('password_resets');
    }
}
