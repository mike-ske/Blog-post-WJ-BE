<?php
// require "../config/config_dir.php";
require  '../../dbconn.php';
require '../../config/session.php';



$user_id = $_SESSION['userId'];
$_SESSION['delete_message'] = "";
//Write a query statement

    $query = "SELECT post.id, `title`, `author`, `userId`, `body`, `date_created`, `username`, `date_updated`,`image`, `author_image` FROM `post` INNER JOIN admin_account ON post.userId = admin_account.id WHERE post.userId = ". $user_id;

    $message = "";
    //query the database
    $result = mysqli_query($conn, $query) or die('Failed to fetch from database'.mysqli_error($conn));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        echo "";
        $delete_id = $_POST['delete_id'];
         
        
            // Write a query statement
            $sql = "DELETE FROM post WHERE id = ".$delete_id;
    
            //query the database
            $result = mysqli_query($conn, $sql) or die('Failed to insert Into database');
            //check if post is uploaded
   
          if ($result) {
                    header("Location: view_post.php");
                    $_SESSION['delete_message'] = 'Message deleted';
                    
                }else {
                    header("Location: view_post.php");
                    $_SESSION['delete_message']  = 'Message Not deleted';
                } 
      
        }
 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <!-- <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../hero_style.css"> -->
    
</head>
<body>
        <div class="container">
                    <?php 
                    if (!empty($_SESSION['Login_message']) ) {
                        echo "<div class='msg_green' id='msg_green'>".$_SESSION['Login_message']."</div>";
                    }  
                    
                    ?>
        
        <header class="admin_header">
            <nav class="admin_nav">
                <div class="logo admin_logo">
                    <h1><a href="posts.php" style="color:#fff;text-decoration:none">Read<span class="logo-color">it.</span></a></h1>
                </div>

                <div class="admin_menu">
                    <ul class="admin_list">
                        <li class="admin_items"><a href="#" class="admin_link">Public</a></li>
                        <li class="admin_item2"><a href="#" class="admin_link">The Admin Name here&NonBreakingSpace; &RightAngleBracket;</a>
                            <ul class="sub_menu">
                                <li class="admin_item Sh"><a href="#" class="admin_link">Log Out</a></li>
                            </ul>
                        </li>                    
             
                    </ul>
                </div>

                <!-- <div class="bar_icon">
                    <img src="../img/align-to-right.png">
                </div> -->
            </nav>
        </header>


            <div class="main_post view_post">
            <?php while ($response = mysqli_fetch_assoc($result)) { ?>
                
              <div class="heading view_heading">
                        
                        <h1 class="view_h1"><?php echo $response['title']; ?></h1><hr>
                    <div class="side_image view_side_image">
                        
                        <h3 class="author view_author"><?php echo $response['author'];?></h3>
                        <h4 class="date view_date">Date Created: <?php echo convertDate($response['date_created']);?></h4>
                        <p class="view_body">Username: <?php echo $response['username']?></p>
                        <p class="view_body">Last Updated: <?php echo convertDate($response['date_updated'])?></p>
                    </div>
                    
                        
                       
                 <div class="buttons">
                        <h3 class="read_more view_read_more">
                                <a href="posts.php">Back</a>
                        </h3>
                        <h3 class="read_more view_read_more">
                                <a href="update_post.php?id=<?php echo $response['id'];?>">Edit Post</a>
                        </h3>

                           <!-- Create an hidden form to catch the present ID of this form -->
                        
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="view_read_more" >
                                
                                <input type="hidden" name="delete_id" value="<?php echo $response['id'];?>" >
                                    <button type="submit" name="delete" class="delete" onclick="return deleted()">Delete</button>
   
                            </form>
                </div>
                <!-- End of Hidden input -->
                </div>

            </div>
            <?php }?>

            <div class="controls">
                            <ul class="main_ctrl">
                                <li class="ctrl_list">Add post
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="../posts.php" class="ctrl_link">Add Post</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">View post
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="#" class="ctrl_link">View Post</a></li>
                                    </ul>
                                </li>

                                <hr>
                                <p class="note">For Administrative Management</p>
                                <li class="ctrl_list">Add Categories
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="#" class="ctrl_link">Add Categories</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">Add Admin Roles
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="#" class="ctrl_link">Add Admin Roles</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">View Admin Roles
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="#" class="ctrl_link">View Admin Roles</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">View all post
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="#" class="ctrl_link">View all Post</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">For Equiries
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="#" class="ctrl_link">Email Admin</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <footer>
                            <div class="foot">
                                <div class="input">

                                </div>
                                <div class="icons">

                                </div>
                                <div class="copyright">

                                </div>
                            </div>
                        </footer>
       </div>                 
</body>
</html>
   
   
