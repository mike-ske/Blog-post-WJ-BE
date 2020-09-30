<?php

session_start();
require 'dbconn.php';

$user_id = isset($_SESSION['userId']);

// ====== GET USER IMAGE FROM ACCOUNT TABLE =====

// Write a query statement
$pg_sql = "SELECT * FROM post ORDER BY id  DESC LIMIT 0,6";

//query the database
$pg_result = mysqli_query($conn, $pg_sql);
// for no post



?>

<?php require 'header.php';?>

<div class="hero_section">

                        <?php
                        
                        if (!empty($_SESSION['Login_message']) ) {
                            echo "<div class='msg_green wide' id='msg_green'>".$_SESSION['Login_message']."</div>";
                        }
                        if (isset($_SESSION['Login_message']) ) {
                            unset($_SESSION['Login_message']);
                        }

                        if (!empty($_SESSION['must_add']) ) {
                            echo "<div class='msg wide' id='msg_green'>".$_SESSION['must_add']."</div>";
                        
                        }
                        if (isset($_SESSION['must_add']) ) {
                            unset($_SESSION['must_add']);
                        }
                       
                        
                        ?>

    <div class="hero_headline bd_grid">
        <div class="grid">
            <h4 class="h4">Hi Welcome to</h4>
            <h1 class="h1">Readit  Blog</h1>
            <p class="p">Far far away, behind the word mountains, far 
                from the countries Vokalia and Consonantia, 
                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the 
                Semantics, a large language ocean.
            </p>
            <div class="hero_button">
                <a href="admin/login.php"><h3 class="start">Get Started</h3></a>
                <a href="admin/create_account.php"><h3 class="sign">Sign Up</h3></a>
            </div>
        </div>
        <div class="grid_logo">
        
        </div>
        
     
    </div>
    <div class="indicator">
            <div class="arrow_down">
                <a href="#topic"><img src="img/arrow-pointing-down.png"></a>
            </div>
    </div>
</div>

<!-- end of hero section -->
    <div class="main">
                                   
        <!-- Headline -->
        <div class="topic">
            <h2 id="topic">Suggested Articles</h2>
                <?php
                
                if (!empty($_SESSION['no_post']) ) {
                    echo "<div style='font-weight:bold;position: absolute;top: 45px;font-size: 20px;font-style: italic;' class='error'>".$_SESSION['no_post']."</div>";
                }  
                if (isset($_SESSION['no_post'])) {
                    unset($_SESSION['no_post']);
                }
               
                ?>
        </div>
    
    <!-- end of headline -->
    
        <?php  
        $sql = "SELECT * FROM post ORDER BY post.id DESC LIMIT 0,5";

        $result = mysqli_query($conn, $sql);

            $num_rows = mysqli_num_rows($result);
            if ($num_rows <= 0) {
                $_SESSION['no_post'] = "No Post Yet! Sign Up to add Post";
                
            }else if ($num_rows > 0){
                $_SESSION['no_post'] = "";
            }

        while ($row = mysqli_fetch_array($result) )
        { 
             $id = $row['id'];
             $title = $row['title'];
             
             $author = $row['author'];
             $date = convertDate($row['date_created']);
                 $body = $row['body'];
                 $body_len = substr($body,0,200);
             $image = $row['image'];
             $auth_image = $_SESSION['auth_image']= $row['author_image'];
          ?>
            <div class="main_post">
            
                <div class="post_image">
                    <img src="<?php echo $image;?>" class="img">
                </div>

              <div class="heading">
                        
                        <h1><?php echo $title; ?></h1>
                    <div class="side_image">
                        <img src="<?php echo $auth_image;?>" class="auth_img">
                        <h3 class="author"><?php echo $author;?></h3>
                        <h4 class="date"><?php echo $date;?></h4>
                    </div>
                    
                        <p><?php echo $body_len."....";?></p>
                        <h3 class="read_more">
                            <a href="view_posts.php?id=<?php echo $id?>">View Post</a>
                        </h3>
                     
                </div>
            </div>
        <?php };?> 

        <div class="main">
            <div class="topic">
                <h2>Recent Articles</h2>
            </div>
                 <div class="sub_main">

                        <?php 
                        
                        foreach ($pg_result as $results) 
                        {
                            $id = $results['id'];
                            $pg_author = $results['author'];
                                $pg_body = $results['body'];
                                $pg_body_len = substr($pg_body,0,100);
                            $pg_image = $results['author_image'];
                        ?>     
                            <div class="sub_head">
                                <a href="view_posts.php?id=<?php echo $id?>" style="text-decoration:none;color:#333;">
                                    <div class="sub_image">
                                        <img src="<?php echo $pg_image; ?>" class="auth_img">
                                    
                                        <h3 class="author"><?php echo $pg_author;?></h3>
                                            
                                            <p><?php echo $pg_body_len."....";?></p>
                                        
                                    </div>
                                </a>
                            </div>
                        <?php };?> 
                   
                    </div>
                                
                </div>
                          
       </div>
                               
 
    <?php require 'footer.php';?>

<?php

// $qr_sql = "SELECT * FROM post";
// $qr_result = mysqli_query($conn, $qr_sql);
// $total_rows = mysqli_num_rows($qr_result);

// $total_pages = ceil($total_rows/$row_per_page);

// if ($page > 1) {

//     echo '<a href="posts.php?id='.($page-1).'"  class="btn-primary">Previous</a>';
// }

// for ($i=1; $i < $total_pages; $i++) 
// { 

//     echo '<a href="posts.php?id='.$i.'"  class="btn-primary">'.$i.'</a>';
// }

// if ($i > $page) {

//     echo '<a href="posts.php?id='.($page+1).'"  class="btn-primary">Next</a>';
// }


?>