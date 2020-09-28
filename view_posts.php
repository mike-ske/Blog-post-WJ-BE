<?php

require 'dbconn.php';

if ($_GET['id']) {
        
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //Write a query statement
    
    // $query = 'SELECT * FROM post WHERE id = 1' ;
    $query = "SELECT * FROM post WHERE id = " .$id;

    $message = "";
    //query the database
    $result = mysqli_query($conn, $query) or die('Failed to fetch from database');
    //check if post is uploaded

    $response = mysqli_fetch_assoc($result);
    
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    echo "<script>alert('Are you sure you want to delete this post!');</script>";
 
    $delete_id = $_POST['delete_id'];
    
    
        // Write a query statement
        $sql = "DELETE FROM post WHERE id = ".$delete_id;

        //query the database
        $result = mysqli_query($conn, $sql) or die('Failed to insert Into database');
        //check if post is uploaded
        
        $Smessage=$Emessage="";
      if ($result) {
                header("Location: index.php");
                $Smessage = 'Message deleted';
                
            }else {
                header("Location: view_posts.php");
                $Emessage = 'Message Not deleted';
            } 
  
    }
   



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
</head>
<body>

<?php require 'header.php';?>

            <div class="main_post view_post">
            
                <div class="post_image view_image">
                    <img src="<?php echo $response['image'];?>" class="img">
                </div>

              <div class="heading view_heading">
                        
                        <h1 class="view_h1"><?php echo $response['title']; ?></h1><hr>
                    <div class="side_image view_side_image">
                        <img src="<?php echo $response['author_image'];?>" alt="" class="auth_img">
                        <h3 class="author view_author"><?php echo $response['author'];?></h3>
                        <h4 class="date view_date"><?php echo convertDate($response['date_created']);?></h4>
                    </div>
                        <p class="view_body"><?php echo $response['body']?></p>
        
                       
                 <div class="buttons">
                        <h3 class="read_more view_read_more">
                                <a href="index.php">Back</a>
                        </h3>
                        <h3 class="read_more view_read_more">
                                <a href="edit_post.php?id=<?php echo $response['id'];?>">Edit Post</a>
                        </h3>

                           <!-- Create an hidden form to catch the present ID of this form -->
                        
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="view_read_more" >
                                
                                <input type="hidden" name="delete_id" value="<?php echo $response['id'];?>" >
                                    <button type="submit" name="delete" class=" delete" >Delete</button>
   
                            </form>
                </div>
                <!-- End of Hidden input -->
                </div>
            </div>
      
    <?php require 'footer.php';?>
</body>
</html>