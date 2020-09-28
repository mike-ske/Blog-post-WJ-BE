
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Posts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="hero_style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<body id="body" onsubmit="return submit()">
    <!-- Navigation Section-->

    <div class="container">
        <div class="nav_bar">
        <!-- Header section -->
            <div class="logo">
                <h1 style="color:#000;text-decoration:none;"><a href="index.php" style="text-decoration:none;">Read<span class="logo-color">it.</span></a></h1>
            </div>
            <div class="menu">
                <ul class="menu_items">
                    <li class="menu_list"><a href="index.php" class="active menu_link">Home</a> </li>
                    <li class="menu_list"><a href="#" class="active menu_link">Service</a></li>
                    <li class="menu_list">
                        <?php
                            if (!empty($_SESSION['add_post']) ) {
                                echo "<div id='name_green'><a href='posts.php' class='active menu_link'>".$_SESSION['add_post'] ."</a></div>";
                            }  

                        ?>
                    </li>
                    <li class="menu_list"> <a href="admin/login.php" class="menu_link">Get Creative</a></li>
                    <li class="menu_list hover_logout"> 
                        <?php
                            if (!empty($_SESSION['first_name']) ) {
                                echo "<div class='name_green' id='name_green'><a href='#' class='menu_link'>".$_SESSION['first_name'] ."</a></div>";
                            }  

                        ?>
                        <ul class="sub_menu_items">
                            <?php
                                if (!empty($_SESSION['Logout'])) {
                                  
                                    echo "<li class='sub_menu_list'><a href='admin/logout.php?id={$user_id}' class='sub_menu_link'>".$_SESSION['Logout']."</a></li>";
                                }  

                            ?>
     
                            <?php
                                if (!empty($_SESSION['manage_user'])) {
                                  
                                    echo "<li class='sub_menu_list'><a href='admin/manage_users/control.php?userId={$user_id}' class='sub_menu_link'>".$_SESSION['manage_user']."</a></li>";
                                }  

                            ?>

                            <?php
                                if (!empty($_SESSION['manage_admin'])) {
                                  
                                    echo "<li class='sub_menu_list'><a href='admin/manage_admin/view_post.php?id={$user_id}' class='sub_menu_link'>".$_SESSION['manage_admin']."</a></li>";
                                }  

                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  
 
    

  