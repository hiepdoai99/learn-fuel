<?php

namespace Fuel\Migrations;

class Add_province_id_to_hotels
{
	public function up()
	{
		\DBUtil::add_fields('hotels', array(
			'province_id' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('hotels', array(
			'province_id'
		));
	}
}