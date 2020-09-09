<?php
session_start();
require 'dbconn.php';

$submit = isset($_POST['submit']);

if ($submit) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $body = $_POST['body'];

    if ($_FILES) {

        $name = basename($_FILES['image']['name']);
        $tpname = $_FILES['image']['tmp_name'];
        $upload_dir = 'img_upload/';

        
        //Store the image path to upload to database
        $image_dir = $upload_dir . $name;

        //Now upload image to folder first
        move_uploaded_file($tpname, $image_dir);

          /**
         * After uploading to image to web folder or directory
         * you now upload path of image to Database Blog
         */
        
       // Write a query statement 
        $query = "INSERT INTO post(`title`, `author`, `body`, `image`) VALUES ('$title', '$author', '$body', '$image_dir')";
    

        //query the database
        $result = mysqli_query($conn, $query) or die('Failed to insert to Database! '. mysqli_error($conn));
        //check if post is uploaded
       
      if ($result) {
           $_SESSION['Error_message'] = 'Post failed to add post';
                echo $message = "Success! Posts Submited";
                header('Location: posts.php');
                return true;
            }else {
                $message = "Failed to Submit Post";
            }  
    }
}

?>

<?php require 'header.php';?>

    <!-- Form to add post -->
    <div class="form_head">
      
        <div class="form">
    <h1 class="title">Posts</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div class="group">
                    <label for="title">Title</label>
                    <input type="text"  name="title" id="title" >
                </div>

                <div class="group">
                    <label for="author">Author of Post</label>
                    <input type="text"  name="author" id="author" >
                </div>

                <div class="group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" placeholder="Write Post here" >
                    </textarea>
                </div>

                <div class="group-image">
                    <h4>Add Image of Author/Related Article</h4>
                    <label for="image"  class="image">Add Image</label>
                   <input type="file" name="image" id="image" Value="Add Image" required>
                    
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

   <script>
    //    var message = document.getElementById('message');
    //    var title = document.getElementById('title');
    //    var body = document.getElementById('body');

    //   function display() {
    //       message.style.display = "none";
    //   }
      
    //   message.onblur = function () {
    //         message.style.display="none";
    //     }

    
          }
        //   if (author.value > 2) {
        //       message.InnerHTML = "Fill all input fields";
        //       message.style.display = "block";
        //       author.focus();
        //       return false;
        //   }
        //   if (body.value  > 2) {
        //       message.InnerHTML = "Fill all input fields";
        //       message.style.display = "block";
        //       body.focus();
        //       return false;
        //   }
        //   if (body && author && title  !== "")  {
        //     message.style.background = "#7aff85";
        //     message.style.color = "#007e0a"
        //     message.style.display = "block";
        //     return true;
        //   }
      }

   </script>

   