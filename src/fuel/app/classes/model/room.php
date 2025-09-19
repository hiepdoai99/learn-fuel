<?php

class Model_Room extends \Orm\Model
{
    protected static $_properties = array(
        "id" => array(
            "label" => "ID",
            "data_type" => "int",
        ),
        "hotel_id" => array(
            "label" => "Khách sạn",
            "data_type" => "int",
        ),
        "room_number" => array(
            "label" => "Số phòng",
            "data_type" => "varchar",
        ),
        "type" => array(
            "label" => "Loại phòng",
            "data_type" => "varchar",
        ),
        "price" => array(
            "label" => "Giá",
            "data_type" => "decimal",
        ),
        "created_at" => array(
            "label" => "Ngày tạo",
            "data_type" => "int",
        ),
        "updated_at" => array(
            "label" => "Ngày cập nhật",
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

    protected static $_table_name = 'rooms';

    protected static $_primary_key = array('id');

    protected static $_has_many = array(
        'images' => [
            'model_to' => 'Model_RoomImage',
            'key_from' => 'id',
            'key_to'   => 'room_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        ],
    );

    protected static $_belongs_to = array(
        'hotel' => [
            'model_to' => 'Model_Hotel',
            'key_from' => 'hotel_id',
            'key_to'   => 'id',
        ],
    );

    // Danh sách loại phòng cố định
    public static function room_types()
    {
        return [
            'Base'    => 'Base',
            'Premium' => 'Premium',
            'VIP'     => 'VIP',
        ];
    }
}
