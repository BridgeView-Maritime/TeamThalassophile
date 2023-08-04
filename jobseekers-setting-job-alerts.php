<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile"; $gtjqueryui = "Yes"; $gteditor = "Yes";

checkuserlogin(); 

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	if (empty($_POST['subscribe']) ) 	{	$errors[]="Please fill out the subscribe for job Alerts to your email field.";		}	
	if (empty($_POST['job_keywords']) ) {	$errors[]="Please fill out the Keywords field.";	}
	if (empty($_POST['alert_type']) ) 	{	$errors[]="Please fill out the Alert Type field.";		}

	if(empty($errors)) 
	{
			$subscribe 		= $_POST['subscribe'];	
			$job_keywords 	= implode(',', $_POST['job_keywords']);	
			$alert_type 	= $_POST['alert_type'];
						
			/* Update Data To Database */
			
			$update_query = "UPDATE `ss_jobseekers` SET subscribe = '$subscribe', job_keywords = '$job_keywords', alert_type = '$alert_type' WHERE `id`=".$_SESSION["USER"]['ID'];

			$update_result = $db->query($update_query);	
			
			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your settings has been updated.</div>';	

			echo "<script>document.location.href='".$baseurl."jobseekers-setting-job-alerts.php'</script>";
			exit;
	}
	else
	{
		if(!empty($errors)) {
		$gt_msgerror = '<div id="rws-formfeedback"><b><font size="4">WHOOPS! Please review the following issues:</font></b><ul>';
		foreach ($errors as $msg) { //prints each error
		$gt_msgerror .= "<li>$msg</li>";
		} // end of foreach
		$gt_msgerror .= '</ul></div>'; }
	}
}

if(empty($_POST)) {
	
	$select_query = 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$_SESSION["USER"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
	$_SESSION['myForm']['subscribe'] = stripslashes($rowut['subscribe']);	
	$_SESSION['myForm']['job_keywords'] = explode(',', $rowut['job_keywords']);	
	$_SESSION['myForm']['alert_type'] = stripslashes($rowut['alert_type']);	
	$_SESSION['myForm']['section'] = stripslashes($rowut['section']);	 
}
else
{
	
}


?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts -->  

<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Job Alert Setting</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Job Alert Setting</a>
            </div>
        </div>
    </div>
</div> 


<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
	<div class="container">
    <div class="row">
    	<div class="col-md-4">
        	<?php include("app/jobseekers-leftmenu.php"); ?>        	
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">
        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        
        	<div class="rws-module">
                <div class="mtitle">Job Alert Info</div>
                <div class="rws-mcontent" style="overflow:hidden;">
                	<?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                    
                    <div class="rws-fields">    
                    	<input type="checkbox" name="subscribe" id="subscribe" value="1" required="required" <?php if($_SESSION['myForm']['subscribe']==1) { echo 'checked="checked"'; } else { } ?> /> Subscribe for job Alerts to your email.            
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<h6>Job Keywords</h6> 
                        <div class="rwscategorylist row"><?php if(!empty($_SESSION['myForm']['section'])) { if($_SESSION['myForm']['section']=="Offshore") { echo todisplaycheckboxcategory($array_category_offshore, 'job_keywords[]', $firstoption, $_SESSION['myForm']['job_keywords'], $onchange=""); } else { echo todisplaycheckboxcategory($array_category_shore, 'job_keywords[]', $firstoption, $_SESSION['myForm']['job_keywords'], $onchange=""); } } ?></div>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">    
                        <?php echo todisplay($array_subscribe_period, "alert_type", "Select Alert Period", $_SESSION['myForm']["alert_type"], $onchange="required"); ?>        
                    </div>
            		<!-- Row Ends -->
            
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />    
                </div>
            </div>
            
            </form>
        </div>
        
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->
<?php include("app/gtfooter.php"); ?>
<!-- RWS Footer Starts --> 