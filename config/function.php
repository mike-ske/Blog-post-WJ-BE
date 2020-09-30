<?php

session_start();
/**
 * ========== VALIDATION PROCESS  FOR INPUT FIEILDS ===============
 * Validate and sanitize all input fields
 */
  

//getting the user id from create account table
$user_id = $_SESSION['userId'];


$patterns = "/^[a-zA-Z0-9\,\(\)\n]*$/";
//Check for valid input fields

//    ===== FOR TITLE ===
if (!preg_match($patterns, $title)) {
    $_SESSION['post_title'] = "Only letters and White spaces allowed";
    
}
if (empty($title)) {
    $_SESSION['post_title'] = "Please add a Title";
    
}//Check for Empty input fields
else {
    $_SESSION['post_title'] = "";
    }
//    ===== FOR AUTHOR ===
if (!preg_match($patterns, $author)) {
$_SESSION['post_author'] = "Only letters and White spaces allowed";

}
 if (empty($author)) {
$_SESSION['post_author'] = "Please add a Author";

}//Check for Empty input fields
else {
$_SESSION['post_author'] = "";
}

//    ===== FOR BODY===
if (!preg_match($patterns, $body)) {
$_SESSION['post_body'] = "Only letters and White spaces allowed";

}//Check for Empty input fields


if (empty($body)) {
    
$_SESSION['post_body'] = "Please add a Story";

}else {

$_SESSION['post_body'] = "";
}

//    ===== FOR IMAGE ===
if ($_FILES) {

    $user_image =  isset($_POST['userImage']);
    $image =  isset($_POST['image']);

            // Get image name
            $filename = $_FILES['image']['name'];

            // Get image size
            $filesize = $_FILES['image']['size'];

            //Get image type
            $filetype = $_FILES['image']['type'];

            //Get image tmp_path
            $filepath = $_FILES['image']['tmp_name'];
            
            //Get image extension
            $image_ext = pathinfo($filename, PATHINFO_EXTENSION);

            $image_format = array('jpg', 'png', 'gif', 'jpeg', 'bmp');
            
            //Check for image type jpg, png, gif,  
            if (!in_array($image_ext, $image_format)) {
                $_SESSION['post_image'] = "Not a valid file format e.g Accepts only jpg, jpeg, bmp and png";
                
            }
            if (empty($filename)) {
                $_SESSION['post_image'] = "Must add image";
            }else {
                $_SESSION['post_image'] = "";
            }
                // End of  validation
                $name = basename($_FILES['image']['name']);
                $tpname = $_FILES['image']['tmp_name'];
                $upload_dir = 'img_upload/';

                //Store the image path to upload to database
                $image_dir = $upload_dir . $name;

          
                //Now upload image to folder first
                $image_upload = move_uploaded_file($tpname, $image_dir);

// ============= ADD PASSPORT =============
          // Get image name
            $filename = $_FILES['userImage']['name'];

            // Get image size
            $filesize = $_FILES['userImage']['size'];

            //Get image type
            $filetype = $_FILES['userImage']['type'];

            //Get image tmp_path
            $filepath = $_FILES['userImage']['tmp_name'];
            
            //Get image extension
            $image_ext = pathinfo($filename, PATHINFO_EXTENSION);

            $image_format = array('jpg', 'png', 'gif', 'jpeg', 'bmp');
            
            //Check for image type jpg, png, gif,  
            if (!in_array($image_ext, $image_format)) {
                $_SESSION['auth_image'] = "Not a valid file format e.g Accepts only jpg, jpeg, bmp and png";
                
            }
            if (empty($filename)) {
                $_SESSION['auth_image'] = "Must add image";
            }else {
                $_SESSION['auth_image'] = "";
            }
                // End of  validation
                $name = basename($_FILES['userImage']['name']);
                $tpname = $_FILES['userImage']['tmp_name'];
                $upload_dir = 'user_image/';

                //Store the image path to upload to database
                $user_image_dir = $upload_dir . $name;

                
                //Now upload image to folder first
                $user_image_upload = move_uploaded_file($tpname, $user_image_dir);

    }
// =====================END OF PASSPORT ===========
    
        if (!empty($_POST['title'])  || !empty($_POST['author'])  || !empty($_POST['body']) || !empty($image) || !empty($user_image)) 
        {
            $_SESSION['Success_message'] = "Success! New Post Added";
        }
        if (empty($_POST['title'])  || empty($_POST['author'])  || empty($_POST['body']) || !empty($image) || !empty($user_image)) {
            $_SESSION['Error_message'] = "Failed to add Post! Check all empty fields";
            
        }else{
            $_SESSION['Success_message'] = "";
            $_SESSION['Error_message'] = "";
        }

        if ($user_image_upload == true && $image_upload == true) {
        
        // Write a query statement 
            $query = "INSERT INTO post(`title`, `author`, `body`, `image`, `author_image`, `userId`) VALUES ('$title', '$author', '$body', '$image_dir', '$user_image_dir', '$user_id')";

            //query the database
            $result = mysqli_query($conn, $query) or die('Failed to insert to Database! '. mysqli_error($conn));
        
        }else {

            $_SESSION['Error_message'] = "Failed to insert image. Check all fields to Add images";
        }



?>
