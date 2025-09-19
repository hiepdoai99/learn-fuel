<?php

namespace Fuel\Migrations;

class Create_job_queue
{
    public function up()
    {
        \DBUtil::create_table('job_queue', array(
            'id'          => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'type'        => array('type' => 'varchar', 'constraint' => 100),
            'payload'     => array('type' => 'text'),
            'status'      => array('type' => 'varchar', 'constraint' => 20, 'default' => 'pending'), // pending, processing, done, failed
            'attempts'    => array('type' => 'int', 'constraint' => 3, 'default' => 0),
            'error'       => array('type' => 'text', 'null' => true),
            'created_at'  => array('type' => 'int'),
            'updated_at'  => array('type' => 'int', 'null' => true),
            'processed_at'=> array('type' => 'int', 'null' => true),
        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('job_queue');
    }
}
