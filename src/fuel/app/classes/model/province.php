<?php

class Model_Province extends \Orm\Model
{
    protected static $_properties = [
        'id',
        'name',
    ];

    protected static $_table_name = 'provinces';

    protected static $_has_many = [
        'hotels' => [
            'model_to' => 'Model_Hotel',
            'key_from' => 'id',
            'key_to'   => 'province_id',
        ],
    ];
    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('name', 'Tên tỉnh/thành', 'required|max_length[255]');
        return $val;
    }
}
