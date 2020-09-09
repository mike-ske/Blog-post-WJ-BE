<?php

require 'dbconn.php';

//Write a query statement
$sql = 'SELECT * FROM post ORDER BY id DESC';

//query the database
$result = mysqli_query($conn, $sql);


?>

<?php require 'header.php';?>

<div class="hero_section">
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
                <a href="#"><h3 class="start">Get Started</h3></a>
                <a href="#"><h3 class="sign">Sign Up</h3></a>
            </div>
        </div>
        <div class="grid_logo"></div>
        
     
    </div>
    <div class="indicator">
            <div class="arrow_down">
                <a href="#footer"><img src="img/arrow-pointing-down.png"></a>
            </div>
    </div>
</div>

<!-- end of hero section -->
    <div class="main">
        <!-- Headline -->
        <div class="topic">
            <h2>Suggested Articles</h2>
        </div>
    
    <!-- end of headline -->
    
        <?php  while ($row = mysqli_fetch_array($result)) { 
             $id = $row['id'];
             $title = $row['title'];
             $author = $row['author'];
             $date = convertDate($row['date_created']);
                 $body = $row['body'];
                 $body_len = substr($body,0,100);
             $image = $row['image'];
          ?>
            <div class="main_post">
            
                <div class="post_image">
                    <img src="<?php echo $image;?>" class="img">
                </div>

              <div class="heading">
                        
                        <h1><?php echo $title; ?></h1>
                    <div class="side_image">
                        <img src="<?php echo $image;?>" alt="" class="auth_img">
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

            <?php foreach ($result as $results) {
                
                $author = $row['author'];
                    $body = $row['body'];
                    $body_len = substr($body,0,200);
                $image = $row['image'];
                
                ?>     
                <div class="sub_head">
            
                      <div class="sub_image">
                            <img src="<?php echo $image; ?>" alt="" class="auth_img">
                        
                            <h3 class="author"><?php echo $author;?></h3>
                                
                                <p><?php echo $body_len."....";?></p>
                            
                        </div>
                </div>
            <?php };?> 
             
            </div>
        
        </div>
       
        
    </div>

    <?php require 'footer.php';?>