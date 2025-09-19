<?php

namespace Fuel\Migrations;

class Alter_bookings_user_id_null
{
    public function up()
    {
        \DB::query("ALTER TABLE `bookings` MODIFY `user_id` INT NULL")->execute();
    }

    public function down()
    {
        \DB::query("ALTER TABLE `bookings` MODIFY `user_id` INT NOT NULL")->execute();
    }
}
