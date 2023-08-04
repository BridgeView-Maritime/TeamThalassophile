<?php include("includes/config.php"); 
$home = 1;

$js_id = $_GET["post_id"];

// Get the jobseekers personal info
$select_query 		= 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$js_id.'"';
$select_result 		= $db->query($select_query);
$row 				= $select_result->row;

$foundnum 			= $select_result->num_rows;

// Get the jobseekers availability info
$select_query 		= 'SELECT * FROM `ss_jobseekers_availability` WHERE js_id = "'.$js_id.'"';
$select_result 		= $db->query($select_query);
$rowavlist 			= $select_result->rows;
$avlisttotal 		= $select_result->num_rows;

// Get the jobseekers employment history info
$select_query 		= 'SELECT * FROM `ss_jobseekers_employment` WHERE js_id = "'.$js_id.'"';
$select_result 		= $db->query($select_query);
$rowemplist 		= $select_result->rows;
$emplisttotal 		= $select_result->num_rows;

// Get the education info
$select_query 		= 'SELECT * FROM `ss_jobseekers_education` WHERE js_id = "'.$js_id.'"';
$select_result 		= $db->query($select_query);
$rowedulist 		= $select_result->rows;
$edulisttotal 		= $select_result->num_rows;

// Get the certificate info
$select_query 		= 'SELECT * FROM `ss_jobseekers_certificates` WHERE js_id = "'.$js_id.'"';
$select_result 		= $db->query($select_query);
$rowcerlist 		= $select_result->rows;
$cerlisttotal 		= $select_result->num_rows;

if(!empty($row["profile_pic"])) { $imgurl = '<img src="'.$baseurl.$row["profile_pic"].'" class="img-circle width-100" alt="'.$row["firstname"].'" />'; } else { $imgurl = '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" class="img-circle width-100" alt="'.$row["firstname"].'" />'; }
	
$metatitle = $row["firstname"].' '.$row["lastname"];
$metakeywords = $row["firstname"].' '.$row["lastname"];
$metadescription = $row["firstname"].' '.$row["lastname"];

include("app/gtheader.php"); 


if($foundnum>0) {
	
	// Update Job Hits count
	$userip = getClientIP();
	$pagetype = 3;
	$hit_date = date('Y-m-d');
	$totaluniquehit = togetuniquejobhit($userip,$pagetype,$jobid,$hit_date,$_SESSION["GTVisitorJobPerson"]);
	
	if($totaluniquehit==0)
	{
		// insert data into unique table
		$query_unikhit = $db->query("INSERT INTO `ss_employer_jobs_hits` (`ip_address`, `add_date`, `pagetype`, `job_id`, `session_id`, `created_date`) VALUES ('$userip', '$currenttime', '$pagetype', '".$row["id"]."', '".$_SESSION["GTVisitorJobPerson"]."', '$hit_date')");
		
		$update = ($row["hits"]+1);		
		$sql2 = "UPDATE `ss_employer_jobs` SET `hits` = '$update' WHERE `id` = '".$row["id"]."'";	
		$rs2 = $db->query($sql2);
		
	}	

?>
<div class="rws-jobdetailsheader">
	<div class="rws-jdhinner">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <?php echo $imgurl; ?>
                </div>
                <div class="col-sm-7">
                    <h1><?php echo $row["firstname"].' '.$row["lastname"]; ?></h1>
                    <p class="nomargin rws-jbdcategory"><?php echo $row["professional_headline"]; ?></p>
                    <p class="rwslocation nomargin"><i class="fas fa-map-marker-alt"></i> <?php echo $row['location'];?>, <?php echo $row['country'];?></p>
                </div>
                <div class="col-sm-3 text-right">
                	<!--<p>
                    <?php  if(empty($_SESSION["EMP"]['ID'])) { if(!empty($_SESSION["USER"]['ID'])) { if($_SESSION["USER"]['Type']=="Jobseeker")
{ ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#applyforthisjob"  class="btn btn-light"><i class="far fa-envelope"></i> Apply This Job</a>
                    <?php } } else { ?>
                        <a href="jobseekers-login.php?jobid=<?php echo $jobid; ?>" class="btn btn-light"><i class="far fa-envelope"></i> Apply This Job</a>
                    <?php } } ?>
                    </p>
                    <div class="sharethis-inline-share-buttons"></div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <a href="javascript:void(0)"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span>  <?php echo $metatitle;?></a>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($_SESSION["RWS_UserMessage"])){ echo $_SESSION["RWS_UserMessage"]; unset($_SESSION["RWS_UserMessage"]); } ?>

<div class="rws-jobdetails">
	<div class="container">
    
    	<div class="row">
        	<div class="col-md-8 col-sm-12">
            	<div class="detail-wrapper">
                    <div class="detail-wrapper-body">
                    
                        <div class="text-center mrg-bot-30">
                            <?php echo $imgurl; ?>
                            <h4 class="meg-0"><?php echo $row["firstname"].' '.$row["lastname"]; ?></h4>
                            <span><?php echo $row["professional_headline"]; ?></span>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4 mrg-bot-10">
                            	Location<br/>
                                <i class="ti-location-pin padd-r-10"></i><?php echo $row['location'];?>, <?php echo $row['country'];?>
                            </div>
                            <div class="col-sm-4 mrg-bot-10">
                                <i class="ti-email padd-r-10"></i><?php echo $row['email'];?>
                            </div>
                            <div class="col-sm-4 mrg-bot-10">
                                <i class="ti-mobile padd-r-10"></i><?php echo $row['country_code'];?> <?php echo $row['mobile'];?>
                            </div>
                            <!--<div class="col-sm-4 mrg-bot-10">
                                <i class="ti-credit-card padd-r-10"></i>$12/Hour
                            </div>
                            <div class="col-sm-4 mrg-bot-10">
                                <i class="ti-shield padd-r-10"></i>3 Year Exp.
                            </div>-->
                            <div class="clear"></div>
                            <div class="col-sm-6 mrg-bot-10">
                            	<?php if(!empty($row['additional_skills'])) { $additional_skills = explode(',',$row['additional_skills']); ?>
                                	Additional Skills<br/>
                                    <?php foreach($additional_skills as $key_as=>$val_as) { echo '<span class="skill-tag">'.$val_as.'</span>'; } ?>
                                <?php } ?>
                            </div>
                            
                            <div class="col-sm-6 mrg-bot-10">
                            	<?php if(!empty($row['client_work_with'])) { $client_work_with = explode(',',$row['client_work_with']); ?>
                                	Clients work with<br/>
                                    <?php foreach($client_work_with as $key_cww=>$val_cww) { echo '<span class="skill-tag">'.$val_cww.'</span>'; } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Details End -->
				<?php if(!empty($row['short_bio'])) { ?>
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Carrer Summary</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <?php echo $row['short_bio']; ?>
                    </div>
                </div>
                <?php } ?>
                <!-- Details End -->
                
				<?php if($avlisttotal>0) { ?>		
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Availability</h4>
                    </div>
                    <div class="detail-wrapper-body">
                    
                    <?php foreach($rowavlist as $key_av=>$val_av)  { ?>
                    <div class="rws-listrow">
                        <div class="row">
                            <div class="col-sm-6">
                                <em>From:</em> <?php echo toshowdateformated($val_av["start_date"]); ?>
                            </div>
                            <div class="col-sm-6">
                                <em>To:</em> <?php echo toshowdateformated($val_av["end_date"]); ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>    
                        
                    </div>
                </div>
                <?php } ?>
                <!-- Details End -->
                
                <?php if($emplisttotal>0) { ?>		
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Employment History</h4>
                    </div>
                    <div class="detail-wrapper-body">
                    
                        <div class="rws-listrow rws-listheader">
                                <div class="row">
                                	<div class="col-sm-2">
                                    	Occupation
                                    </div>
                                    <div class="col-sm-2">
                                    	Company
                                    </div>
                                    <div class="col-sm-2">
                                    	Location
                                    </div>
                                    <div class="col-sm-2">
                                    	From
                                    </div>
                                    <div class="col-sm-2">
                                    	To
                                    </div>
                                    <div class="col-sm-2">
                                    	Working Here
                                    </div>
                                </div>
                            </div>
                            
                            <?php foreach($rowemplist as $key_emp=>$val_emp)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-2">
                                    	<?php echo $val_emp["occupation"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php echo $val_emp["company"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php echo $val_emp["location"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php echo $val_emp["start_month"]; ?> <?php echo $val_emp["start_year"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php if(!empty($val_emp["end_year"])) { echo $val_emp["end_month"]; ?> <?php echo $val_emp["end_year"]; } else { echo "-"; } ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php if(!empty($val_emp["currently_work_hear"])) { echo $val_emp["currently_work_hear"]; } else {echo "-"; } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Offshore emp history if available -->
                            <?php
							$_SESSION['myForm']=array();
							
							$select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE `emp_id`="'.$val_emp["id"].'" AND js_id = "'.$_SESSION["USER"]['ID'].'"';
							$select_result = $db->query($select_query);
							$empitems = $select_result->rows;
							$emptotal = $select_result->num_rows;
							
							if($emptotal>0)
							{
								foreach($empitems as $key => $rowemp) { 
									$_SESSION['myForm']['ship_name'][] 			= $rowemp["ship_name"];
									$_SESSION['myForm']['ship_type'][] 			= $rowemp["ship_type"];
									$_SESSION['myForm']['dp_system'][] 			= $rowemp["dp_system"];
									$_SESSION['myForm']['grt'][] 				= $rowemp["grt"];
									$_SESSION['myForm']['kw'][] 				= $rowemp["kw"];
									$_SESSION['myForm']['position'][] 			= $rowemp["position"];
									$_SESSION['myForm']['sign_on'][] 			= toshowdateformated($rowemp["sign_on"]);
									$_SESSION['myForm']['sign_off'][] 			= toshowdateformated($rowemp["sign_off"]);
								}
							}
							
							if($emptotal>0) {
							$ier=0;
							foreach($_SESSION['myForm']["ship_name"] as $key_emp=>$val_emp) 
							{
							?>
							
							<div class="rws-module">
							<div class="rws-mcontent">
								<div class="rws-fields row">    
									<div class="col-sm-4"> 
										<p class="nomargin"><em>Ship Name</em></p> 
										<?php echo $_SESSION['myForm']["ship_name"][$ier];?>
									</div>                    
									<div class="col-sm-4">
										<p class="nomargin"><em>Ship Type</em></p>
										 <?php echo $array_shiptype[$_SESSION['myForm']["ship_type"][$ier]]; ?>
									</div>
                                    <div class="col-sm-4">
										<p class="nomargin"><em>DP System</em></p>
										<?php echo $array_dpsystem[$_SESSION['myForm']["dp_system"][$ier]]; ?>
									</div>
								</div>
								<!-- Row Ends -->
								
								<div class="rws-fields row">    
									<div class="col-sm-4">
										 <p class="nomargin"><em>Work Position</em></p>
										<?php echo $array_shipworkposition[$_SESSION['myForm']["position"][$ier]]; ?>
									</div>                    
									<div class="col-sm-4">
										<p class="nomargin"><em>GRT</em></p>
										<?php echo $_SESSION['myForm']['grt'][$ier]; ?>
									</div>
                                    <div class="col-sm-4">
										<p class="nomargin"><em>KV</em></p>
										<?php echo $_SESSION['myForm']['kw'][$ier]; ?>
									</div>        
								</div>
								<!-- Row Ends --> 
								
								<div class="rws-fields row" style="padding:0;">
										<div class="col-sm-4">
											<p class="nomargin"><em>Sign On</em></p>
                                            <?php echo $_SESSION['myForm']['sign_on'][$ier]; ?>
										</div>
										<div class="col-sm-4">
                                        	<p class="nomargin"><em>Sign Off</em></p>
											<?php echo $_SESSION['myForm']['sign_off'][$ier]; ?>
										</div>
									</div>
								<!-- Row Ends -->                    
                                </div>
                            </div>                                 
                            <?php $ier++; } }  ?>
                            
                            <!-- Offshore emp history if available -->
							
                            <?php } ?>
                        
                    </div>
                </div>
                <?php } ?>
                <!-- Details End -->
                
                <?php if($edulisttotal>0) { ?>		
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Education</h4>
                    </div>
                    <div class="detail-wrapper-body">
                    
                        <div class="rws-listrow rws-listheader">
                                <div class="row">
                                	<div class="col-sm-3">
                                    	School
                                    </div>
                                    <div class="col-sm-3">
                                    	Degree
                                    </div>
                                    <div class="col-sm-3">
                                    	Start Year
                                    </div>
                                    <div class="col-sm-3">
                                    	End Year
                                    </div>                                    
                                </div>
                            </div>
                            
                            <?php foreach($rowedulist as $key_edu=>$val_edu)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-3">
                                    	<?php echo $val_edu["school"]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo $val_edu["degree"]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo $val_edu["start_year"]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo $val_edu["end_year"]; ?>
                                    </div>                                    
                                </div>
                            </div>
                            <?php } ?>
                        
                    </div>
                </div>
                <?php } ?>
                <!-- Details End -->
                
                <?php if($cerlisttotal>0) { ?>		
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Certificates</h4>
                    </div>
                    <div class="detail-wrapper-body">
                    
                        <div class="rws-listrow rws-listheader">
                                <div class="row">
                                	<div class="col-sm-6">
                                    	Name
                                    </div>
                                    <div class="col-sm-3">
                                    	Expiry
                                    </div>
                                    <div class="col-sm-3">
                                    	Certificate copy
                                    </div>                                                                       
                                </div>
                            </div>
                            
                            <?php foreach($rowcerlist as $key_cer=>$val_cer)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-6">
                                    	<?php echo $array_all_certificate[$val_cer["name"]]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo toshowdateformated($val_cer["expiry_date"]); ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php if(!empty($val_cer["authority"])) { echo '<p><a href="'.$baseurl.$val_cer["authority"].'" title="View" target="_blank">View Certificates</a></p>'; } else { echo "-"; } ?>
                                    </div>                                   
                                </div>
                            </div>
                            <?php } ?>
                        
                    </div>
                </div>
                <?php } ?>
                <!-- Details End -->
                        
                        
            </div>
            <div class="col-md-4 col-sm-12">
            	
                <div class="sidebar">
						
                    <!-- Start: Opening hour -->
                    <div class="widget-boxed lg">
                        <div class="widget-boxed-body">
                            <a href="#" class="btn btn-m theme-btn full-width mrg-bot-10"><i class="ti-heart"></i>Bookmark This</a>
                            <a href="#" class="btn btn-m light-gray-btn full-width"><i class="ti-check"></i>Shortlist Resume</a>
                        </div>
                    </div>
                    <!-- End: Opening hour -->
                    
                </div>
                
                <!-- Start: Opening hour -->
                <div class="widget-boxed">
                    <div class="widget-boxed-header">
                        <h4><i class="ti-headphone padd-r-10"></i>Contact Now</h4>
                    </div>
                    <div class="widget-boxed-body">
                        <form>
                            <input type="text" class="form-control" placeholder="Enter your Name *">
                            <input type="text" class="form-control" placeholder="Email Address*">
                            <input type="text" class="form-control" placeholder="Phone Number">
                            <textarea class="form-control height-140" placeholder="Message should have more than 50 characters"></textarea>
                            <button class="btn theme-btn full-width">Send Email</button>
                            <span>You accepts our <a href="#" title="">Terms and Conditions</a></span>
                        </form>
                    </div>
                </div>
                <!-- End: Opening hour -->
                
            </div>
        </div>
    	
    </div>
</div>

<?php if(!empty($_SESSION["USER"]['ID'])) { 

/* Employment Records */
	$select_query = 'SELECT * FROM `ss_employer_jobs_query` WHERE `job_id`="'.$row["id"].'" AND emp_id = "'.$row["emp_id"].'"';
	$select_result = $db->query($select_query);
	$empitems = $select_result->rows;
	$emptotal = $select_result->num_rows;

?>

<!-- Modal -->
<div class="modal fade" id="applyforthisjob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	<form action="" method="post" enctype="multipart/form-data" name="gtsearchjobform" id="gtsearchjobform">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apply for "<?php echo $row["jobtitle"]; ?>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              		<input type="hidden" name="job_id" value="<?php echo $row["id"]; ?>" />
                    <input type="hidden" name="emp_id" value="<?php echo $row["emp_id"]; ?>" />
              	  <!-- Question Starts -->
                  	<?php
						if($emptotal>0)
						{
							$ire = 1;
							foreach($empitems as $key => $rowemp) { 
								echo 	'<p class="nomargin">'.$rowemp["query"].'</p>
										 <input type="hidden" name="question[]" value="'.$rowemp["query"].'" />
										 <input type="hidden" name="question_id[]" value="'.$rowemp["id"].'" />
										 <p><input type="radio" name="question_'.$ire.'" id="confirm" value="Yes" required="required" /> Yes &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="question_'.$ire.'" id="confirm" value="No" required="required" /> No </p>
										';
								$ire++;
							}
						}
					?>
                  <!-- Question Ends  -->
                  
                  <p><input type="checkbox" name="confirm" id="confirm" value="Yes" required="required" /> Are you sure want to apply for this job?</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Apply</button>
              </div>
    	</form>  
    </div>
  </div>
</div>

<?php } ?>

  
<?php } else {  } ?>
<?php include("app/gtfooter.php"); ?>