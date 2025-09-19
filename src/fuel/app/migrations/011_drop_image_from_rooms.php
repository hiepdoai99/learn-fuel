<?php

namespace Fuel\Migrations;

class Drop_image_from_rooms
{
    public function up()
    {
        \DBUtil::drop_fields('rooms', [
            'image',
        ]);
    }

    public function down()
    {
        \DBUtil::add_fields('rooms', [
            'image' => ['constraint' => 255, 'type' => 'varchar'],
        ]);
    }
}
