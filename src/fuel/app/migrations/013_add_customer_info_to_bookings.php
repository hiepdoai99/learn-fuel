<?php

namespace Fuel\Migrations;

class Add_customer_info_to_bookings
{
	public function up()
	{
		\DBUtil::add_fields('bookings', array(
			'customer_name' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'customer_email' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'customer_phone' => array('constraint' => 50, 'null' => false, 'type' => 'varchar'),
			'note' => array('null' => false, 'type' => 'text'),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('bookings', array(
			'customer_name'
,			'customer_email'
,			'customer_phone'
,			'note'
		));
	}
}