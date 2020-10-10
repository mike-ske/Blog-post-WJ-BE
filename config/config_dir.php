<?php

define('BASE_URL', 'http://localhost/POST_APP_BE/');
define('ROOT_DIR', __DIR__);

define('USER_DIR', 'admin/manage_users/');
define('ADMIN_DIR', 'admin/manage_admin/');
define('ROOT_FILE', __FILE__);



// // ========== LOCAL DATABASE CONNECTION =======

// define('DB_HOST', 'localhost');
// define('DB_PASS', '');
// define('DB_NAME', 'blog');
// define('DB_USER', 'root');



define('DB_HOST', 'sm9j2j5q6c8bpgyq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com');
define('DB_PASS', 'oz1mn2yp3lk6bm8r');
define('DB_NAME', 'uhapfhnh4ybf0fk5');
define('DB_USER', 'jxu42l3cwykdtn85');



// FUNCTION TO CONVERT DB DATE TO UNIX DATE AND TIMESTAMP

function convertDate($date = ''){
    $convert_date = strtotime($date);
   return date('j F Y', $convert_date);
}

?>
