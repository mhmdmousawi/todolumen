<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFkRelationUserTasks extends Migration
{
    public function up(): void
    {
        $sql = <<<SQL
    ALTER TABLE `tasks` ADD CONSTRAINT `FK_TASK_USER_ID` FOREIGN KEY  (`user_id`) REFERENCES users (`id`);
    ALTER TABLE `tasks` ADD INDEX `user_id` (`user_id`);
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }

    public function down(): void
    {
        $sql = <<<SQL
    ALTER TABLE `tasks` DROP FOREIGN KEY `FK_TASK_USER_ID`;
    ALTER TABLE `tasks` DROP INDEX `user_id`;
    SQL;

        DB::connection()->getPdo()->exec($sql);
    }
}
