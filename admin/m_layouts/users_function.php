<?php
//    ===== FOR TITLE ===
/**
 * ========== VALIDATION PROCESS  FOR INPUT FIEILDS ===============
 * Validate and sanitize all input fields
 */
  

$patterns = "/^[a-zA-Z0-9\,\(\)\n]*$/";

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

if (empty($body)) {
    
$_SESSION['post_body'] = "Please add a Story";

}else {

$_SESSION['post_body'] = "";
}
// if (!empty($_POST['title'])  || !empty($_POST['author'])  || !empty($_POST['body']) || !empty($image) ) 
// {
//     $_SESSION['Success_message'] = "Success! Post Updated";
    
    
// }
if (empty($_POST['title'])  || empty($_POST['author'])  || empty($_POST['body']) || empty($_POST['image'])) {
    $_SESSION['Error_message'] = "Failed to add Post! Check all empty fields";
    
}else{
    $_SESSION['Success_message'] = "";
    $_SESSION['Error_message'] = "";
}

?>