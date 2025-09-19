<?php

namespace Fuel\Migrations;

class Modify_hotels_image_nullable
{
    public function up()
    {
        \DBUtil::modify_fields('hotels', array(
            'image' => array(
                'constraint' => 255,
                'type'       => 'varchar',
                'null'       => true,   
            ),
        ));
    }

    public function down()
    {
        \DBUtil::modify_fields('hotels', array(
            'image' => array(
                'constraint' => 255,
                'type'       => 'varchar',
                'null'       => false,  
            ),
        ));
    }
}
