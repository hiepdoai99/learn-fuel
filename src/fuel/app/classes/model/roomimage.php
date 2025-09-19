<?php

class Model_RoomImage extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'room_id',
        'image',
        'created_at',
    );

    protected static $_belongs_to = array(
        'room' => [
            'model_to' => 'Model_Room',
            'key_from' => 'room_id',
            'key_to'   => 'id',
        ],
    );

    protected static $_table_name = 'room_images';
}
