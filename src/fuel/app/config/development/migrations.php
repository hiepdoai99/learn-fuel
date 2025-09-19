<?php
return array (
  'version' => array(  
    'app' => array(    
      'default' => array(      
        0 => '001_create_users',
        1 => '002_create_users_2',
        2 => '003_create_hotels',
        3 => '004_create_rooms',
        4 => '005_create_bookings',
        5 => '006_add_image_to_hotels',
        6 => '007_add_image_to_rooms',
        7 => '008_create_provinces',
        8 => '009_add_province_id_to_hotels',
        9 => '010_create_room_images',
        10 => '011_drop_image_from_rooms',
        11 => '012_add_file_to_room_images',
        12 => '013_add_customer_info_to_bookings',
        13 => '014_alter_bookings_user_id_null',
        14 => '015_add_provinces_data',
        15 => '016_add_username_to_users',
        16 => '017_create_mail_queue',
        17 => '018_create_job_queue',
        18 => '019_modify_hotels_image_nullable',
      ),
    ),
    'module' => array(    
    ),
    'package' => array(    
    ),
  ),
  'folder' => 'migrations/',
  'table' => 'migration',
  'flush_cache' => false,
  'flag' => NULL,
);
