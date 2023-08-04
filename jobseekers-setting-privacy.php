<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile"; $gtjqueryui = "Yes"; $gteditor = "Yes";

checkuserlogin(); 

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	if (empty($_POST['profile_display']) ) 		{	$errors[]="Please fill out the Display my profile to all Employers field.";	}
	if (empty($_POST['profile_access']) ) 		{	$errors[]="Please fill out the Employers can access my Profile field.";		}	
	if (empty($_POST['contact_access']) ) 		{	$errors[]="Please fill out the Employers can access my contact details field.";	}
	if (empty($_POST['contact_directly']) ) 	{	$errors[]="Please fill out the Employers Can contact me directly field.";		}
	if (empty($_POST['view_certificates']) )	{	$errors[]="Please fill out the Employers can access my certificates field.";	}
	if (empty($_POST['view_certificates_need_approval']) ) 	{	$errors[]="Please fill out the Ask my Approval before Employer accessing my Certificates  field.";		}
	
	

	if(empty($errors)) 
	{
			$profile_display 					= $_POST['profile_display'];	
			$profile_access 					= $_POST['profile_access'];	
			$contact_access 					= $_POST['contact_access'];
			$contact_directly 					= $_POST['contact_directly'];	
			$view_certificates 					= $_POST['view_certificates'];	
			$view_certificates_need_approval 	= $_POST['view_certificates_need_approval'];
						
			/* Update Data To Database */
			
			$update_query = "UPDATE `ss_jobseekers` SET profile_display = '$profile_display', profile_access = '$profile_access', contact_access = '$contact_access', contact_directly = '$contact_directly', view_certificates = '$view_certificates', view_certificates_need_approval = '$view_certificates_need_approval' WHERE `id`=".$_SESSION["USER"]['ID'];

			$update_result = $db->query($update_query);	
			
			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your settings has been updated.</div>';	

			echo "<script>document.location.href='".$baseurl."jobseekers-setting-privacy.php'</script>";
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
	
	$_SESSION['myForm']['profile_display'] 					= stripslashes($rowut['profile_display']);	
	$_SESSION['myForm']['profile_access'] 					= stripslashes($rowut['profile_access']);	
	$_SESSION['myForm']['contact_access'] 					= stripslashes($rowut['contact_access']);	
	$_SESSION['myForm']['contact_directly'] 				= stripslashes($rowut['contact_directly']);	
	$_SESSION['myForm']['view_certificates'] 				= stripslashes($rowut['view_certificates']);	
	$_SESSION['myForm']['view_certificates_need_approval'] 	= stripslashes($rowut['view_certificates_need_approval']);	
	
}
else
{
	
}


?>


<!-- RWS Header Starts -->  


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
<link href="<?php echo $baseurl;?>css/responsiveness.css" rel="stylesheet">




<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Privacy Settings</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Privacy Settings</a>
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
                <div class="mtitle">Privacy Settings</div>
                <div class="rws-mcontent">
                	<?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                    
                    <div class="rws-fields row"> 
                    	<div class="col-md-9">                       	
                        	Display my profile to all Employers
                        </div>
                        <div class="col-md-3">
                        <input type="radio" name="profile_display" id="profile_display_1" value="Yes" required  <?php if($_SESSION['myForm']['profile_display']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="profile_display" id="profile_display_2" value="No" required  <?php if($_SESSION['myForm']['profile_display']=="No") { echo 'checked="checked"'; } else { } ?> /> No
                        </div>
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row"> 
                    	<div class="col-md-9">
                        	Employers can access my Profile
                        </div>
                        <div class="col-md-3">
                        <input type="radio" name="profile_access" id="profile_access_1" value="Yes" required  <?php if($_SESSION['myForm']['profile_access']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="profile_access" id="profile_access_2" value="No" required  <?php if($_SESSION['myForm']['profile_access']=="No") { echo 'checked="checked"'; } else { } ?> /> No
                        </div>
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row"> 
                    	<div class="col-md-9">                        	
                        	Employers can access my contact details
                        </div>
                        <div class="col-md-3"> 
                        <input type="radio" name="contact_access" id="contact_access_1" value="Yes" required  <?php if($_SESSION['myForm']['contact_access']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="contact_access" id="contact_access_2" value="No" required  <?php if($_SESSION['myForm']['contact_access']=="No") { echo 'checked="checked"'; } else { } ?> /> No
                        </div>
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row"> 
                    	<div class="col-md-9">                        	
                        	Employers Can contact me directly
                        </div>
                        <div class="col-md-3">
                        <input type="radio" name="contact_directly" id="contact_directly_1" value="Yes" required  <?php if($_SESSION['myForm']['contact_directly']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="contact_directly" id="contact_directly_2" value="No" required  <?php if($_SESSION['myForm']['contact_directly']=="No") { echo 'checked="checked"'; } else { } ?> /> No
                        </div>
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row"> 
                    	<div class="col-md-9">                       	
                        	Employers can access my certificates
                        </div>
                        <div class="col-md-3">
                        <input type="radio" name="view_certificates" id="view_certificates_1" value="Yes" required  <?php if($_SESSION['myForm']['view_certificates']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="view_certificates" id="view_certificates_2" value="No" required  <?php if($_SESSION['myForm']['view_certificates']=="No") { echo 'checked="checked"'; } else { } ?> /> No
                        </div>
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row"> 
                    	<div class="col-md-9">                       	
                        	Ask my Approval before Employer accessing my Certificates
                        </div>
                        <div class="col-md-3">  
                        <input type="radio" name="view_certificates_need_approval" id="view_certificates_need_approval_1" value="Yes" required  <?php if($_SESSION['myForm']['view_certificates_need_approval']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="view_certificates_need_approval" id="view_certificates_need_approval_2" value="No" required  <?php if($_SESSION['myForm']['view_certificates_need_approval']=="No") { echo 'checked="checked"'; } else { } ?> /> No
                        </div>
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