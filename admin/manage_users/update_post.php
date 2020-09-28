<?php
require '../../dbconn.php';
session_start();

$user_id = $_SESSION['userId'];


$qr_users = "SELECT post.userId FROM post INNER JOIN admin_account ON post.userId = admin_account.id WHERE post.userId = ".$user_id;
$qr_result = mysqli_query($conn, $qr_users) or die('Failed to fetch  from database'. mysqli_error($conn));
$qr_response = mysqli_fetch_assoc($qr_result);
$users_id = $qr_response['userId'];



if (!empty($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);
        //Write a query statement

        $query = "SELECT * FROM post WHERE id = {$id}";

        //query the database
        $result = mysqli_query($conn, $query) or die('Failed to insert to Database! '. mysqli_error($conn));
        //check if post is uploaded
        $results = mysqli_fetch_assoc($result);
        
        $id = $results['id'];
        $title = $results['title'];
        $author =  $results['author'];
        $body = $results['body'];
        $image = $results['image'];
}  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $update_id = $_POST['update_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $image = isset($_POST['image']);
        
    if ($_FILES) {

        $name = basename($_FILES['image']['name']);
        $tpname = $_FILES['image']['tmp_name'];
        $upload_dir = '../../img_upload/';

        
        //Store the image path to upload to database
        $image_dir = $upload_dir . $name;

        //Now upload image to folder first
        move_uploaded_file($tpname, $image_dir);
    }

   
    
    require '../m_layouts/users_function.php';
       
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <script src="m_layout/manage.js"></script>
    <link rel="stylesheet" href="m_layouts/manage.css">
    
</head>
<body>


<!-- Form to add post -->
<div class="form_head">
    <!-- Display success message when added -->
                        <?php
                        
                       
                        if (!empty($_SESSION['Success_message']) ) {
                            echo "<div class='msg_green' id='msg_green'>".$_SESSION['Success_message']."</div>";
                        }    

                        if (!empty($_SESSION['Error_message']) ) {
                            echo "<div class='msg' id='msg'>".$_SESSION['Error_message']."</div>";
                        }

                        if (!empty($_SESSION['not_admin']) ) {
                            echo "<div id='del'>".$_SESSION['not_admin']."</div>";
                        }
                        if (isset($_SESSION['not_admin']) ) 
                        {
                            unset($_SESSION['not_admin']);
                        }

                        ?>
                   
    <!-- End of success message -->

    <div class="form">
        <h1 class="title">Update Posts</h1>


        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            <div class="group">
                <label for="title">Title</label>
                <input type="text"  name="title" id="title" value="<?php echo $title;?>">
                        <?php
                            if (!empty($_SESSION['post_title'])) {
                                echo "<div class='msg'>".$_SESSION['post_title']."</div>";
                            }
                        ?>
            </div>

            <div class="group">
                <label for="author">Author of Post</label>
                <input type="text"  name="author" id="author" value="<?php echo $author;?>">
                        <?php
                            if (!empty($_SESSION['post_author'])) {
                                echo "<div class='msg'>".$_SESSION['post_author']."</div>";
                            }
                        ?>
            </div>

            <div class="group">
                <label for="body">Body</label>
                <textarea name="body" id="body" placeholder="Write Post here" >
                    <?php echo $body; ?>
                </textarea>
                        <?php
                            if (!empty($_SESSION['post_body'])) {
                                echo "<div class='msg'>".$_SESSION['post_body']."</div>";
                            }
                        ?> 
            </div>

            <div class="group-image">
                <h4>Add Image of Author/Related Article</h4>
                <label for="image"  class="image">Add Image</label>
               <input type="file" name="image" id="image" required  value="<?php echo $image;?>">
                        <?php
                            if (!empty($_SESSION['post_image'])) {
                                echo "<div class='msg'>".$_SESSION['post_image']."</div>";
                            }
                        ?> 
            </div> 
                <!-- -->
            
            <div class="submit">
                <div class="group">
                    <!-- Catch the id if the view post requst and pass it to the hiden input -->
                 <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                    <input type="submit" value="Update Post" name="update">
                </div>

                <div class="group"> 
                    <input type="reset" value="Clear Post">
                </div>

            </div>
        </form>
                        <div class="controls">
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

                                </div>
                            </div>
                        </footer>

        </div>
    </div>

</body>
</html>