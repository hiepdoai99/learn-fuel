<?php

return array(
    '_root_' => 'home/index',
    '_404_' => 'welcome/404',

    // ================== Customer ==================
    'province' => 'customer/province/index',

    'hotel' => 'customer/hotel/index',
    'hotel/(:num)' => 'customer/hotel/view/$1',

    'room/(:num)' => 'customer/room/view/$1',

    'customer/room/booking/(:num)' => 'customer/room/booking/$1',

    'booking' => 'customer/booking/create',

    // ================== Admin ==================

    'admin/logout' => 'admin/auth/logout',

    'admin' => 'admin/dashboard/index',
    'admin/dashboard' => 'admin/dashboard/index',

    'admin/user' => 'admin/user/index',
    'admin/user/create' => 'admin/user/create',
    'admin/user/edit/(:num)' => 'admin/user/edit/$1',
    'admin/user/delete/(:num)' => 'admin/user/delete/$1',

    'admin/hotel' => 'admin/hotel/index',
    'admin/hotel/create' => 'admin/hotel/create',
    'admin/hotel/edit/(:num)' => 'admin/hotel/edit/$1',
    'admin/hotel/delete/(:num)' => 'admin/hotel/delete/$1',

    'admin/room' => 'admin/room/index',
    'admin/room/create' => 'admin/room/create',
    'admin/room/edit/(:num)' => 'admin/room/edit/$1',
    'admin/room/delete/(:num)' => 'admin/room/delete/$1',

    // 'admin/province' => 'admin/province/index',
    // 'admin/province/create' => 'admin/province/create',
    // 'admin/province/edit/(:num)' => 'admin/province/edit/$1',
    // 'admin/province/delete/(:num)' => 'admin/province/delete/$1',
    // 'admin/province/view/(:num)' => 'admin/province/view/$1',

    'admin/booking' => 'admin/booking/index',
    'admin/booking/view/(:num)' => 'admin/booking/view/$1',
    'admin/booking/create' => 'admin/booking/create',


    // ================== Api ==================

    'api/hotels' => 'api/hotel/index',

    'api/rooms' => 'api/room/index',
);
