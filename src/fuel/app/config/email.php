<?php
return array(

    'defaults' => array(
        'driver' => 'smtp',   // đổi mail -> smtp

        'from' => array(
            'email' => 'nguyenxuanhiepk49@gmail.com',
            'name'  => 'Hotel Booking',
        ),

        'smtp' => array(
            'host'     => 'smtp.gmail.com',
            'port'     => 587,
            'username' => 'nguyenxuanhiepk49@gmail.com',
            'password' => 'tzms wciy ozxl rpdp', 
            'timeout'  => 5,
            'starttls' => true,
        ),

        'newline' => "\r\n",
        'charset' => 'utf-8',
        'validate' => true,
    ),
);
