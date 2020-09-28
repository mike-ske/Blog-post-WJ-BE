<?php require '../dbconn.php';?>
<?php require '../config/session.php';?>
<?php
$image = "";
$fname = "";
$lname = "";
$email = "";
$user = "";
$pass = "";


// ==== CHECK FOR EXISTING ACCOUNTS ======
$query = "SELECT * FROM admin_account" ;

//query the database
$acct_result = mysqli_query($conn, $query) or die('Failed to fetch from database');
//check if post is uploaded

$acct_response = mysqli_fetch_assoc($acct_result);
$acc_fname = $acct_response['fname'];
$acc_lname = $acct_response['lname'];
$acc_email = $acct_response['email'];
$acc_pass = $acct_response['password'];
$acc_user = $acct_response['username'];


$login = isset($_POST['signup']);

if ($login) {
        
    $image = "";
   
    $image = isset($_POST['image']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $user = mysqli_real_escape_string($conn,$_POST['username']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);

    

// =========VALIDATE INPUTS =========

//validate fisrt name and last name
    if (empty($fname) || empty($lname) ) {
        $_SESSION['Error_name'] = "Please add Fisrt name and Last name";
        
    }else {
        $_SESSION['Error_name'] = "";
    }

    $patterns = "/^[a-zA-Z0-9\,\(\)\n]*$/";
    if (isset($fname) &&  isset($lname)  && preg_match($patterns, $lname) && preg_match($patterns, $fname)) {
        
        $_SESSION['Error_name'] = "";
    }
    else {
        $_SESSION['Error_name'] = "Only letters allowed";
        
    }
    if ($fname === $acc_fname) {
        $_SESSION['Error_fname'] = "First name already exist! Add a different name";
        
    }else{
        $_SESSION['Error_fname'] = "";
    }

    if ($lname === $acc_lname) {
        $_SESSION['Error_lname'] = "Last name already exist! Add a different name";

    }else {
        $_SESSION['Error_lname'] = "";
    }

//Validate username and password
    if (empty($username) ) {
        $_SESSION['Error_username'] = "Please add Username";
    }else {
        $_SESSION['Error_username'] = "";
    }

    $patterns = "/^[a-zA-Z0-9\,\(\)\n]*$/";
   if (isset($user) && preg_match($patterns, $user)) {
        
        $_SESSION['Error_username'] = "";
        
    }
    else {
        $_SESSION['Error_username'] = "Only letters and numbers allowed";
    }

    if ($user === $acc_user) {
        $_SESSION['Error_username'] = "Username already exist! Add a different username";
        
    }else {
        $_SESSION['Error_username'] = "";
    }
//validate email input fields
    if (empty($email) ) {
        $_SESSION['Error_email'] = "Please add Email Address";
    }else {
        $_SESSION['Error_email'] = "";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $_SESSION['Error_email'] = "Please add a Valid Email Address";
        
    }else {
        
        $_SESSION['Error_email'] = "";

    }

    if ($email === $acc_email) {
        $_SESSION['Error_email'] = "Email already exist! Add a different username";
        
    }else {
        $_SESSION['Error_email'] = "";
    }
//validate pass input fields
    if (empty($pass) ) {
        $_SESSION['Error_password'] = "Please add password";
        
    }else {
        $_SESSION['Error_password'] = "";
    }

    if ($pass === $acc_pass) {
        $_SESSION['Error_password'] = "Password already exist! Add a different password";
        
    }else {
        $_SESSION['Error_password'] = "";
    }

    $patterns = "/^[a-zA-Z0-9\,\(\)\n]*$/";
    $number = "/[0-8]/";
    $chars = "/^\w+$/";
   if (isset($pass) && !preg_match($chars, $pass) && !preg_match($number, $pass) && !preg_match($patterns, $pass))
   { 
        $_SESSION['Error_password'] = "Password must contain an Uppercase, Lowercase letter and a Number ";
    }else {
        
        $_SESSION['Error_password'] = "";
    }
 
    if (strlen($pass) > 8) {
        $_SESSION['Error_password'] = "Password must be upto 8-digit";
    }
    else if (strlen($user) > 8) {
        $_SESSION['Error_username'] = "Username must be upto 8-digit";
    }
    
    // ============ VALIDATE FORM =================
        if (empty($fname) || empty($lname) || empty($email) || empty($user) || empty($pass) ) 
        {
            
            $_SESSION['Error_message'] = "Submition Failed! Please Check all fields. Must insert data into all fields";
        }
        else
        {
            //query the database
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admin_account(`fname`,`lname`,`email`,`username`,`password`)
                        VALUES('$fname','$lname','$email','$user','$pass')
                        ";
            $result = mysqli_query($conn, $sql);       
            header("location: login.php"); 
            
         }
   
// =========END OF VALIDATE INPUTS =========
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../hero_style.css">

</head>
<body onload="display()">
    
<div class="form_head">
                        <?php
                      
                        if (!empty($_SESSION['Error_message']) ) {
                            echo "<div class='msg' id='msg'>".$_SESSION['Error_message']."</div>";
                        }

                        if (!empty($_SESSION['acct_exist']) ) {
                            echo "<div class='msg' id='msg'>".$_SESSION['acct_exist']."</div>";
                        }
                        ?>
              
        <div class="form">
            <h1 class="title">Create account</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

            <div class="group">
                    <label for="fname">First name</label>
                    <input type="text"  name="fname" id="fname" >
                      <?php
                            if (!empty($_SESSION['Error_name'])) {
                                echo "<div class='msg'>".$_SESSION['Error_name']."</div>";
                            }
                            if (!empty($_SESSION['Error_fname'])) {
                                echo "<div class='msg'>".$_SESSION['Error_fname']."</div>";
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="lname">Last name</label>
                    <input type="text"  name="lname" id="lname" >
                      <?php
                            if (!empty($_SESSION['Error_name'])) {
                                echo "<div class='msg'>".$_SESSION['Error_name']."</div>";
                            }
                            if (!empty($_SESSION['Error_lname'])) {
                                echo "<div class='msg'>".$_SESSION['Error_lname']."</div>";
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="username">Username</label>
                    <input type="text"  name="username" id="username" >
                      <?php
                            if (!empty($_SESSION['Error_username'])) {
                                echo "<div class='msg'>".$_SESSION['Error_username']."</div>";
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="password">Password</label>
                    <input type="password"  name="password" id="password" >
                    <?php
                            if (!empty($_SESSION['Error_password'])) {
                                echo "<div class='msg'>".$_SESSION['Error_password']."</div>";
                            }
                      ?>
                </div>

                <div class="group">
                    <label for="email">Email</label>
                    <input type="email"  name="email" id="email" placeholder="e.g frankly@gmail.com..">
                    <?php
                            if (!empty($_SESSION['Error_email'])) {
                                echo "<div class='msg'>".$_SESSION['Error_email']."</div>";
                            }
                      ?>
                </div>

                <!-- USER PASSPORT -->
              
                <div class="group_info">
                    <h4 class="text_info">Already have an account? <a href="login.php" >Sign In</a></h4>
                </div>

                <div class="submit">

                    <div class="group">
                        <input type="submit" value="Sign Up" name="signup">
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
