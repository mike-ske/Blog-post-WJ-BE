<?php require '../dbconn.php';?>
<?php require '../config/session.php';?>
<?php

$login = isset($_POST['login']);

if ($login) {
    
    $user = mysqli_real_escape_string($conn,$_POST['username']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);
    
    
// =========VALIDATE INPUTS =========
    //validate user input fields
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
    //validate pass input fields
    if (empty($pass) ) {
        $_SESSION['Error_password'] = "Please add password";
        
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
    else
    {
        // ===================== CHECK FOR EXISTING ACCOUNTS ====================
    $sql = "SELECT * FROM admin_account WHERE `username` = '$user' ";

    //query the database
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
   
    if ($num_rows < 20) 
    {
        $row = mysqli_fetch_assoc($result);
        
        
        $_SESSION['adminId'] = $row['isAdmin'];
        $_SESSION['first_name'] = $row['fname']." ".$row['lname'];
        $_SESSION['userId'] = $row['id'];

        $post_user = $row['username'];
        $post_pass =  $row['password'];
     
        
        if ($user != $post_user) 
        {
           
            $_SESSION['Error_message'] = "Invalid Username or Password. Type a valid password or username";
            $_SESSION['Error_username'] = "Invalid Username";
        }
        else 
        { 
            $_SESSION['Error_username'] = "";
            $_SESSION['Error_message'] = "";
        }
        
        if (!password_verify($pass, $post_pass)) 
        {
            $_SESSION['Error_message'] = "Invalid Password. Type a valid password ";
            $_SESSION['Error_password'] = "Invalid Password";
        }
        else 
        {
            $_SESSION['Error_password'] = "";
        }

        // ======== PAGES ADMIN ================
        if ($user === $post_user && password_verify($pass, $post_pass) && $_SESSION['adminId'] == 1 ) 
        {
            $_SESSION['add_post'] = "Add Post";
            $_SESSION['manage_admin'] = 'Admin management';
            $_SESSION['Login_message'] = "You are loged in";
            header("location: ../index.php");
        }else 
        {
            unset($_SESSION['Login_message']);
            $_SESSION['Login_message'] = "";
            $_SESSION['manage_admin'] = "";
            
        }
        // password_verify($pass, $post_pass)
       
    // ======== PAGES USER ================
        if ($user === $post_user &&  password_verify($pass, $post_pass) && $_SESSION['adminId'] == 0 ) 
        {
    
        $_SESSION['manage_user'] = 'User management';
        $_SESSION['Login_message'] = "You are loged in";
        $_SESSION['Logout'] = "Logout"; 
        $_SESSION['add_post'] = "Add Post";
        header("location: ../index.php");
        }
        else 
        {
        $_SESSION['Login_message'] = "";
        $_SESSION['manage_user'] = "";
        $_SESSION['add_post'] = "";
        $_SESSION['service'] = "Service";
        
        }
     
    }

    }
   
}

// =========END OF VALIDATE INPUTS =========




?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../hero_style.css">

</head>
<body onload="display()" id="body">
    
<div class="form_head" >
                        <?php
                          if (!empty($_SESSION['Account_message']) ) {
                            echo "<div class='msg_green' id='msg_green'><div id='exit'>".$_SESSION['Account_message']."</div></div>";
                        }
                        if (!empty($_SESSION['Account_message'])) {
                            unset($_SESSION['Account_message']);
                        }

                        if (!empty($_SESSION['Success_message']) ) {
                            echo "<div class='msg_green' id='msg_green'>".$_SESSION['Success_message']."</div>";
                        }    
                        if (!empty($_SESSION['Success_message'])) {
                            unset($_SESSION['Success_message']);
                        }

                        if (!empty($_SESSION['Error_message']) ) {
                            echo "<div class='msg' id='msg'>".$_SESSION['Error_message']."</div>";
                        }
                        if (!empty($_SESSION['Error_message'])) {
                            unset($_SESSION['Error_message']);
                        }
                        ?>
                   

        <div class="form">
            <h1 class="title">Login</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
                <div class="group">
                    <label for="username">Username</label>
                    <input type="text"  name="username" id="username" >
                      <?php
                            if (!empty($_SESSION['Error_username'])) {
                                echo "<div class='msg'>".$_SESSION['Error_username']."</div>";
                            }
                            if (!empty($_SESSION['Error_username'])) {
                                unset($_SESSION['Error_username']);
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
                            if (!empty($_SESSION['Error_password'])) {
                                unset($_SESSION['Error_password']);
                            }
                      ?>
                </div>

                <div class="group_info">
                    <h4 class="text_info"><a href="../index.php" >Back </a> Don't have an account? <a href="create_account.php" >Sign Up</a></h4>
                </div>

                <div class="group_info">
                    <h4 class="text_info"><a href="forget_pass.php" >Forget password</a></h4>
                </div>

                <div class="submit">

                    <div class="group">
                        <input type="submit" value="Login" name="login">
                    </div>

                    <div class="group"> 
                        
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
   
</html>

