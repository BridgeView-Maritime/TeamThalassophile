<?php include("includes/config.php"); 
$home = 1;
include("app/gtheader.php"); 
?>

<!-- ======================= Start Banner ===================== -->
		
	<!--	<div class="main-banner" style="background-image:url(assets/img/banner-1.jpg);" data-overlay="2"> -->
<!DOCTYPE html>
<html>
<head>


</head>

<body>
		



		<div class="main-banner" data-overlay="2">
			<div class="container">
				<div class="col-md-12 col-sm-12">
				
					<div class="caption text-center ">
						<h2 class="them-color" style="margin-bottom: 100px;font-family: Verdana, Geneva, sans-serif;font-size: 400%;"> 
						Get A Job You Deserve</h2>
					</div>
					
				<div class="container">

					<style>

						@media only screen and (min-width:700px){

							#thumbnail{ width:97%; }
							#thumbpad{padding-left:0;padding-right: 0;}

						}
						.thumbnail{padding: 0px !important;}
						
					</style>

  				<div class="row" id="thumbnail">

    			 	<div class="col-md-4 col-sm-12" id="thumbpad">
      				<div class="thumbnai">
        				<a href="#">
          					<img src="images/ship1.jpeg" alt="Lights" style="width:100%">
        				</a>
      				</div>
    				</div>

    				<div class="col-md-4 col-sm-12" id="thumbpad">
      				<div class="thumbnai">
        				<a href="#">
          					<img src="images/ship2.jpeg" alt="Nature" style="width:100%">
        				</a>
      				</div>
    				</div>

    				<div class="col-md-4 col-sm-12" id="thumbpad">
      				<div class="thumbnai">
        				<a href="#">
          					<img src="images/ship3.jpeg" alt="Fjords" style="width:100%">
						</a>
      				</div>
    				</div>
  				
  				</div>
				</div>


					<form action="<?php echo $baseurl;?>search-result-jobs.php" method="get" enctype="multipart/form-data" name="gtsearchjobform" id="gtsearchjobform">

						<!--
						<fieldset class="home-form-1">
						
							<div class="col-md-4 col-sm-4 padd-0">
								<input type="text" class="form-control br-1" name="keywords" id="keywords" placeholder="Skills, Designation, Companies" />
							</div>
								
							<div class="col-md-3 col-sm-3 padd-0">
								<?php echo todisplaymultiplewithgroupname($array_aus_location, $array_newze_location, "", "", "", "", "Australia, New Zealand", 'location', "All Location", $_GET["location"], $onchange=""); ?>
							</div>
								
							<div class="col-md-3 col-sm-3 padd-0">
								<?php echo todisplaymultiplewithgroupname($array_category_shore, $array_category_offshore, "", "", "", "", "Shore Categories, Offshore Categories", 'category', "All Category", $_GET["category"], $onchange=""); ?>
							</div>
								
							<div class="col-md-2 col-sm-2 padd-0 m-clear">
								<button type="submit" name="rws_formsubmit" class="btn theme-btn cl-white seub-btn">FIND JOB</button>
							</div>
								
						</fieldset>  -->


						<style>
							#abc>li {width: 30%;}
						</style>


		<section>
			<div class="container">
			
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-advance theme-bg" id="abc" role="tablist" style="max-width: 1000px;">
					<li class="nav-item active">
						<a class="nav-link" data-toggle="tab" href="#recent" role="tab">
						 Jobs in Aramco</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">
						Jobs in Adnoc </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">
						More Jobs</a>
					</li>
				</ul>
				
				<div class="tab-content">
					
					<!-- Recent Job -->
					<div class="tab-pane fade in show active" id="recent" role="tabpanel">
						<div class="row">						
							<?php 
			
								$todaydate = date("Y-m-d");
								
								$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND t1.start_date<='$todaydate' AND t1.end_date>='$todaydate' ORDER BY add_date DESC LIMIT 0, 8";
								
								echo togetlistofjobs($queryjobs);
							?>					
						</div>
					</div>
					
					<!-- Featured Job -->
					<div class="tab-pane fade" id="featured" role="tabpanel">
						<div class="row">						
							<?php 
			
								$todaydate = date("Y-m-d");
								
								$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND t1.start_date<='$todaydate' AND t1.end_date>='$todaydate' ORDER BY rand() DESC LIMIT 0, 8";
								
								echo togetlistofjobs($queryjobs);
							?>					
						</div>	
					</div>

				</div>

				<!--
				
				<div class="col-md-12 mrg-top-40">
					<div class="text-center">
						<a href="<?php echo $baseurl;?>search-result-jobs.php" class="btn theme-btn btn-m">Browse More Jobs</a>
					</div>
				</div>  -->
				
			</div>
		</section>
        

					</form>
					
					 <!--
					   <div class="row">
					
						<div class="col-md-4 col-sm-4">
							<div class="cmp-overview">
								<div class="cmp-icon clr-black">
									<i class="cmp-i icon-profile-male"></i>
									<i class="fa fa-check"></i>
								</div>
								<div class="cmp-detail">							
									<h3>2000+</h3>
									<span>Active Workers</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="cmp-overview">
								<div class="cmp-icon clr-black">
									<i class="cmp-i icon-desktop"></i>
									<i class="fa fa-check"></i>
								</div>
								<div class="cmp-detail">							
									<h3>340+</h3>
									<span>Companies</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="cmp-overview">
								<div class="cmp-icon clr-black">
									<i class="cmp-i icon-global"></i>
									<i class="fa fa-check"></i>
								</div>
								<div class="cmp-detail">							
									<h3>2</h3>
									<span>Countries</span>
								</div>
							</div>
						</div>
						
					</div> -->
				</div>
			</div>
		</div>
		<!-- ======================= End Banner ===================== -->
		



    <style>
        .card {
            max-width: 100%;
            max-height: 50%;
            padding-top:10px;
            margin-left: 35px;
        }
    </style>

  
 
  
    <div class="container">
        <div class="card-group">
  
            <div class="row">
                <div class="card col-md-2">
                    <img src="images/allianz.png" class="card-img-top">
                </div>
  
                <div class="card col-md-2">
                    <img src="images/indus.png" class="card-img-top">
                </div>
                  
                <div class="card col-md-2">
                    <img src="images/bmpl.jpeg" class="card-img-top">
                </div>
                 <div class="card col-md-2">
                    <img src="images/coming.jpg" class="card-img-top">
                </div>
                 <div class="card col-md-2">
                    <img src="images/ccoming.jpg" class="card-img-top">
                </div>
            </div>
        </div>
    </div>




		<!-- ================= Job start ========================= -->

		
        


<?php			
$queryce = "SELECT * FROM `ss_employer` WHERE status='1' AND featured='1' ORDER BY add_date DESC";
$rsce = $db->query($queryce);	

$foundnumce = $rsce->num_rows;	
$rowlist = $rsce->rows;

if($foundnumce>0)
{			
?>

<!-- ================= Category start ========================= -->
		<!-- <section class="image-bg" style="background:url(http://via.placeholder.com/1920x900) no-repeat;" data-overlay="7"> -->

		<!-- <section class="image-bg" style="background-color:#E4E7EF;" data-overlay="7">
			<div class="container">
			
				<div class="row" data-aos="fade-up">
					<div class="col-md-12">
						<div class="heading light">
							<h2 class="them-color">Featured Employer</h2>
							<p class="clr-black">Browse Jobs By Top Agency</p>
						</div>
					</div>
				</div>
				
				<div class="row">

					<!-- <?php 
				
				
				foreach($rowlist as $key => $row) { 					
				?>
					<div class="col-md-3 col-sm-6">
						<div class="category-box" data-aos="fade-up">
							<div class="category-desc">
								<div class="category-icon">
									<?php if(!empty($row["logo"])) { echo '<img src="'.$baseurl.$row["logo"].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
								</div>

								<div class="category-detail category-desc-text">
									<a href="#" title=""><h4><?php echo $row["company"]; ?></h4></a>
									<p><?php echo $row["city"]; ?></p>
								</div>
							</div>
						</div>
					</div>
					<?php } ?> -->
					
					</div>
					
					<!-- <div class="col-md-12 mrg-top-40">
						<div class="text-center">
							<a href="#" class="btn theme-btn btn-m">Browse All Employer</a>
						</div>
					</div>
					
				</div>
				
			</div>
		</section> -->


<?php } ?>

<div class="rws-featuredcompany rws-bgwhite">
	<div class="container">
    	<p class="rws-subtitle">Browse Jobs By Popular Category</p>
    	<h2>Popular Category Jobs</h2>
        
        



        <div class="classic-tabs">

                  <!-- Nav tabs -->
                  <div class="tabs-wrapper">
                      <ul class="nav tabs-cyan" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link waves-light waves-effect waves-light active" data-toggle="tab" href="#panel36" role="tab" aria-selected="true" style="color:black !important;"><b> Offshore Jobs </b></a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel37" role="tab" aria-selected="false" style="color:black !important;"><b> Shore Jobs </b></a>
                          </li>                          
                      </ul>
                  </div>
                  <!-- Tab panels -->
                  <div class="tab-content card">
                      <!--Panel 1-->
                      <div class="tab-pane fade in active show" id="panel36" role="tabpanel">
                          <?php echo togetlistofcategorylinks($array_category_offshore, "Offshore"); ?>
                      </div>
                      <!--/.Panel 1-->
                      <!--Panel 2-->
                      <div class="tab-pane fade" id="panel37" role="tabpanel">
                          <?php echo togetlistofcategorylinks($array_category_shore, "Shore"); ?>
                      </div>
                      <!--/.Panel 2-->                     
                  </div>

                </div>
        
        
    	
    </div>
</div>

     
<!--

<div class="rws-featuredcompany">
	<div class="container">
    	<p class="rws-subtitle">Join our latest courses/events</p>
    	<h2>Courses/Events</h2>
    	<div class="homephotogal">
            <div class="owl-carousel owl-featuredempcourses">
            	<?php 
				$todaydate = date("Y-m-d");
			
				$queryce = "SELECT * FROM `ss_event_courses` WHERE status='1' AND featured='1' AND start_date>='$todaydate' ORDER BY add_date DESC LIMIT 0, 8";
				$rsce = $db->query($queryce);	

				$foundnumce = $rsce->num_rows;	
				$rowlist = $rsce->rows;
				
				foreach($rowlist as $key => $row) { 					
				?>
                <div class="item">
                    <div class="rws-coursesitem">
                    	<?php if(!empty($row["event_img"])) { echo '<img src="'.$baseurl.$row["imgurl"].$row["event_img"].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-events.jpg" title="" />'; } ?>
                        <div class="rws-ceinner">
                    	<h6><?php echo $row["title"]; ?></h6>
                    	<p><?php echo $row["city"]; ?></p>
                        <p><?php echo togetdatemonthonly($row["start_date"]); ?></p>
                    	<div class="rws-morelink"><a href="<?php echo $baseurl.'course-details.php?eid='.$row["id"]; ?>" title="<?php echo $row["title"]; ?>" class="rws-applybtn">View Details <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div> -->

<!-- =================== Newsletter ==================== -->
		<!-- <section class="newsletter theme-bg" style="background-image:url(assets/img/bg-new.png)">
			<div class="container">
				
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="heading light">
							<h2>Get Latest News</h2>
							<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.</p>
						</div>
					</div>
				</div>
				<form name="gt-newsletter" id="gt-newsletter" method="post" action="" enctype="multipart/form-data">
				<div class="row mrg-top-20">
					<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
						<div class="newsletter-box text-center">
							<div class="input-group">
								<span class="input-group-addon"><span class="ti-email theme-cl"></span></span>
								<input type="email" class="form-control" name="gt_cbemail" id="gt_cbemail" required="required" placeholder="Enter your Email..">
							</div>
							<button type="submit" name="gtsubmitcb2" id="gtsubmitcb2" class="btn theme-btn btn-radius btn-m">subscribe</button>
						</div>
					</div>
				</div>
                </form>                
			</div>
		</section> -->
		<!-- =================== End Newsletter ==================== -->

<?php include("app/gtfooter.php"); ?>


</body>
		</html>