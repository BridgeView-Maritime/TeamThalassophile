<?php include("includes/config.php"); 
$home = 2;

if($_SESSION["USER"]['Type']=="Jobseeker")
{
	if($_POST["confirm"]=="Yes")
	{
		$job_id 		= $_POST["job_id"];
		$emp_id 		= $_POST["emp_id"];
		$question 		= $_POST["question"];
		$question_id 	= $_POST["question_id"];
		$js_id		 	= $_SESSION["USER"]['ID'];
		
		if(isUniqueJobappy("id", " `js_id`='$js_id' AND `emp_id`='$emp_id' AND `job_id`='$job_id' ", "ss_jobseekers_jobapplied"))
		{
		
		/* INSERT INTO APPLY TABLE */
		$update_query = "INSERT INTO `ss_jobseekers_jobapplied` SET emp_id = '$emp_id', job_id = '$job_id', js_id = '$js_id', status = '1', apply_date = '$gtcurrenttime'";
		$update_result = $db->query($update_query);	
					
		$apply_id = $db->getLastId();
		
		/* INSERT INTO Query TABLE */
		
		$i=0;
		foreach($question as $key=>$val)
		{
			
			if(!empty($question[$i]))
			{
				$qrep = $i+1;
				$query_insert = "INSERT INTO `ss_jobseekers_jobapplied_query` SET apply_id = '$apply_id', js_id = '$js_id', query = '".addslashes($question[$i])."', reply = '".$_POST["question_".$qrep]."', add_date = '$gtcurrenttime'";
	
				$update_result = $db->query($query_insert);
			}
			
			$i++;
		}
		
			$_SESSION["RWS_UserMessage"]='<div class="container"><div id="rws-formsuccess">You have successfully applied for this job.</div></div>';
			
			$jobtitle 	= togetfieldvalue('jobtitle', 'ss_employer_jobs', " `id`='$job_id'");
			$emp_email 	= togetfieldvalue('email', 'ss_employer', " `id`='$emp_id'");
			$company 	= togetfieldvalue('company', 'ss_employer', " `id`='$emp_id'");
			
			/* Send Email To Admin */
			$subject = "Hello Admin, ".$_SESSION["USER"]['Firstname']." ".$_SESSION["USER"]['Lastname']." has applied for ".$jobtitle." successfully on ".$sitename;
			$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello Admin,<br /><br />
			'.$_SESSION["USER"]['Firstname'].' '.$_SESSION["USER"]['Lastname'].' has applied for '.$$jobtitle.' posted by '.$company.' on '.$sitename.'. Please <strong><a href="'.$baseurl.'job-details.php?jobid='.$job_id.'">Click Here</a></strong> to view complete details.<br/><br/>		
			</td>
		  </tr>	  
		  '.$emailfooter;
	
			sendmail($admin_emaildemo_1,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
			sendmail($admin_emaildemo_2,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
			sendmail($admin_emaildemo_3,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
			/* Send Email To Admin */
			
			/* Send Email To Recruiter */
			$subject = "Hello Employer, ".$_SESSION["USER"]['Firstname']." ".$_SESSION["USER"]['Lastname']." has applied for ".$jobtitle." successfully on ".$sitename;
			$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello Employer,<br /><br />
			'.$_SESSION["USER"]['Firstname'].' '.$_SESSION["USER"]['Lastname'].' has applied for '.$$jobtitle.' posted by '.$company.' on '.$sitename.'. Please <strong><a href="'.$baseurl.'employer-login.php">Login</a></strong> to view complete details.<br/><br/>		
			</td>
		  </tr>	  
		  '.$emailfooter;
	
			sendmail($emp_email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
			/* Send Email To Recruiter */
			
			/* Send Email To Jobseeker */
			$subject = "Hello ".$_SESSION["USER"]['Firstname']." ".$_SESSION["USER"]['Lastname'].",  thank you for applying ".$jobtitle." successfully on ".$sitename;
			$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello '.$_SESSION["USER"]['Firstname'].',<br /><br />
			Thank you for appling for job post '.$$jobtitle.' posted by '.$company.' on '.$sitename.'.<br/><br/>		
			</td>
		  </tr>	  
		  '.$emailfooter;
	
			sendmail($emp_email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
			/* Send Email To Jobseeker */		
		}
		else
		{
			$_SESSION["RWS_UserMessage"]='<div class="container"><div id="rws-formfeedback">You have already applied for this job.</div></div>';
		}
			
		echo "<script>document.location.href='".$baseurl."job-details.php?jobid=".$_GET["jobid"]."'</script>";
		exit;
					
	}
}

$jobid = $_GET["jobid"];
$todaydate = date("Y-m-d");	

$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND t1.start_date<='$todaydate' AND t1.end_date>='$todaydate' AND t1.id='$jobid' ";

$result = $db->query($queryjobs);
$foundnum = $result->num_rows;	

$row = $result->row;

if(!empty($row["logo"])) { $imgurl = '<img src="'.$baseurl.$row["logo"].'" class="img-responsive img-circle" alt="'.$row["jobtitle"].'" />'; } else { $imgurl = '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" class="img-responsive img-circle" alt="'.$row["jobtitle"].'" />'; }
	
	if($row["section"]=="Shore") { $showcategory = $array_category_shore[$row["category"]].' <em>('.$row["section"].')</em>'; } else { $showcategory = $array_category_offshore[$row["category"]].' (<em>'.$row["section"].'</em>)'; }

$metatitle = $row["jobtitle"];
$metakeywords = $row["jobtitle"].','.$showcategory;
$metadescription = $row["jobtitle"].' posted by '.$row["company"].' in '.$showcategory.' category.';

include("app/gtheader.php"); 


if($foundnum>0) {
	
	// Update Job Hits count
	$userip = getClientIP();
	$pagetype = 1;
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


<!-- ================ Job Detail Basic Information ======================= -->
		<section class="detail-section" style="background:url(http://via.placeholder.com/1920x900);">
			<div class="overlay"></div>
			<div class="profile-cover-content">
				<div class="container">
					<div class="cover-buttons">
						<ul>
						<li><div class="buttons medium button-plain "><i class="fa fa-phone"></i> <?php echo $showcategory; ?></div></li>
						<li><div class="buttons medium button-plain "><i class="fa fa-map-marker"></i><?php if(!empty($row["location"])) { ?><p class="nomargin rws-jbdlocation"><?php echo $array_location_all[$row["location"]]; ?></p><?php } ?></div></li>
						<li><?php  if(empty($_SESSION["EMP"]['ID'])) { if(!empty($_SESSION["USER"]['ID'])) { if($_SESSION["USER"]['Type']=="Jobseeker")
{ ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#applyforthisjob"  class="buttons theme-btn"><i class="fa fa-paper-plane"></i> Apply Now</a>
                    <?php } } else { ?>
                        <a href="jobseekers-login.php?jobid=<?php echo $jobid; ?>" class="buttons theme-btn"><i class="fa fa-paper-plane"></i> Apply Now</a>
                    <?php } } ?></li>
						<li><a href="#" data-job-id="74" data-nonce="01a769d424" class="buttons btn-outlined"><i class="fa fa-heart-o"></i><span class="hidden-xs">Bookmark</span> </a></li>
						</ul>
					</div>
					<div class="job-owner hidden-xs hidden-sm">
						<div class="job-owner-avater">
							<?php echo $imgurl; ?>
						</div>
						<div class="job-owner-detail">
							<h4><?php echo $row["jobtitle"]; ?></h4>
							<span class="theme-cl"><?php echo $row["company"]; ?></span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ================ End Job Detail Basic Information ======================= -->


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


<section class="gray">
			<div class="container">
				
				<!-- row -->
				<div class="row">
					
					<div class="col-md-8 col-sm-12">
						
						<div class="detail-wrapper">
							<div class="detail-wrapper-header">
								<h4>Job Details</h4>
							</div>
							<div class="detail-wrapper-body">
								<?php echo $row["description"]; ?>
							</div>
						</div>						
						
					</div>
					
					<div class="col-md-4 col-sm-12">
						<div class="sidebar">
						
							<!-- Start: Opening hour -->
							<div class="widget-boxed lg">
								<div class="widget-boxed-body">
									<?php  if(empty($_SESSION["EMP"]['ID'])) { if(!empty($_SESSION["USER"]['ID'])) { if($_SESSION["USER"]['Type']=="Jobseeker")
{ ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#applyforthisjob"  class="btn btn-m theme-btn full-width mrg-bot-10"><i class="fa fa-paper-plane"></i> Apply For Job</a>
                    <?php } } else { ?>
                        <a href="jobseekers-login.php?jobid=<?php echo $jobid; ?>"  class="btn btn-m theme-btn full-width mrg-bot-10"><i class="fa fa-paper-plane"></i> Apply For Job</a>
                    <?php } } ?>
								</div>
							</div>
							<!-- End: Opening hour -->
							
							<!-- Start: Job Overview -->
							<div class="widget-boxed">
								<div class="widget-boxed-header">
									<h4><i class="ti-location-pin padd-r-10"></i>Location</h4>
								</div>
								<div class="widget-boxed-body">
									<div class="side-list no-border">
										<?php if(!empty($row["location"])) { ?><p class="nomargin rws-jbdlocation"><?php echo $array_location_all[$row["location"]]; ?></p><?php } ?>
										<h5>Share Job</h5>
										<ul class="side-list-inline no-border social-side">
											<li><a href="#"><i class="fa fa-facebook theme-cl"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus theme-cl"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter theme-cl"></i></a></li>
											<li><a href="#"><i class="fa fa-linkedin theme-cl"></i></a></li>
											<li><a href="#"><i class="fa fa-pinterest theme-cl"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- End: Job Overview -->
							
							<!-- Start: Opening hour -->
							<div class="widget-boxed">
								<div class="widget-boxed-header">
									<h4><i class="ti-time padd-r-10"></i>Overview</h4>
								</div>
								<div class="widget-boxed-body">
									<?php if(!empty($row["job_type"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Job Type</em><br/>'.$array_job_type[$row["job_type"]].'<p>'; } ?>
                        <?php if(!empty($row["compensation_from"])) { echo '<p class="nomargin rws-jbdsalary"><em>Offerd Salary</em><br/>$'.$row["compensation_from"].' - $'.$row["compensation_to"].'<p>'; } ?>
                        <?php if(!empty($row["benefits"])) { echo '<p class="nomargin rws-jbdbenefits"><em>Benefits</em><br/>'.$row["benefits"].'<p>'; } ?>
                        <?php if(!empty($row["ship_type"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Ship Type</em><br/>'.$array_shiptype[$row["ship_type"]].'<p>'; } ?>
                        <?php if(!empty($row["swing_length"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Swing Length</em><br/>'.$row["swing_length"].'<p>'; } ?>
                        <?php if(!empty($row["client"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Client</em><br/>'.$row["client"].'<p>'; } ?>
                        <?php if(!empty($row["area_of_operation"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Area of Operation</em><br/>'.$row["area_of_operation"].'<p>'; } ?>
                        <?php if(!empty($row["salary_terms"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Salary Terms</em><br/>'.$row["salary_terms"].'<p>'; } ?>
                        <?php if(!empty($row["salary_terms_doc"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Salary Terms Document</em><br/><a href="'.$baseurl.$row["salary_terms_doc"].'" title="View" target="_blank">View Document</a><p>'; } ?>
								</div>
							</div>
							<!-- End: Opening hour -->
							 
						</div>
					</div>
					
				</div>
				<!-- End Row -->
				
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h4 class="mrg-bot-20">Related Jobs</h4>
					</div>
				</div>
				<!-- End Row -->
				
				<!-- row -->
				<div class="row">
					<!-- Single Job -->
                    
                    <?php 
			
						$todaydate = date("Y-m-d");
						
						$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND t1.start_date<='$todaydate' AND t1.end_date>='$todaydate' ORDER BY add_date DESC LIMIT 0, 4";
						
						echo togetlistofjobs($queryjobs);
					?>					
				</div>
				<!-- End Row -->
				
			</div>
		</section>
		
		<!-- ====================== End Job Overview ================ -->
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