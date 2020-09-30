<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success | Page</title>

    <style>
    
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;

    }

    body {
       
        font-family: roboto;
        font-weight: normal;
        transition: all .3s ease-in-out;
        display:flex;
        align-content:center;
        justify-content:space-around;
    }

    .main {
        width: 100%;
        height: 500px;
        
        display: flex;
        align-items: center;
    }
    .container {
        width:500px;
        height:auto;
        margin:auto;
        padding:35px;
        box-shadow: 1px 0px 10px #ddd;
        text-align: center;
        background: #fff;
        border-radius: 10px;
    }
    
    .login{
        width:100px;
        height:auto;
        margin:auto;
        padding:10px;
        background: #9710cc;
        border-radius: 4px;
    }

    a {
        display:block;
        text-decoration:none;
        color: #fff;
        font-size:18px;
        font-weight:400;
        text-align:center;

    }
    .login:hover{
        background: #fff;
        transition: ease-in .3s all;
        border:1px solid #9710cc;
        box-shadow: 1px 0px 10px #999;
    }
    a:hover {

        color: #9710cc;
    }
    .head {
        
        width: auto;
        height:  auto;
        margin-bottom: 25px;
        text-align: center;
        font-size: 25px;
        color: #333;
        font-weight: 400;
        padding: 20px;
        line-height: 35px;
        color: #149d14;
    }
    </style>
</head>

<body>

<div class="main">
    <div class="container">
            <div class="head">
                <?php 

                    if (!empty($_SESSION['Success_message']) ) 
                    {
                    echo "<div class='msg_green' id='msg_green'>".$_SESSION['Success_message']."</div>";
                    }    
                    // if (!empty($_SESSION['Success_message'])) {
                    //     unset($_SESSION['Success_message']);
                    // }

                ?>
            </div>
            
            <div class="login">
                <h4>
                    <a href="login.php">login</a>
                </h4>
                
            </div>
        </div>
    </div>
</body>
</html>