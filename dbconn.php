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
    
    die('Failed to connect to database'.mysqli_error($conn));
} 

?>