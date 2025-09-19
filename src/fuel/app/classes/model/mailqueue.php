<?php

class Model_MailQueue extends \Orm\Model
{
    protected static $_properties = [
        'id',
        'to',
        'subject',
        'body',
        'status',
        'created_at',
        'sent_at',
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => false,
        ],
    ];

    protected static $_table_name = 'mail_queue';
}
