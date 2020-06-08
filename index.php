<?php
session_start();
    
    include 'config/config.php';
    
    $handle = new config();

    $calender = $handle->fetch("select * from act_cal where status = '1' ");
    
    $session = $calender['ses_id'];
    $term = $calender['term_id'];
    
    $_SESSION['ses_id'] = $session;
    $_SESSION['term_id'] = $term;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Jis - Home Page</title>
	<meta charset="UTF-8">
	<meta name="description">
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
<body>
	<!-- Page Preloader -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- header section -->
	<header class="header-section">
		<div class="container-fluid">
			<!-- logo -->
            <a href="index.html"><img src="img/logo.png" width="350" alt=""></a>
                       <!-- <h3 style="font-weight: 800" class="brand-text">Josephine International Schools</h3>-->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			
		</div>
	</header>
	<!-- header section end-->


	<!-- Header section  -->
	<nav class="nav-section">
		<div class="container">
			<div class="nav-right">
                            <a href="signup.php">Login</a>
			</div>
			<ul class="main-menu">
                            <li <?php if(!isset($_GET['p']))echo 'class="active"';?>><a href="index.php">Home</a></li>
                                <li <?php if(@$_GET['p']=='abt')echo 'class="active"';?>><a href="index.php?p=abt">About Us</a></li>
                                <li <?php if(@$_GET['p']=='adm')echo 'class="active"';?>><a href="index.php?p=adm">Admission</a></li>
                                <li <?php if(@$_GET['p']=='pta')echo 'class="active"';?>><a href="index.php?p=pta">PTA</a></li>
                                
			</ul>
		</div>
	</nav>
	<!-- Header section end -->
<?php
 if(!isset($_GET['p'])){
     ?>
        
        <!-- Hero section -->
        <section class="hero-section">
		<div class="hero-slider owl-carousel">	
                    <div class="hs-item set-bg" data-setbg="img/hero-slider/b.jpg">
			<div class="overley">
                            <div class="hs-text">
                                <div class="container">
                                    <div class="row">
					<div class="col-lg-8">
						<div class="hs-subtitle"> </div>
						 <h2 class="hs-title">Welcome To Josehine International Schools Makurdi </h2>
						 <p class="hs-des"></p>
					 </div>
                                    </div>
                                </div>
                            </div>
 			</div>     
                    </div>
                    
		<div class="hs-item set-bg " data-setbg="img/hero-slider/3.jpg">
                    <div class="overley">        
                        <div class="hs-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 ">
                                        <div class="hs-subtitle"></div>
                                        <h2 class="hs-title">An investment in knowledge pays the best interest.</h2>
                                        <p class="hs-des"></p>			
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
		</div>
                        
                <div class="hs-item set-bg " data-setbg="img/hero-slider/4.jpg">
                    <div class="overley">
                        <div class="hs-text">
                            <div class="container">
				<div class="row">
                                    <div class="col-lg-8">
					<div class="hs-subtitle"></div>
					<h2 class="hs-title">EDUCATION</h2>
                                        <p class="hs-des">Education is not just about 
                                        going to school and getting a degree. It's about 
                                        widening your<br> knowledge and absorbing 
                                        the truth about life. Knowledge is power.</p>
								
                                    </div>
				</div>
                            </div>
			</div>
                    </div>
		</div>
        </div>
</section>
	<!-- Hero section end -->


	<!-- Counter section  -->
	<section class="counter-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-6">
					<div class="big-icon">
						<i class="fa fa-graduation-cap"></i>
					</div>
					<div class="counter-content">
						<h2>VISION STATEMENT:</h2>
						<p>
                                                    To combine qualitative education,timeless training and timely truth in child development.
                                                </p>
					</div>
				</div>
				
			</div>
		</div>
	</section>
        
        	<!-- Blog section 
	<section class="blog-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h3>LATEST NEWS</h3>
				<p>Get latest breaking news & top stories today</p>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="blog-item">
						<div class="blog-thumb set-bg" data-setbg="img/blog/1.jpg"></div>
						<div class="blog-content">
							<h4>Parents who try to be their children’s best friends</h4>
							<div class="blog-meta">
								<span><i class="fa fa-calendar-o"></i> 24 Mar 2018</span>
								<span><i class="fa fa-user"></i> Owen Wilson</span>
							</div>
							<p>Integer luctus diam ac scerisque consectetur. Vimus dot euismod neganeco lacus sit amet. Aenean interdus mid vitae sed accumsan...</p>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="blog-item">
						<div class="blog-thumb set-bg" data-setbg="img/blog/2.jpg"></div>
						<div class="blog-content">
							<h4>Graduations could be delayed as external examiners</h4>
							<div class="blog-meta">
								<span><i class="fa fa-calendar-o"></i> 23 Mar 2018</span>
								<span><i class="fa fa-user"></i> Owen Wilson</span>
							</div>
							<p>Integer luctus diam ac scerisque consectetur. Vimus dot euismod neganeco lacus sit amet. Aenean interdus mid vitae sed accumsan...</p>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="blog-item">
						<div class="blog-thumb set-bg" data-setbg="img/blog/3.jpg"></div>
						<div class="blog-content">
							<h4>Private schools adopt a Ucas style application system</h4>
							<div class="blog-meta">
								<span><i class="fa fa-calendar-o"></i> 24 Mar 2018</span>
								<span><i class="fa fa-user"></i> Owen Wilson</span>
							</div>
							<p>Integer luctus diam ac scerisque consectetur. Vimus dot euismod neganeco lacus sit amet. Aenean interdus mid vitae sed accumsan...</p>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="blog-item">
						<div class="blog-thumb set-bg" data-setbg="img/blog/4.jpg"></div>
						<div class="blog-content">
							<h4>Cambridge digs in at the top of university league table</h4>
							<div class="blog-meta">
								<span><i class="fa fa-calendar-o"></i> 23 Mar 2018</span>
								<span><i class="fa fa-user"></i> Owen Wilson</span>
							</div>
							<p>Integer luctus diam ac scerisque consectetur. Vimus dot euismod neganeco lacus sit amet. Aenean interdus mid vitae sed accumsan...</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
-->
        
    <?php 
 }elseif (@$_GET['p']=='abt') {
    ?>
        
	<!-- Breadcrumb section -->
	<div class="site-breadcrumb">
		<div class="container">
			<a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i>
			<span>About Us</span>
		</div>
	</div>
	<!-- Breadcrumb section end -->


	<!-- About section -->
	<section class="about-section spad pt-0">
		<div class="container">
			<div class="section-title text-center">
				<h3>WELCOME TO JOSPHINE SCHOOL</h3>
				<p>Let children creative and make a different</p>
			</div>
			<div class="row">
				<div class="col-lg-6 about-text">
					<h5>About us</h5>
                                        <p>
                                            
                                        </p>
					<h5 class="pt-4">Our history</h5>
                                        <p style="font-size: 15px;">
                                            Josephine International Schools Makurdi, started on september 4, 2011 with a pre-Nursery, Nursery and Primaries 1 to 3 sections. Three teachers started it but within a week, two of them resigned including the founding head teacher. Only miss Maria and master David Onyilo were left. No pupil whoever enrolled in school ever remained the same after a week. Special attention was given to each child until she or he could write or read or spell after enrolling in our school. All J.I.S. TEACHERS must always be commended for this. The proprietor who paid extralesson fees to teachers for further instructions deserves commendation too.
However, after a week, six new teachers were employed  including new head teacher, mrs Ann Amile. French language, Computing and Music were later introduced with additional teaching and technical staff. The total number of pupils were 103 at the end of first Term. Many did not pay school fees and l refused that pupils be sacked for school feels. The Pioneer Head Teacher refused classes 4 & 5 seeking admission. Regrettably certain staff who opposed our modest efforts to move forward were relieved of their duties because we believe that all hands must be on deck to achieve this noble goal. 
By Second Term, a new drive to take the school to higher heights was envisaged which brought on board the current Acting Director, Miss Christiana Odey. She exhibited the courage to move the school from from Primary 3 to Primary 6, an objective that the former Head Teacher not only opposed but refused to support. By God s grace, with teachers like Mr Joseph Atinga Mr Isaac and Miss Martha, the number of pupils were trippled before they finally reduced to 265. Most old teachers objected to our move.
We gave scholarship to many pupils including all Primary 4, 5 and 6 pupils and a few in lower classes. Today by the grace of God, the first Common Entrance Examination has been conducted and concluded with 70 pupils in attendance.  The First Graduation Ceremony qnd Prize giving day has also come and gone. JIS Makurdi has almost 20  academic and non-academic staff most of whom are University graduates.  This is outside the 5 NYSC members just sent for primary service at JIS MAKURDI.
Our preparation for secondary school section is in progress to the glory of God almighty. We must progress with additional staff to be employed in the next one month. 
                                        <ol>
                                            <li>Mrs. Anne Amile		-	September  2011 to January 2012 (Head Teacher)</li>
                                            <li>Miss Christiana Odey		-	January 2012 to date (Acting DIRECTOR)</li>
                                        </ol>	
                                        </p>
					
				</div>
				<div class="col-lg-6 pt-5 pt-lg-0">
                                    <img src="img/nn.jpg" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- About section end-->
        <!-- Fact section -->
	<section class="fact-section spad set-bg" data-setbg="img/fact-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 fact">
					<div class="fact-icon">
						<i class="ti-crown"></i>
					</div>
					<div class="fact-text">
						<h2>50</h2>
						<p>YEARS</p>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3 fact">
					<div class="fact-icon">
						<i class="ti-briefcase"></i>
					</div>
					<div class="fact-text">
						<h2>20</h2>
						<p>TEACHERS</p>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3 fact">
					<div class="fact-icon">
						<i class="ti-user"></i>
					</div>
					<div class="fact-text">
						<h2>300</h2>
						<p>STUDENTS</p>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3 fact">
					<div class="fact-icon">
						<i class="ti-pencil-alt"></i>
					</div>
					<div class="fact-text">
						<h2>30+</h2>
						<p>LESSONS</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Fact section end-->

	<!-- Team section  -->
	<section class="team-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h3>OUR TEAM</h3>
				<p>The professional standards and expectations</p>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<div class="member">
						<div class="member-pic set-bg" data-setbg="img/member/1.jpg">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
						<h5>Sasha Johnson</h5>
						<p>Literature Teacher</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="member">
						<div class="member-pic set-bg" data-setbg="img/member/2.jpg">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
						<h5>Darmian Shaw</h5>
						<p>Physics Teacher</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="member">
						<div class="member-pic set-bg" data-setbg="img/member/3.jpg">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
						<h5>Joshua Matt</h5>
						<p>Matt Teacher</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="member">
						<div class="member-pic set-bg" data-setbg="img/member/4.jpg">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
						<h5>Taylor Launer</h5>
						<p>Music Teacher</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Team section end -->

        
   <?php     
}elseif(@$_GET['p']=='adm'){
    ?>
        
        	<!-- Enroll section -->
	<section class="enroll-section spad set-bg" data-setbg="img/enroll-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="section-title text-white">
						<h3>ENROLLMENT</h3>
						<p>Get started with us to explore the exciting</p>
					</div>
					<div class="enroll-list text-white">
						<div class="enroll-list-item">
							<span>1</span>
							<h5>ADMISSION PROCEDURE</h5>
							<p>
                                                            On payment of a non-refundable application fee of N1,500.00, a child will be
                                                            examine his/her entry point. Successful applicants will the be issued with:
                                                        <ol>
                                                            <li>Admission forms</li>
                                                            <li>A Bank teller</li>
                                                            <li>Medical Form</li>
                                                            <li>Three files (for Administrative class and medical records)</li>
                                                        </ol>
                                                        The child returns the completed forms and a copy of the teller 
                                                        showing evidence of payment accompanied with the following
                                                        </p>
						</div>
						<div class="enroll-list-item">
							<span>2</span>
							<h5>REQUIMENTS</h5>
                                                        <p>
                                                        <ul class="nav">
                                                            <li><i class="fa fa-snowflake-o"></i> 3 recent passport photographs</li>
                                                            <li><i class="fa fa-snowflake-o"></i> 3 office flat files (obtained at the school)</li>
                                                            <li><i class="fa fa-snowflake-o"></i> Last academic result where applicable</li>
                                                            <li> <i class="fa fa-snowflake-o"></i> Last cartificate</li>
                                                            <li> <i class="fa fa-snowflake-o"></i> Medical cartificate</li>
                                                            <li> <i class="fa fa-snowflake-o"></i> Letter of undertaken by Parent/Guardian</li>
                                                             
                                                        </ul>
                                                        </p>
						</div>
						<div class="enroll-list-item">
							<span>3</span>
							<h5>Contact</h5>
							<p>
                                                            
                                                        </p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 offset-lg-1 p-lg-0 p-4">
					<img src="img/encroll-img.jpg" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- Enroll section end -->


  <?php      
}elseif (@$_GET['p']=='pta') {
      ?>
        
     	<!-- Blog section -->
	<section class="blog-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h3>PTA</h3>
				<p>The school has a standing Parent-Teacher Association that<br/> contributes to the development of the school and the children.</p>
			</div>
			<div class="row">
				
				
                            
				
                            
				
			</div>
		</div>
	</section>
	<!-- Blog section -->
 
        
 <?php 
  }
?>

      
<?php
 if(isset($_GET['p'])){
     ?>
      
	<footer class="footer-section">
           	
		<div class="copyright">
			<div class="container">
				<p>
Copyright &copy; josphine school makurdi <script>document.write(new Date().getFullYear());</script> All rights reserved
</p>
			</div>		
		</div>
	</footer>  
 <?php
 }
?>

      
	<!-- Footer section end-->
     
	

	<!--====== Javascripts & Jquery ======-->
        <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.countdown.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>