<?php include("includes/config.php"); 
$home = 1;
include("app/gtheader.php"); 
?>

<!-- ======================= Start Banner ===================== -->
		<div class="main-banner" style="background-image:url(assets/img/banner-1.jpg);" data-overlay="8">
			<div class="container">
				<div class="col-md-12 col-sm-12">
				
					<div class="caption text-center cl-white">
						<h2>Find Your Career. You Deserve it.</h2>
						<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
					</div>
					
					<form action="<?php echo $baseurl;?>search-result-jobs.php" method="get" enctype="multipart/form-data" name="gtsearchjobform" id="gtsearchjobform">
						<fieldset class="home-form-1">
						
							<div class="col-md-4 col-sm-4 padd-0">
								<input type="text" class="form-control br-1" name="keywords" id="keywords" placeholder="Skills, Designation, Companies" />
							</div>
								
							<div class="col-md-3 col-sm-3 padd-0">
								<?php echo todisplaymultiplewithgroupname($array_aus_location, $array_newze_location, "", "", "", "", "Australia, New Zealand", 'location', "All Location (Recomended for Offshore jobs)", $_GET["location"], $onchange=""); ?>
							</div>
								
							<div class="col-md-3 col-sm-3 padd-0">
								<?php echo todisplaymultiplewithgroupname($array_category_shore, $array_category_offshore, "", "", "", "", "Shore Categories, Offshore Categories", 'category', "All Category", $_GET["category"], $onchange=""); ?>
							</div>
								
							<div class="col-md-2 col-sm-2 padd-0 m-clear">
								<button type="submit" name="rws_formsubmit" class="btn theme-btn cl-white seub-btn">FIND JOB</button>
							</div>
								
						</fieldset>
					</form>
					
					<div class="row">
					
						<div class="col-md-4 col-sm-4">
							<div class="cmp-overview">
								<div class="cmp-icon">
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
								<div class="cmp-icon">
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
								<div class="cmp-icon">
									<i class="cmp-i icon-global"></i>
									<i class="fa fa-check"></i>
								</div>
								<div class="cmp-detail">							
									<h3>2</h3>
									<span>Countries</span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- ======================= End Banner ===================== -->
		
		<!-- ================= Job start ========================= -->
		<section>
			<div class="container">
			
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-advance theme-bg" role="tablist">
					<li class="nav-item active">
						<a class="nav-link" data-toggle="tab" href="#recent" role="tab">
						Recent Jobs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">
						Featured Jobs</a>
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
				
				<div class="col-md-12 mrg-top-40">
					<div class="text-center">
						<a href="<?php echo $baseurl;?>search-result-jobs.php" class="btn theme-btn btn-m">Browse More Jobs</a>
					</div>
				</div>
				
			</div>
		</section>
        
        


<?php			
$queryce = "SELECT * FROM `ss_employer` WHERE status='1' AND featured='1' ORDER BY add_date DESC";
$rsce = $db->query($queryce);	

$foundnumce = $rsce->num_rows;	
$rowlist = $rsce->rows;

if($foundnumce>0)
{			
?>

<!-- ================= Category start ========================= -->
		<section class="image-bg" style="background:url(http://via.placeholder.com/1920x900) no-repeat;" data-overlay="7">
			<div class="container">
			
				<div class="row" data-aos="fade-up">
					<div class="col-md-12">
						<div class="heading light">
							<h2>Featured Employer</h2>
							<p>Browse Jobs By Top Agency</p>
						</div>
					</div>
				</div>
				
				<div class="row">
					<?php 
				
				
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
					<?php } ?>
					</div>
					
					<div class="col-md-12 mrg-top-40">
						<div class="text-center">
							<a href="#" class="btn theme-btn btn-m">Browse All Employer</a>
						</div>
					</div>
					
				</div>
				
			</div>
		</section>

<div class="rws-featuredcompany">
	<div class="container">
    	<p class="rws-subtitle">Browse Jobs By Top Agency</p>
    	<h2>Featured Employer</h2>
    	<div class="homephotogal">
            <div class="owl-carousel owl-featuredempgallery">
            	<?php 
				
				
				foreach($rowlist as $key => $row) { 					
				?>
                <div class="item"><div class="rws-featuredempinn"><div class="rws-felogo"><?php if(!empty($row["logo"])) { echo '<img src="'.$baseurl.$row["logo"].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?></div><h6><?php echo $row["company"]; ?></h6><p><?php echo $row["city"]; ?></p></div></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

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
                              <a class="nav-link waves-light waves-effect waves-light active" data-toggle="tab" href="#panel36" role="tab" aria-selected="true">Offshore Jobs</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel37" role="tab" aria-selected="false">Shore Jobs</a>
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


<div class="rws-featuredcompany">
	<div class="container">
    	<p class="rws-subtitle">Browse Popular jobs</p>
    	<h2>Top Trending Jobs</h2>
        <div class="rws-joblistsection">
        <?php 
			
			$todaydate = date("Y-m-d");
			
			$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND t1.start_date<='$todaydate' AND t1.end_date>='$todaydate' ORDER BY add_date DESC LIMIT 0, 8";
			
			echo togetlistofjobs($queryjobs);
		?>
        </div>
    </div>
</div>    
        

<div class="rws-featuredcompany">
	<div class="container-fluid">
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
</div>

<?php include("app/gtfooter.php"); ?>