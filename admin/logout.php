<?php
session_start();

if (isset($_GET['id'])) {
    session_destroy();
    session_unset();
    unset($_SESSION['first_name']);
    header('Location: login.php');
}
?>