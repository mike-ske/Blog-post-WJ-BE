<?php

define('BASE_URL', 'http://localhost/POST_APP_BE/');
define('ROOT_DIR', __DIR__);

// ========== LOCAL DATABASE CONNECTION =======
define('DB_HOST', 'localhost');
define('DB_PASS', '');
define('DB_NAME', 'blog');
define('DB_USER', 'root');

// ========== REMOTE DATABASE CONNECTION =======
// define('DB_HOST', ' remotemysql.com');
// define('DB_PASS', 'J9VTkhnk9a');
// define('DB_NAME', 'H4pOhLh2Dl');
// define('DB_USER', 'H4pOhLh2Dl');

// FUNCTION TO CONVERT DB DATE TO UNIX DATE AND TIMESTAMP

function convertDate($date = ''){
    $convert_date = strtotime($date);
   return date('j F Y', $convert_date);
}

