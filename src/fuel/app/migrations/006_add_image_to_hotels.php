<?php

namespace Fuel\Migrations;

class Add_image_to_hotels
{
	public function up()
	{
		\DBUtil::add_fields('hotels', array(
			'image' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('hotels', array(
			'image'
		));
	}
}