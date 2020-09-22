<?php

define('BASE_URL', 'http://localhosadmin/management/manage_user/t/POST_APP_BE/');
define('USER_DIR', '');
define('ADMIN_DIR', 'admin/manage_admin/');
define('ROOT_FILE', __FILE__);
define('ROOT_DIR', __DIR__);

define('DB_HOST', 'localhost');
define('DB_PASS', '');
define('DB_NAME', 'blog');
define('DB_USER', 'root');



// FUNCTION TO CONVERT DB DATE TO UNIX DATE AND TIMESTAMP

function convertDate($date = ''){
    $convert_date = strtotime($date);
   return date('j F Y', $convert_date);
}

