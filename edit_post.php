<?php
require 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_FILES) {

        $name = basename($_FILES['image']['name']);
        $tpname = $_FILES['image']['tmp_name'];
        $upload_dir = 'img_upload/';

        
        //Store the image path to upload to database
        $image_dir = $upload_dir . $name;

        //Now upload image to folder first
        move_uploaded_file($tpname, $image_dir);
    }   

    $update_id = $_POST['update_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $body = $_POST['body'];
    
            // Write a query statement
            $sql = " UPDATE post SET title='$title', author='$author', body='$body', image='$image_dir' WHERE id = '$update_id' ";
    
            //query the database
            $queried = mysqli_query($conn, $sql) or die('Failed to insert to Database! '. mysqli_error($conn));
            //check if post is uploaded
            if ($queried  == true) {
                    header("Location: posts.php");
                    echo 'Success!';
                }else {
                    header("Location: edit_post.php");
                    echo "ERROR: " . mysqli_error($conn);
                } 
      
}
      

if (!empty($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);
        //Write a query statement
       
        // $query = 'SELECT * FROM post WHERE id = 1' ;
        $query = "SELECT * FROM post WHERE id = {$id}";
       
        
        //query the database
        $result = mysqli_query($conn, $query) or die('Failed to Fetch data from database');
        //check if post is uploaded
        $results = mysqli_fetch_assoc($result);
        
        $id = $results['id'];
        $title = $results['title'];
        $author =  $results['author'];
        $body = $results['body'];
        $image = $results['image'];
}   



?>

<?php require 'header.php';?>

    <!-- Form to add post -->
    <div class="form_head">
        <!-- Display success message when added -->
        
        <!-- End of success message -->

        <div class="form">
    <h1 class="title">Posts</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div class="group">
                    <label for="title">Title</label>
                    <input type="text"  name="title" id="title" value="<?php echo $title;?>">
                </div>

                <div class="group">
                    <label for="author">Author of Post</label>
                    <input type="text"  name="author" id="author" value="<?php echo $author;?>">
                </div>
    
                <div class="group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" placeholder="Write Post here" >
                        <?php echo $body; ?>
                    </textarea>
                </div>

                <div class="group-image">
                    <h4>Add Image of Author/Related Article</h4>
                    <label for="image"  class="image">Add Image</label>
                   <input type="file" name="image" id="image" required  value="<?php echo $image;?>">
                    
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

        </div>
  
    </div>
</div>

    <?php require 'footer.php';?>