<?php
session_start();

if (isset($_GET['id']) && $_GET['id'] == 1) {

    session_unset($_SESSION['first_name']);
    unset($_SESSION['first_name']);
    header('Location: login.php');
    session_destroy();
    
}
?>