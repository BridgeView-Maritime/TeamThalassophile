<?php include("includes/config.php"); 
$home = 1;
include("app/gtheader.php"); 
?>

<!-- ======================= Start Banner ===================== -->
		<div class="main-banner-new" style="padding-top:100px;">
			<div class="container">
				<div class="col-md-12 col-sm-12">
				
					<div class="caption text-center ">
						<h2 class="them-color" style="font-family: Verdana, Geneva, sans-serif;font-size: 400%;">Get A Job You Deserve</h2>
						
					</div>

					<style>
					
						@media only screen and (min-width:700px){

							
							#thumbpad{padding-left:0;padding-right: 0;}

						}
						.thumbnail{padding: 0px !important;}
						
					
					</style>
					
					<div class="row" id="thumbnail" >

    			 	<div class="col-md-4 col-sm-12" id="thumbpad" align="center">
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
			</div>
		</div>
		<!-- ======================= End Banner ===================== -->
		
		<!-- ================= Job start ========================= -->

		<style>
		
		 .jobs-tabs .nav-tabs.nav-advance>li {
			width: 33%;
		 }

		 .jobs-tabs .nav.nav-tabs.nav-advance {
			max-width: 70%;
		 }

		 @media only screen and (max-width: 600px) {
			.jobs-tabs .nav.nav-tabs.nav-advance {
			max-width: 100%;
		 }
		 }

		</style>

		<section style="padding-top:10px;padding-bottom:0px;">
			<div class="container jobs-tabs" >
			  
				<!-- Nav tabs -->
				 <ul class="nav nav-tabs nav-advance theme-bg" role="tablist">
					<li class="nav-item active">
						<a class="nav-link" data-toggle="tab" href="#recent" role="tab">
						Jobs in Aramco</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">
						Jobs in Adnoc</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">
						More Jobs</a>
					</li>
				</ul> 

				
				<div class="tab-content">
					
					<!-- Recent Job -->
					<div class="tab-pane fade in show active col-lg-9" id="recent" role="tabpanel">
						<div class="row">						
							<?php 
			
								$todaydate = date("Y-m-d");
								
								$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  ORDER BY add_date DESC LIMIT 0, 8";
								
								echo togetlistofjobs($queryjobs);
							?>					
						</div>
					</div>

					<!-- companies -->

					<style>
					.companies-sidebar div{
						margin-bottom:10px;

					}

					.companies-sidebar img{
						border: 1px solid;
					}

					.companies-sidebar{
						padding: 30px 10px;
					}
					</style>

					<div class="col-lg-3 grid-job-widget companies-sidebar">

					  
					    <div class="col-lg-12">
						<img src="images/allianz.png" class="card-img-top">
						</div>

						<div class="col-lg-12">
						<img src="images/indus.png" class="card-img-top">
						</div>

						<div class="col-lg-12">
						<img src="images/bmpl.png" class="card-img-top">
						</div>

						<div class="col-lg-12">
						<img src="images/coming.jpg" class="card-img-top">
						</div>

						<div class="col-lg-12">
						<img src="images/coming.jpg" class="card-img-top">
						</div>
					  

					 
					
					</div>
					
					<!-- companies end -->

				</div>
				
				<div class="col-md-12 mrg-top-40">
					<div class="text-center">
						<a href="<?php echo $baseurl;?>search-result-jobs.php" class="btn theme-btn btn-m">Browse More Jobs</a>
					</div>
				</div>
				
			</div>
		</section>


		
        
        
	<!-- companies section -->
	<!-- <div class="container companies" style="padding:20px;	">
        <div class="card-group">
  
            <div class="row" align="center">
                <div class="card col-md-2 my-2">
                    <img src="images/allianz.png" class="card-img-top">
                </div>
  
                <div class="card col-md-2 my-2">
                    <img src="images/indus.png" class="card-img-top">
                </div>
                  
                <div class="card col-md-2 my-2">
                    <img src="images/bmpl.png" class="card-img-top">
                </div>
                 <div class="card col-md-2 my-2">
                    <img src="images/coming.jpg" class="card-img-top">
                </div>
                 <div class="card col-md-2 my-2">
                    <img src="images/coming.jpg" class="card-img-top">
                </div>
            </div>
        </div>
    </div>  -->
	<!-- companies section end -->




<div class="rws-featuredcompany rws-bgwhite">
	<div class="container">
    	<p class="rws-subtitle">Browse Jobs By Popular Category</p>
    	<h2>Popular Category Jobs</h2>
        
        
        
        <div class="classic-tabs">

                  <!-- Nav tabs -->
                  <div class="tabs-wrapper">
                      <ul class="nav tabs-cyan" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link waves-light waves-effect waves-light active" data-toggle="tab" href="#panel36" role="tab" aria-selected="true" style="color:black!important;"><b>Marine Jobs</b></a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel37" role="tab" aria-selected="false" style="color:black!important;"><b>Rigs/Drillings Rigs Jobs</b></a>
                          </li>
						  <li class="nav-item">
                              <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel37" role="tab" aria-selected="false" style="color:black!important;"><b>Onshore Jobs</b></a>
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

     


<?php include("app/gtfooter.php"); ?>