<?php

class Model_Hotel extends \Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),
		"name" => array(
			"label" => "Name",
			"data_type" => "varchar",
		),
		"address" => array(
			"label" => "Address",
			"data_type" => "varchar",
		),
		"description" => array(
			"label" => "Description",
			"data_type" => "text",
		),
		"image" => array(  
			"label" => "Image",
			"data_type" => "varchar",
		),
		"province_id" => array(
			"label" => "Province",
			"data_type" => "int",
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
	);

	protected static $_table_name = 'hotels';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
		'rooms' => [
			'model_to' => 'Model_Room',
			'key_from' => 'id',
			'key_to' => 'hotel_id',

		],
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
		'province' => [
			'model_to' => 'Model_Province',
			'key_from' => 'province_id',
			'key_to' => 'id',
		],
	);



}
