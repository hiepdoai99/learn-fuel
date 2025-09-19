<?php

namespace Fuel\Migrations;

class Create_rooms
{
	public function up()
	{
		\DBUtil::create_table('rooms', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => 11),
			'hotel_id' => array('constraint' => 11, 'null' => false, 'type' => 'int'),
			'room_number' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'type' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'price' => array('constraint' => '10,2', 'null' => false, 'type' => 'decimal'),
			'created_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
			'updated_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rooms');
	}
}