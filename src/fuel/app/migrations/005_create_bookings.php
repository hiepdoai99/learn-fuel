<?php

namespace Fuel\Migrations;

class Create_bookings
{
	public function up()
	{
		\DBUtil::create_table('bookings', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => 11),
			'user_id' => array('null' => false, 'type' => 'int'),
			'room_id' => array('constraint' => 11, 'null' => false, 'type' => 'int'),
			'check_in' => array('null' => false, 'type' => 'date'),
			'check_out' => array('null' => false, 'type' => 'date'),
			'status' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
			'updated_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('bookings');
	}
}