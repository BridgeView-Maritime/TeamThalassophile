	<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo $baseurl;?>images/favicon.png">
        <title>Team Thalassophile !</title> 
		 
        <link href="<?php echo $baseurl;?>css/global.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo $baseurl;?>css/style.css" rel="stylesheet">
		<link href="<?php echo $baseurl;?>css/plan.css" rel="stylesheet">
        <link href="<?php echo $baseurl;?>css/responsiveness.css" rel="stylesheet"> 
		        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="blue-skin">
    
    <!-- ======================= Start Navigation ===================== -->
    	<?php if($home==1) { ?>
			<nav class="navbar navbar-default navbar-mobile navbar-fixed white no-background bootsnav">
        <?php } else { ?>
        	<nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav on">
        <?php } ?>
			<div class="container">

 

				<!-- Start Logo Header Navigation -->
				<div class="navbar-header" >
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="fa fa-bars"></i>
					</button>
                    <a  class="navbar-brand" href="<?php echo $baseurl;?>" title="">
                    	<img src="<?php echo $baseurl;?>/images/logo-teamthalassophile.png" alt="JobSEAkers" class="logo logo-display" width="250" height="50" />
                        <img src="<?php echo $baseurl;?>/images/logo-teamthalassophile.png" alt="JobSEAkers" class="logo logo-scrolled" />
                    </a>
					
				</div>
				<!-- End Logo Header Navigation -->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-menu">
				
					<ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp" style="margin-top: 10px;">
					
						<li>
							<h4> <a href="<?php echo $baseurl;?>" title="Home">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Home</a> </h4>
						</li>
                        
                        <li>
							<h4> <a href="<?php echo $baseurl;?>about-us.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  About Us</a> </h4>
						</li>
                        
						<!--<?php if(empty($_SESSION["USER"]['ID']) && empty($_SESSION["EMP"]['ID'])) { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobseeker</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="<?php echo $baseurl;?>jobseekers-login.php">Login</a></li>
								<li><a href="<?php echo $baseurl;?>jobseekers-register.php">Create Your Profile</a></li>
							</ul>
						</li>
                        <?php } else { if($_SESSION["USER"]['Type']=="Jobseeker") { ?>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobseeker</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="<?php echo $baseurl;?>jobseekers-dashboard.php">Dashboard</a></li>
								<li><a href="<?php echo $baseurl;?>logout.php">Logout</a></li>
							</ul>
						</li>
                        <?php } } ?>
                        
                        <?php if(empty($_SESSION["USER"]['ID']) && empty($_SESSION["EMP"]['ID'])) { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Employer</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="<?php echo $baseurl;?>employer-login.php">Login</a></li>
								<li><a href="<?php echo $baseurl;?>employer-register.php">Create Your Profile</a></li>
							</ul>
						</li>
                        <?php } else { if($_SESSION["EMP"]['Type']=="Employer") { ?>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Employer</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="<?php echo $baseurl;?>employer-dashboard.php">Dashboard</a></li>
								<li><a href="<?php echo $baseurl;?>logout.php">Logout</a></li>
							</ul>
						</li>
                        <?php } } ?>
                        <li>
							<h4> <a href="<?php echo $baseurl;?>search-result-jobs.php"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Jobs</a> </h4>
						</li>
                        
                        <li>
							<h4> <a href="<?php echo $baseurl;?>search-result-jobseekers.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Jobseekers</a> </h4>
						</li>   

						-->
						
						<!--
						<li>
							<a href="<?php echo $baseurl;?>courses-list.php">Courses/Events</a>
						</li>  -->
                        
                        <li>
							<h4> <a href="<?php echo $baseurl;?>contact-us.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact Us</a> </h4>
						</li>
                        
                        
						
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
                     	<?php if(empty($_SESSION["EMP"]['ID']) && empty($_SESSION["USER"]['ID'])) { ?>
						<li class="br-right"><a href="javascript:void(0)"  data-toggle="modal" data-target="#signin"><i class="login-icon ti-user"></i>Login</a></li>
						<li class="sign-up"><a class="btn-signup red-btn"  href="javascript:void(0)"  data-toggle="modal" data-target="#signup"><span class="ti-briefcase"></span>Sign Up</a></li> 
                        <?php } else { ?>
                        
                        <?php if($_SESSION["USER"]['Type']=="Jobseeker") { 
						  echo '<li class="br-right">
                            <a href="'.$baseurl.'jobseekers-dashboard.php">My Profile</a>
                          </li>'; } ?>
                          
                          <?php if($_SESSION["EMP"]['Type']=="Employer") { 
						  echo '<li class="br-right">
                            <a href="'.$baseurl.'employer-dashboard.php">My Profile</a>
                          </li>'; } ?>                          
                        <li class="sign-up"><a class="btn-signup red-btn" href="<?php echo $baseurl;?>logout.php"><span class="ti-briefcase"></span>Logout</a></li> 
                        <?php } ?>
					</ul>
						
				</div>
				<!-- /.navbar-collapse -->
			</div>   
		</nav>
		<!-- ======================= End Navigation ===================== -->