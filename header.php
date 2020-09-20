
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Posts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="hero_style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<body id="body" onsubmit="return submit()">
    <!-- Navigation Section-->

    <div class="container">
        <div class="nav_bar">
        <!-- Header section -->
            <div class="logo">
                <h1 style="color:#000;text-decoration:none;"><a href="posts.php" style="text-decoration:none;">Read<span class="logo-color">it.</span></a></h1>
            </div>
            <div class="menu">
                <ul class="menu_items">
                    <li class="menu_list"> <a href="index.php" class="active menu_link">Home</a> </li>
                    <li class="menu_list"> <a href="posts.php" class="menu_link">Add Post</a> </li>
                    <li class="menu_list"> <a href="admin/login.php" class="menu_link">Admin</a></li>
                    <li class="menu_list"> <a href="#" class="menu_link">
                        <?php
                            if (!empty($_SESSION['first_name']) ) {
                                echo "<div  id='name_green'>".$_SESSION['first_name'] ."</div>";
                            }  

                        ?>
                    
                    </a></li>
                </ul>
            </div>
        </div>
    </div>
  
    <?php
     if (!empty($_SESSION['Login_message']) ) {
        echo "<div class='msg_green wide' id='msg_green'>".$_SESSION['Login_message']."</div>";
    }  

    ?>
    

  