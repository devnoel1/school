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
<html>
<head>
<title>Login</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	 <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

	<!-- Custom Theme files -->
        <link href="css/login_style.css" rel="stylesheet" type="text/css" media="all" />
        
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
      
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
	<!-- //web font -->

</head>
<body>

<!-- main -->
<div class="w3layouts-main"> 
	<div class="bg-layer">
		<h1>Login</h1>
		<div class="header-main">
			<div class="main-icon">
				<!--<span class="fa fa-eercast"></span>-->
			</div>
			<div class="header-left-bottom">
				<form method="post">
                                    <?=$msg;?>
					<div class="icon1">
						<span class="fa fa-user"></span>
                                                <input type="text" name="username" placeholder="Enter Username " required=""/>
					</div>
					<div class="icon1">
						<span class="fa fa-lock"></span>
                                                <input type="password" name="password" placeholder="Enter Password" required=""/>
					</div>
					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Keep me logged in</label>
					</div>
					<div class="bottom">
                                            <button class="btn" name="login" type="submit">Log In</button>
					</div>
					<div class="links">
						<p><a href="#">Forgot Password?</a></p>
						
						<div class="clear"></div>
					</div>
				</form>	
			</div>
			
		</div>
		
	
		<!-- //copyright --> 
	</div>
</div>	
<!-- //main -->

</body>
</html>