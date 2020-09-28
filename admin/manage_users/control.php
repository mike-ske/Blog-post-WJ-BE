<?php 
session_start();

$user_id = $_SESSION['userId'];



    if (isset($user_id) && $_GET['userId'] !== 1 ) 
    { 
        $_SESSION['must_add']  = "";
        header("Location: view_post.php?userId={$user_id}");
       

    } 
    else if (isset($_GET['userId']) && $_GET['userId'] == 1) 
    {

        header('Location: ../../index.php');
        $id = $_GET['userId'];
        $_SESSION['must_add']  = "You must add post first!";
    }

    
    if (isset($user_id) && $_GET['id']) 
    { 
        $_SESSION['not_admin']  = "You do not have acess to this page. You Are Not Authorizied!";
        
    } 
    else if (!empty($_SESSION['not_admin'])) 
    {
       echo $_SESSION['not_admin'] = "";
        
    }

?>

