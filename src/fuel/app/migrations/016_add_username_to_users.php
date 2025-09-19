<?php

namespace Fuel\Migrations;

class Add_username_to_users
{
    public function up()
    {
        \DBUtil::add_fields('users', array(
            'username' => array(
                'constraint' => 50,
                'type'       => 'varchar',
                'null'       => true,
                'after'      => 'id',
            ),
        ));

        // cập nhật username = email cho các user đã có
        \DB::update('users')
            ->value('username', \DB::expr('email'))
            ->execute();
    }

    public function down()
    {
        \DBUtil::drop_fields('users', array('username'));
    }
}
