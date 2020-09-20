<?php

require '../dbconn.php';
require '../config/function.php';

$user_id = $_SESSION['userId'];
// require '../config/session.php';


//     //Write a query statement
 
    $query = "SELECT `title`, `author`, `userId`, `body`, `date_created`, `username`, `date_updated`,`image`, `author_image` FROM `post` INNER JOIN admin_account ON post.userId = admin_account.id WHERE post.userId = ". $user_id;

    $message = "";
    //query the database
    $result = mysqli_query($conn, $query) or die('Failed to fetch from database');
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="hero_style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>



            <div class="main_post view_post">
            <?php while ($response = mysqli_fetch_assoc($result)) {?>
                
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
            <?php }?>
 
</body>
</html>