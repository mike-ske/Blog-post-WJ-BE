<?php
require  '../../dbconn.php';

session_start();
$user_id = $_SESSION['userId'];
 

// ===== GET THE USER ID ======
$qr_users = "SELECT post.userId FROM post INNER JOIN admin_account ON post.userId = admin_account.id WHERE post.userId = ".$user_id;
$qr_result = mysqli_query($conn, $qr_users) or die('Failed to fetch  from database'. mysqli_error($conn));
$qr_response = mysqli_fetch_assoc($qr_result);
$users_id = $qr_response['userId'];


    if ($users_id == NULL) 
    {
        unset($_SESSION['delete']);
        unset($_SESSION['delete_message']);
        echo $_SESSION['noPost'] = "You have no Post yet! Please add a post";

    }
    else if ($users_id !== NULL)
    { 
        echo $_SESSION['noPost'] = "";
    
    }
     
    //For admin SELECT post.id, post.title, post.author, post.userId, post.body, post.date_created, admin_account.username, post.date_updated,post.image, post.author_image FROM post INNER JOIN admin_account ON post.userId = admin_account.id WHERE post.userId = 43  AND admin_account.isAdmin = 1;
        $query = "SELECT post.id, post.title, post.author, post.userId, post.body, post.date_created, admin_account.username, post.date_updated  FROM `post` INNER JOIN admin_account ON post.userId = admin_account.id WHERE post.userId = ".$user_id;

        //query the database
       $_SESSION['result'] = mysqli_query($conn, $query) or die('Failed to fetch from database'. mysqli_error($conn));
        
       $results = $_SESSION['result'];
       
       if ($results == NULL) 
        {
            $_SESSION['noPost'] = "No Post in Database Check Connection";
        }
            $num_rows = mysqli_num_rows($results);
            if ($num_rows <= 0) 
            {
                unset($_SESSION['delete']);
                unset($_SESSION['delete_message']);
                $_SESSION['noPost'] = "You have no Post yet! Please add New post";
        
            }else if ($num_rows > 0){
        
                $_SESSION['noPost'] = "";
            }     
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <script src="m_layout/manage.js"></script>
    <link rel="stylesheet" href="../m_layouts/manage.css">
 
</head>
<body>
   
        <header class="admin_header ">
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

                <?php
                
                if (!empty($_SESSION['noPost']) ) {
                    echo "<div style='font-weight:bold;position: absolute;top: 45px;font-size: 20px;font-style: italic;' class='error'>".$_SESSION['noPost']."</div>";
                }  

                if (!empty($_SESSION['delete']) ) {
                    echo "<div id='del'>".$_SESSION['delete']."</div>";
                }
           
                if (!empty($_SESSION['delete_message']) ) {
                    echo "<div id='del'>".$_SESSION['delete_message']."</div>";
                }
                
                if (isset($_SESSION['delete']) && isset($_SESSION['delete_message']) ) {
                    unset($_SESSION['delete']);
                    unset($_SESSION['delete_message']);
                } 

                if (!empty($_SESSION['not_admin']) ) {
                    echo "<div id='del'>".$_SESSION['not_admin']."</div>";
                }
                if (isset($_SESSION['not_admin']) ) {
                    unset($_SESSION['not_admin']);
                }
                if (!empty($_SESSION['welcome']) ) {
                    echo "<div id='del'>".$_SESSION['welcome']."</div>";
                }
                if (isset($_SESSION['welcome']) ) {
                    unset($_SESSION['welcome']);
                }
                ?>

            
                
              <div class="heading view_heading view_post">
                        
                 <?php  while ($response = mysqli_fetch_assoc( $results )) {?>
                    <div class="side_image view_side_image">
                      
                        <div class="main">
                                <h1 class="view_h1"><?php echo $response['title']; ?></h1><hr>
                                <h3 class="author view_author"><?php echo $response['author'];?></h3>
                                <h4 class="date view_date">Date Created: <?php echo convertDate($response['date_created']);?></h4>
                                <p class="view_body">Username: <?php echo $response['username']?></p>
                                <p class="view_body">Last Updated: <?php echo convertDate($response['date_updated'])?></p>
                                
                        </div>

                        <div class="buttons">
                            <h3 class="read_more view_read_more">
                                    <a href="../../index.php">Back</a>
                            </h3>
                            <h3 class="read_more view_read_more">
                                    <a href="update_post.php?id=<?php echo $response['id'];?>">Edit Post</a>
                            </h3>

                            <!-- Create an hidden form to catch the present ID of this form -->
                            
                                <form action="delete_post.php?id=<?php echo $users_id?>" method="post" class="view_read_more" >
                                    
                                    <input type="hidden" name="delete_id" value="<?php echo $response['id'];?>" >
                                        <button type="submit" name="delete" class="delete" >Delete</button>
    
                                </form>
                            
                        </div>
                    </div>
                    
                <?php }?>   
                       
                
                <!-- End of Hidden input -->
                </div>
                        <div class="controls view_post heading">
                            <ul class="main_ctrl">
                                <li class="ctrl_list">Add post
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="../../posts.php" class="ctrl_link">Add Post</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">View post
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="view_post.php?id=<?php echo $users_id?>" class="ctrl_link">View Post</a></li>
                                    </ul>
                                </li>

                                <hr>
                                <p class="note">For Administrative Management</p>
                                <li class="ctrl_list">Add Categories
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="control.php?id=restrict" class="ctrl_link">Add Categories</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">Add Admin Roles
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="control.php?id=restrict" class="ctrl_link">Add Admin Roles</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">View Admin Roles
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="control.php?id=restrict" class="ctrl_link">View Admin Roles</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">View all post
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="control.php?id=restrict" class="ctrl_link">View all Post</a></li>
                                    </ul>
                                </li>
                                <li class="ctrl_list">For Equiries
                                    <ul class="sub_ctrl">
                                        <li class="sub_ctrl_1"><a href="mailto:micahalumona@gmail.com?subject=Mail from Readit Blog&body=I'm requesting for Admin ID to grant me access to admin page" class="ctrl_link">Email Admin</a></li>
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
                                     <h6 class="h6">  Copyright  &copy; 2020 Created by Alumona Micah DEV <span class="cast">@Think Soft</span></h6>
                                </div>
                            </div>
                        </footer>
            </div>
          
  
</body>

</html>