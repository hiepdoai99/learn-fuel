<?php

namespace Fuel\Migrations;

class Create_mail_queue
{
    public function up()
    {
        \DBUtil::create_table('mail_queue', array(
            'id'         => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'to'         => array('type' => 'varchar', 'constraint' => 255),
            'subject'    => array('type' => 'varchar', 'constraint' => 255),
            'body'       => array('type' => 'text'),
            'status'     => array('type' => 'varchar', 'constraint' => 20, 'default' => 'pending'), // pending, sent, failed
            'created_at' => array('type' => 'int'),
            'sent_at'    => array('type' => 'int', 'null' => true),
        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('mail_queue');
    }
}
