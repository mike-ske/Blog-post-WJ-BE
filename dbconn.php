<?php
require 'config/config_dir.php';

$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$db = DB_NAME;


$conn = mysqli_connect($host, $user, $pass, $db);

##check for connection

if ($conn) {
    echo '';
}else {
    
    die('Failed to connect to database. Check connection'.mysqli_error($conn));
} 



// ===== DEFINE PHPMAILER FUNCTIONS ==========

define('MAIL_USERNAME', 'micahalumona@gmail.com');
define('MAIL_PASSWORD', 'Alumona@123');