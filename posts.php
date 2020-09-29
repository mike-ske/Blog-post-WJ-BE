<?php


require 'dbconn.php';

$title = "";
$author = "";
$body = "";
$image = "";
$user_image = "";

$submit = isset($_POST['submit']);

if ($submit) {

    $title = $_POST['title'];
    $author =  $_POST['author'];
    $body =  $_POST['body'];
    
    require 'config/function.php';


}


?>

<?php require 'header.php';?>
                   
    <!-- Form to add post -->
    <div class="form_head">
                        <?php
                        
                       
                        if (!empty($_SESSION['Success_message']) ) {
                            echo "<div class='msg_green' id='msg_green'>".$_SESSION['Success_message']."</div>";
                        }    

                        if (!empty($_SESSION['Error_message']) ) {
                            echo "<div class='msg' id='msg'>".$_SESSION['Error_message']."</div>";
                        }
                        if (isset($_SESSION['Error_message']) && isset($_SESSION['Success_message'])) {
                            unset($_SESSION['Success_message']);
                            unset($_SESSION['Error_message']);
                        }
                        
                        ?>
                   

        <div class="form">
    <h1 class="title">Posts</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div class="group">
                    <label for="title">Title</label>
                    <input type="text"  name="title" id="title" >
                      <?php
                            if (!empty($_SESSION['post_title'])) {
                                echo "<div class='msg'>".$_SESSION['post_title']."</div>";
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="author">Author of Post</label>
                    <input type="text"  name="author" id="author" >
                    <?php
                            if (!empty($_SESSION['post_author'])) {
                                echo "<div class='msg'>".$_SESSION['post_author']."</div>";
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" placeholder="Write Post here" ></textarea>
                    <?php
                            if (!empty($_SESSION['post_body'])) {
                                echo "<div class='msg'>".$_SESSION['post_body']."</div>";
                            }
                      ?>   
                </div>

                <div class="group-image">
                    <h4>Add Image Related Article</h4>
                    <label for="image"  class="image">Add Image</label>
                   <input type="file" name="image" id="image" Value="Add Image" >
                   <?php
                            if (!empty($_SESSION['post_image'])) {
                                echo "<div class='msg'>".$_SESSION['post_image']."</div>";
                            }
                      ?> 
                </div> 

              
                <div class="group-image">
                    <h4>Image of Author</h4>
                    <label for="userImage"  class="image">Add Author Image</label>
                   <input type="file" name="userImage" id="userImage" Value="Add Author Image" />
                        <?php
                            if (!empty($_SESSION['auth_image'])) {
                                echo "<div class='msg'>".$_SESSION['auth_image']."</div>";
                            }
                        ?> 
                </div> 

                <div class="submit">

                    <div class="group">
                        <input type="submit" value="Save Post" name="submit">
                    </div>

                    <div class="group"> 
                        <input type="reset" value="Clear Post">
                    </div>

                </div>
              

            </form>

        </div>
  
    </div>
</div>

    <?php require 'footer.php';?>

  

   