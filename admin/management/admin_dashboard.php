<?php require '../dbconn.php';?>
<?php require '../config/session.php';?>

<?php 

if ($_GET['users']) {
    
    $user = $_GET['users'];

    // Query database to select users
    $sql = 'SELECT * FROM admin_account';

    //query the database
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        
        
        $post_pass =  $row['password'];
    
}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashbord</title>
    <link rel="stylesheet" href="../style.css">
    <!-- <link rel="stylesheet" href="../hero_style.css"> -->
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container">
                    <?php 
                    if (!empty($_SESSION['Login_message']) ) {
                        echo "<div class='msg_green' id='msg_green'>".$_SESSION['Login_message']."</div>";
                    }  
                    
                    ?>
        
        <header class="admin_header">
            <nav class="admin_nav">
                <div class="logo admin_logo">
                    <h1><a href="posts.php" style="color:#fff;text-decoration:none">Read<span class="logo-color">it.</span></a></h1>
                </div>

                <div class="admin_menu">
                    <ul class="admin_list">
                        <li class="admin_items"><a href="#" class="admin_link">Public</a></li>
                        <li class="admin_item2"><a href="#" class="admin_link">The Admin Name here&NonBreakingSpace; &RightAngleBracket;</a>
                            <ul class="sub_menu">
                                <li class="admin_item Sh"><a href="#" class="admin_link">Log Out</a></li>
                            </ul>
                        </li>                    
             
                    </ul>
                </div>

                <!-- <div class="bar_icon">
                    <img src="../img/align-to-right.png">
                </div> -->
            </nav>
        </header>

<!-- THE MAIN SECTION -->
        <section class="bg_grid">
            <div class="section">
                <ul class="side_bar">
                    <li class="side_item"><a href="admin_dashboard.php?users=1 " class="side_link">Manage Users</a></li>
                    <li class="side_item"><a href="admin_dashboard.php?id='post'" class="side_link">Manage Posts</a></li>
                    <li class="side_item"><a href="admin_dashboard.php?id='topic'" class="side_link">Manage Topics</a></li>
                </ul>
            </div>

            <div class="admin_main">
                <h1>Welcome to Dashbord</h1>
                <?php echo $post_user;
                    echo $post_pass;
                ?>
            </div>
        </section>

    </div>
</body>
</html>