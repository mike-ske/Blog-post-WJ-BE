<?php
require  '../../dbconn.php';
session_start();

$user_id = $_SESSION['userId'];

if (isset($_GET['id'])) { 

    $page_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (isset($_POST['delete_id'])) {

                        $delete_id = $_POST['delete_id'];

                        $_SESSION['delete'] = "<script>alert('Are you sure you want to delete!')</script>";   
                    
                            if ($_SESSION['delete'] == true) 
                            {
                                    // Write a query statement
                                $sql = "DELETE FROM post WHERE id = ".$delete_id;

                                //query the database
                                $del_result = mysqli_query($conn, $sql) or die('Failed to insert Into database'. mysqli_error($conn));
                                //check if post is uploaded
                                
                                        if ($del_result) {
                                            header("Location: view_post.php");
                                            $_SESSION['delete_message'] = "<script>alert('Message deleted')</script>";
                                            
                                        }else {
                                            header("Location: view_post.php");
                                            $_SESSION['delete_message']  = "<script>alert('Message Not deleted')</script>";
                                        } 
                            }
                }
       
    }

}


?>