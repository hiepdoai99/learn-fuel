<?php

class Model_JobQueue extends \Orm\Model
{
    protected static $_properties = [
        'id','type','payload','status','attempts'=> ['default' => 0],'error','created_at','updated_at','processed_at'
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'property' => 'created_at',
            'mysql_timestamp' => false,
        ],
        'Orm\Observer_UpdatedAt' => [
            'events' => ['before_update'],
            'property' => 'updated_at',
            'mysql_timestamp' => false,
        ],
    ];

    protected static $_table_name = 'job_queue';
}
