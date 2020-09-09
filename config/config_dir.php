<?php

define('BASE_URL', 'http://localhost/POST_APP_BE/');
define('DB_HOST', 'localhost');
define('DB_PASS', '');
define('DB_NAME', 'blog');
define('DB_USER', 'root');



// FUNCTION TO CONVERT DB DATE TO UNIX DATE AND TIMESTAMP

function convertDate($date = ''){
    $convert_date = strtotime($date);
   return date('j F Y', $convert_date);
}

