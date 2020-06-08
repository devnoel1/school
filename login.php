<?php
session_start();
    include './config/config.php';
    
    $msg = "";
    $handle = new config();
    
     $calender = $handle->fetch("select * from act_cal where status = '1' ");
    
    $session = $calender['ses_id'];
    $term = $calender['term_id'];
    
    $_SESSION['ses_id'] = $session;
    $_SESSION['term_id'] = $term;
    
    if(isset($_POST['login'])){
        
        $username =$handle->validate($_POST['username']);
        $pass =$handle->validate($_POST['password']);
        
      
    
      
        $handle->login($username, $pass);
        
        $msg = $handle->status;
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
	<meta name="description" content="Unica University Template">
	<meta name="keywords" content="event, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/themify-icons.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
    </head>
    <style type="text/css">
        body{
            background: url('img/20200108_113923.gif') center 0;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .login-container
            {background-color: black; min-height:400px; border-radius:2px;padding: 6px;
             width: 40%;
             margin-left: 30%;
             margin-top: 10%;
             color: #fff;
             font-weight: 700;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
            
        }
        .cover{
            background-color: #000;
            width: 100%;
            height: inherit;
            position: absolute;
            opacity: .9;
            padding:  inherit;
        }
    </style>
    
    <body>
        <div class="cover">
            <div class="login-container">
                <div class="container p-3 mt-2">
                    <h2 class="text-white">Login</h2>
                    <hr/>
                       <form method="post" action="">
                           <?=$msg;?>
                           <div class="form-group">
                               <label>Username</label>
                               <input type="text" name="username" class="form-control" placeholder="E.g 13/0000/jis" required="required"/>
                           </div>
                           <div class="form-group">
                               <label>Password</label>
                               <input type="password" name="password" class="form-control" placeholder="Enter Password..." required="required"/>
                           </div>
                           <div class="form-group">
                               <button type="submit" name="login" class="btn btn-danger btn-block">Login</button>
                           </div>
                           
                       </form>
                   </div>
            </div>
        </div>    
<!--====== Javascripts & Jquery ======-->
        <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.countdown.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
    </body>
</html>
