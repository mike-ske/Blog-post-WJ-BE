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


// ========== REMOTE DATABASE CONNECTION =======
define('DB_HOST', 'freedb.tech');
define('DB_PASS', 'alumona123');
define('DB_NAME', 'freedbtech_blog');
define('DB_USER', 'freedbtech_alumona123');


// define('DB_HOST', 'remotemysql.com');
// define('DB_PASS', '');
// define('DB_NAME', 'H4pOhLh2Dl');
// define('DB_USER', 'H4pOhLh2Dl');



// FUNCTION TO CONVERT DB DATE TO UNIX DATE AND TIMESTAMP

function convertDate($date = ''){
    $convert_date = strtotime($date);
   return date('j F Y', $convert_date);
}

?>
