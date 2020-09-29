<?php require '../dbconn.php';?>
<?php require '../config/session.php';?>

<?php

$user_id = $_SESSION['userId'];



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

// Load Composer's autoloader

require '../vendor/autoload.php';

 // ===== GET THE USER EMAIL FROM Database ======

$qry = "SELECT email, username FROM admin_account WHERE 1";
//query the database
$acct_result = mysqli_query($conn, $qry) or die('Failed to fetch from database');

   while ($acct_response = mysqli_fetch_array($acct_result)) 
   {
      $_SESSION['email'] = $acct_response['email'];
      $_SESSION['user'] = $acct_response['username'];
   }

// ======== GET USERS NAMES ==========
$sql = "SELECT * FROM admin_account WHERE id = ". $user_id;
$query = mysqli_query($conn, $sql) or die('Failed to fetch from database');
 $result= mysqli_fetch_assoc($query);
 $email1 = $result['email'];
    $fname = $result['fname'];
    $lname = $result['lname'];
$full_name = $fname.' '.$lname;


$send = isset($_POST['send']);

if ($send) 
{
   
// ===== GET THE USER EMAIL FROM FORM ======
    $email = mysqli_real_escape_string($conn,$_POST['email']);

    if (empty($email)) {

        $_SESSION['Empty_email'] = "Please add Email Address"; 
    }
    else 
    {       
        $_SESSION['Empty_email'] = "";
        
    }
//validate email input fields
    
    $encrypt = password_hash($email, PASSWORD_DEFAULT);
  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
        
        $_SESSION['Error_email'] = "Please add a Valid Email Address"; 
    }
    else if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {   
        $_SESSION['Error_email'] = "";
    }    
   
        // ========== USING PHP MAILER TO SEND EMAILS ==================
       
        // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer();

            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                     // SMTP username
            $mail->Password   = MAIL_PASSWORD;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('micahalumona@gmail.com', 'Readit Blog');
            $mail->addAddress($email, $full_name);     // Add a recipient
            $mail->addAddress($email);               // Name is optional

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset From Readit Blog';
            $mail->Body    = '<b>Reply to Reset Password</b> <br>
            Dear <b>'.$full_name.'</b> We have recieved your request to reset your password from 
            <b>Readit Blog</b> site and we are will reply you on your request to recover your password.<br><br>
            Please click on the link as you"ll be redirected to a page where <br>
            you can reset your password. click link <a href="pass_verify.php" style="text-decoration:none;list-style:none;">'.$encrypt.'</a> to reset password.';
       
            $mail->send();

            if ($mail->send()) {
                $_SESSION['Success_message'] = 'Message has been sent! Check your email for confirmation';

            }else {
                $_SESSION['Error_message'] =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                
            }
      
 
// ========== END OF PHP MAILER TO SEND EMAILS =================
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
<body>
    
<div class="form_head">
                      <?php
                       if (!empty($_SESSION['Success_message']) ) 
                        {
                        echo "<div class='msg_green' id='msg_green'>".$_SESSION['Success_message']."</div>";
                        }    
                        if (!empty($_SESSION['Success_message'])) {
                            unset($_SESSION['Success_message']);
                        }

                        if (!empty($_SESSION['Error_message']) ) 
                        {
                            echo "<div class='msg' id='msg'>".$_SESSION['Error_message']."</div>";
                        }
                        if (!empty($_SESSION['Error_message'])) {
                            unset($_SESSION['Error_message']);
                        }
                      
                      ?>
                   

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
                    <input type="text"  name="email" id="email" placeholder="e.g frankly@gmail.com..">
                    <?php
                            if (!empty($_SESSION['Error_email'])) {
                                echo "<div class='msg'>".$_SESSION['Error_email']."</div>";
                            }
                            if (!empty($_SESSION['Error_email'])) {
                                unset($_SESSION['Error_email']);
                            }
                            
                            if (!empty($_SESSION['Reg_email'])) {
                                echo "<div class='msg'>".$_SESSION['Reg_email']."</div>";
                            }
                            if (!empty($_SESSION['Reg_email'])) {
                                unset($_SESSION['Reg_email']);
                            }

                            if (!empty($_SESSION['Empty_email']) ) 
                            {
                                echo "<div class='msg' id='msg'>".$_SESSION['Empty_email']."</div>";
                            }
                            if (!empty($_SESSION['Empty_email'])) {
                                unset($_SESSION['Empty_email']);
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