<?php require '../dbconn.php';?>
<?php require '../config/session.php';?>

<?php

$send = isset($_POST['send']);

if ($send) {
   
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    

//validate email input fields
    if (empty($email) ) {
        $_SESSION['Error_email'] = "Please add Email Address";
    }else {
        $_SESSION['Error_email'] = "";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $_SESSION['Error_email'] = "Please add a Valid Email Address";
        
    }else if (filter_var($email, FILTER_VALIDATE_EMAIL) ) 
    {   
        $_SESSION['Error_email'] = "";
        
    }else {
        
// ========== USING PHP MAILER TO SEND EMAILS ==================




// ========== END OF PHP MAILER TO SEND EMAILS =================
    }
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../hero_style.css">

</head>
<body onload="display()">
    
<div class="form_head">
                      
                   

        <div class="form">
            <h1 class="title">Reset Password</h1>
            <h6 class="reset">The Email Address is the address you used in signing into the account. If the
            email is a valid one, a link will be sent to your mail for you to activate your password.
            The link expires within 12 hrs. Click the link, you'll be redirected to another page for
            you to reset password. 
            </h>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >

             

                <div class="group">
                    <label for="email">Email</label>
                    <input type="email"  name="email" id="email" placeholder="e.g frankly@gmail.com..">
                    <?php
                            if (!empty($_SESSION['Error_email'])) {
                                echo "<div class='msg'>".$_SESSION['Error_email']."</div>";
                            }
                      ?>
                </div>

                <div class="group_info">
                    <h4 class="text_info">Don't have an account? <a href="create_account.php" >Sign Up</a></h4>
                </div>

                <div class="submit">

                    <div class="group">
                        <input type="submit" value="Send" name="send">
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