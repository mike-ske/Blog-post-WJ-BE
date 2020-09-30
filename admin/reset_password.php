<?php
 require '../dbconn.php';
 require '../config/session.php';



    if (isset($_GET['email']) && $_GET['action'] === 'valid') 
    {
        $email = "";
           $valid = $_GET['action']; 
           $_SESSION['email'] = $_GET['email']; 
           $email = $_SESSION['email'];
           
                   // ===== GET THE USER PASSWORD FROM FORM ======
   
               $sql = "SELECT * FROM admin_account WHERE email = '$email'";
               $query = mysqli_query($conn, $sql);
               $num_row = mysqli_num_rows($query);
   
               if ($num_row < 20) 
               {
                   $result = mysqli_fetch_assoc($query);
                   $verify_email = $result['email'];
                   $fname = $result['fname'];
                   $lname = $result['lname'];
               $full_name = $fname.' '.$lname;
           
                   if ($email != $verify_email) 
                   {  
               
                       $_SESSION['invalid'] = "This link has been hacked by Unknown user. Resend link and try again.";
                   
                   }
                   else 
                   {    
                       $_SESSION['invalid'] = ""; 
                       
                   }
               }
    }

    
//  ============== GET PASSWORD FORM FORM ===================
$send = isset($_POST['send']);

if ($send && $_SESSION['email'] == true) 
{

    // ===== GET THE USER EMAIL FROM FORM ======
        $email = $_SESSION['email']; 
        $pass_1 = mysqli_real_escape_string($conn,$_POST['pass_1']);
        $pass_2 = mysqli_real_escape_string($conn,$_POST['pass_2']);
        $email_id = mysqli_real_escape_string($conn,$_POST['email_id']);
        
        $current_date = date("Y-m-d H:i:s");
       

        if ($pass_1 != $pass_2) {

            $_SESSION['password_match'] = "Password do not match. Please add the same password"; 
            $_SESSION['password_match_2'] = "Password do not match. Please add the same password"; 
        }
        else 
        {       
            $_SESSION['password_match'] = "";
            $_SESSION['password_match_2'] = "";
        }

    // ===VALIDATE FIRST PASSWORD
        if (empty($pass_1)) {

            $_SESSION['Empty_pass'] = "Please add password"; 
        }
        else 
        {       
            $_SESSION['Empty_pass'] = "";
            
        }

        if (empty($pass_2)) {

            $_SESSION['Empty_pass_2'] = "Please Confirm password"; 
        }
        else 
        {       
            $_SESSION['Empty_pass_2'] = "";
            
        }

        if (empty($pass_1) || empty($pass_2)) {

            $_SESSION['Error_message'] = "Fields Reqiured! Please add password"; 
        }
        else 
        {       
            $_SESSION['Error_message'] = "";

        $patterns = "/^[a-zA-Z0-9\,\(\)\n]*$/";
        $number = "/[0-8]/";
        $chars = "/^\w+$/";
    if (isset($pass_1) && !preg_match($chars, $pass_1) && !preg_match($number, $pass_1) && !preg_match($patterns, $pass_1))
    { 
            $_SESSION['Error_password'] = "Password must contain an Uppercase, Lowercase letter and a Number ";
        }else {
            
            $_SESSION['Error_password'] = "";
        }
    
        if (strlen($pass_1) > 8) {
            $_SESSION['Error_password'] = "Password must not be more than 8-digit";
        }

        // ===VALIDATE SECOND PASSWORD
       
    if (isset($pass_2) && !preg_match($chars, $pass_2) && !preg_match($number, $pass_2) && !preg_match($patterns, $pass_2))
    { 
            $_SESSION['Error_password_2'] = "Password must contain an Uppercase, Lowercase letter and a Number ";
        }else {
            
            $_SESSION['Error_password_2'] = "";
        }
    
        if (strlen($pass_2) > 8) {
            $_SESSION['Error_password_2'] = "Password must not be more than 8-digit";
        }
        else 
        {
            $pass_2 = password_hash($pass_2, PASSWORD_DEFAULT);
            
            $update_qry = "UPDATE `admin_account` SET `password` = '$pass_2', `date_updated_pass` = '$current_date' WHERE `email` = '$email' ";
            $result = mysqli_query($conn, $update_qry);

           
            if (!$result) {
               
                $_SESSION['Error_message'] = "Failed to update password. Please Check all empty fields";
                
            }
            else 
            {
                $_SESSION['Success_message'] = "Password Updated Successfully!. You can now login";
                header("Location: success_page.php");
            }
        }
            
    }            
        
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Page</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../hero_style.css">

</head>
<body>
    
<div class="form_head">
                      <?php
                         
                        if (!empty($_SESSION['Error_message']) ) 
                        {
                            echo "<div class='msg' id='msg'>".$_SESSION['Error_message']."</div>";
                        }
                        if (!empty($_SESSION['Error_message'])) {
                            unset($_SESSION['Error_message']);
                        }
                      
                        if (!empty($_SESSION['invalid']) ) 
                        {
                            echo "<div class='msg' id='msg'>".$_SESSION['invalid']."</div>";
                        }
                        if (!empty($_SESSION['invalid'])) {
                            unset($_SESSION['invalid']);
                        }
                      ?>
                   

        <div class="form">
            <h1 class="title">Verify Password</h1>
            <h6 class="reset">Please add a stong password so as to avoid password being hacked. Please Make 
            sure the password matches in each field.
            </h>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" >

                <div class="group">
                    <label for="pass_1" style="margin-bottom: 20px;text-align: left;display: flex;font-size: 16px;margin-top: 20px;">Password</label>
                    <input type="password"  name="pass_1" id="pass_1" >
                    <?php
                            if (!empty($_SESSION['Empty_pass'])) {
                                echo "<div class='msg'>".$_SESSION['Empty_pass']."</div>";
                            }
                            if (!empty($_SESSION['Empty_pass'])) {
                                unset($_SESSION['Empty_pass']);
                            }
                            
                            if (!empty($_SESSION['Error_password'])) {
                                echo "<div class='msg'>".$_SESSION['Error_password']."</div>";
                            }
                            if (!empty($_SESSION['Error_password'])) {
                                unset($_SESSION['Error_password']);
                            }

                            if (!empty($_SESSION['password_match'])) {
                                echo "<div class='msg'>".$_SESSION['password_match']."</div>";
                            }
                            if (!empty($_SESSION['password_match'])) {
                                unset($_SESSION['password_match']);
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="pass_2" style="margin-bottom: 20px;text-align: left;display: flex;font-size: 16px;">Confirm Password</label>
                    <input type="password"  name="pass_2" id="pass_2">
                    <?php
                            if (!empty($_SESSION['Empty_pass_2'])) {
                                echo "<div class='msg'>".$_SESSION['Empty_pass_2']."</div>";
                            }
                            if (!empty($_SESSION['Empty_pass_2'])) {
                                unset($_SESSION['Empty_pass_2']);
                            }
                            
                            if (!empty($_SESSION['Error_password_2'])) {
                                echo "<div class='msg'>".$_SESSION['Error_password_2']."</div>";
                            }
                            if (!empty($_SESSION['Error_password_2'])) {
                                unset($_SESSION['Error_password_2']);
                            }
                            if (!empty($_SESSION['password_match_2'])) {
                                echo "<div class='msg'>".$_SESSION['password_match_2']."</div>";
                            }
                            if (!empty($_SESSION['password_match_2'])) {
                                unset($_SESSION['password_match_2']);
                            }

                      ?>
                </div>

                <div class="submit">
                    <input type="hidden" name="email_id" value="<?php echo $email;?>">

                    <div class="group">
                        <input type="submit" value="Reset password" name="send">
                    </div>

                </div>

            </form>
        </div>
</div>
    <!-- footer section -->
  
    <div class="footer" id="foot">
        <div class="footer_text">
            <h3>Read<span class="base">it</span> Blog. Get Your Blog Online</h3>
            <div class="social_icon">
               <div class="logo_list">
                   <a class="list" href="https://www.facebook.com/micah.alumona"><img src="../img/facebook-logo-1.png"></a>
                   <a class="list" href="https://www.linkedin.com/mwlite/in/micah-alumona-4012161b0"><img src="../img/linkedin-sign.png"></a>
                   <a class="list" href="https://www.twitter.com/MicahAlumona"><img src="../img/twitter-sign.png"></a>
                   <a class="list" href="https://github.com/mike-ske"><img src="../img/github-logo.png"></a>
                   
                </div>
            </div>
            <h6>  Copyright  &copy; 2020 Created by Alumona Micah DEV <span class="cast">@Think Soft</span></h6>
        </div>
    </div>
</body>
                      