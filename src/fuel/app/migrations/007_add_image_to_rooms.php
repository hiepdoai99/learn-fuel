<?php

namespace Fuel\Migrations;

class Add_image_to_rooms
{
	public function up()
	{
		\DBUtil::add_fields('rooms', array(
			'image' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('rooms', array(
			'image'
		));
	}
}