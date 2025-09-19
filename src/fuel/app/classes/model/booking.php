<?php

class Model_Booking extends \Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),
		"user_id" => array(
			"label" => "User id",
			"data_type" => "int",
		),
		"room_id" => array(
			"label" => "Room id",
			"data_type" => "int",
		),
		"check_in" => array(
			"label" => "Check in",
			"data_type" => "date",
		),
		"check_out" => array(
			"label" => "Check out",
			"data_type" => "date",
		),
		"customer_name" => array(
			"label" => "Customer Name",
			"data_type" => "varchar",
		),
		"customer_email" => array(
			"label" => "Customer Email",
			"data_type" => "varchar",
		),
		"customer_phone" => array(
			"label" => "Customer Phone",
			"data_type" => "varchar",
		),
		"note" => array(
			"label" => "Note",
			"data_type" => "text",
		),
		"status" => array(
			"label" => "Status",
			"data_type" => "varchar",
			"default" => "pending",
		),
		"created_at" => array(
			"label" => "Created at",
			"data_type" => "int",
		),
		"updated_at" => array(
			"label" => "Updated at",
			"data_type" => "int",
		),
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => false,
		),
		'Observer_BookingMail' => array(
			'events' => array('after_insert'),
		),
		'Observer_BookingMailDeposit' => [
			'events' => ['after_update'],
		],

	);
	public static $status_options = [
		'pending' => 'Pending',
		'deposited' => 'Deposited',
		'checked_in' => 'Checked In',
		'canceled' => 'Canceled',
	];
	protected static $_table_name = 'bookings';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(

	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
		'room' => [
			'model_to' => 'Model_Room',
			'key_from' => 'room_id',
			'key_to' => 'id',
		],
		'user' => [
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to' => 'id',
		],
	);

}
