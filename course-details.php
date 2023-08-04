<?php include("includes/config.php"); 
$home = 1;

$eid = $_GET["eid"];
$todaydate = date("Y-m-d");	

$queryjobs = "SELECT * FROM `ss_event_courses` WHERE status='1' AND featured='1' AND start_date>='$todaydate' AND id='$eid' ";

$result = $db->query($queryjobs);
$foundnum = $result->num_rows;	

$row = $result->row;

if(!empty($row["event_img"])) { $imgurl = '<img src="'.$baseurl.$row["imgurl"].$row["event_img"].'" class="rws-jbemplogo" alt="'.$row["title"].'" />'; } else { $imgurl = '<img src="'.$baseurl.'images/no-pic-events.jpg" class="rws-jbemplogo" alt="'.$row["title"].'" />'; }
	
$metatitle = $row["title"];
$metakeywords = $row["title"].','.$showcategory;
$metadescription = $row["title"];

include("app/gtheader.php"); 


if($foundnum>0) {
	
	// Update Job Hits count
	$userip = getClientIP();
	$pagetype = 2;
	$hit_date = date('Y-m-d');
	$totaluniquehit = togetuniquejobhit($userip,$pagetype,$jobid,$hit_date,$_SESSION["GTVisitorJobPerson"]);
	
	if($totaluniquehit==0)
	{
		// insert data into unique table
		$query_unikhit = $db->query("INSERT INTO `ss_employer_jobs_hits` (`ip_address`, `add_date`, `pagetype`, `job_id`, `session_id`, `created_date`) VALUES ('$userip', '$currenttime', '$pagetype', '".$row["id"]."', '".$_SESSION["GTVisitorJobPerson"]."', '$hit_date')");
		
		$update = ($row["hits"]+1);		
		$sql2 = "UPDATE `ss_event_courses` SET `hits` = '$update' WHERE `id` = '".$row["id"]."'";	
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
                <div class="col-sm-10">
                    <h1><?php echo $row["title"]; ?></h1>
                    <?php if(!empty($row["city"])) { ?><p class="nomargin rws-jbdcategory"><?php echo $row["city"]; ?></p><?php } ?>
                </div>
                <!--<div class="col-sm-3 text-right">
                	<p>
                    <?php  if(empty($_SESSION["EMP"]['ID'])) { if(!empty($_SESSION["USER"]['ID'])) { if($_SESSION["USER"]['Type']=="Jobseeker")
{ ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#applyforthisjob"  class="btn btn-light"><i class="far fa-envelope"></i> Apply This Job</a>
                    <?php } } else { ?>
                        <a href="jobseekers-login.php?jobid=<?php echo $jobid; ?>" class="btn btn-light"><i class="far fa-envelope"></i> Apply This Job</a>
                    <?php } } ?>
                    </p>
                    <div class="sharethis-inline-share-buttons"></div>
                </div>-->
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
        
        	<div class="col-md-8">
            	<div class="rws-nmodulesec">
                	<h3>Course/Event Description</h3>
                    <div class="rws-nmscontent">
                    	<?php echo $row["description"]; ?>
                    </div>
                </div>
            </div>
            <!-- Left Panel Ends-->
            
            <div class="col-md-4">
            	<div class="rws-nmodulesec">
                	<h3>Course/Event Overview</h3>
                    <div class="rws-nmscontent">
                    	<?php if($row["start_date"]!="0000-00-00") { echo '<p class="nomargin rws-jbdjobtype"><em>Start Date</em><br/>'.togetdatemonthonly($row["start_date"]).'<p>'; } ?>
                        <?php if($row["end_date"]!="0000-00-00") { echo '<p class="nomargin rws-jbdjobtype"><em>End Date</em><br/>'.togetdatemonthonly($row["end_date"]).'<p>'; } ?>
                        <?php if(!empty($row["address"])) { echo '<p class="nomargin rws-jbdsalary"><em>Address</em><br/>'.$row["address"].'<p>'; } ?>
                        <?php if(!empty($row["city"])) { echo '<p class="nomargin rws-jbdbenefits"><em>City</em><br/>'.$row["city"].'<p>'; } ?>
                        <?php if(!empty($row["postcode"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Postcode</em><br/>'.$row["postcode"].'<p>'; } ?>
                        <?php if(!empty($row["state"])) { echo '<p class="nomargin rws-jbdjobtype"><em>State</em><br/>'.$row["state"].'<p>'; } ?>
                        <?php if(!empty($row["country"])) { echo '<p class="nomargin rws-jbdjobtype"><em>Country</em><br/>'.$row["country"].'<p>'; } ?>
                        
                    </div>
                </div>
            </div>
            <!-- Right Panel Ends-->
            
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