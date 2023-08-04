<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile"; $gtjqueryui = "Yes"; $gtckeditor = "Yes";

checkuserlogin(); 

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
	if(empty($_POST['oldpassword']) ) {$errors[]='Please fill out the old password field.';}
	elseif(tocheckoldpwdusers($_POST['oldpassword'], "ss_jobseekers", $_SESSION["USER"]['ID'])==0) {$errors[]='Please fill out the correct old password field.';}
	
	if (empty($_POST['rwspassword']) ) 	{	$errors[]="Please fill out the password field.";		} 
	else { 
		
		$uppercase = preg_match('@[A-Z]@', $_POST['rwspassword']);
		$lowercase = preg_match('@[a-z]@', $_POST['rwspassword']);
		$number    = preg_match('@[0-9]@', $_POST['rwspassword']);
		$specialChars = preg_match('@[^\w]@', $_POST['rwspassword']);
		
		if(strlen($_POST['rwspassword']) < 8) { $errors[]='Password must be at least 8 characters long!'; }
		
		if(!$uppercase || !$lowercase || !$number || !$specialChars) {
			$errors[] = $_POST['rwspassword'].' Password should include at least one upper case letter, at least one lower case letter, one number, and one special character.';
		}				
	}
	
	if (empty($_POST['rwscpassword']) ) {	$errors[]="Please fill out the confirm password field.";		} 
	else {
		if($_POST['rwspassword'] != $_POST['rwscpassword'] ) {
			$errors[]='Confirm password does not match?';
		}
	}
	
	
	if(empty($errors)) 
	{
			/* Update Data To Database */
			
			$password 			= md5($_POST["rwspassword"]);
			$sendpass 			= $_POST["rwspassword"];
			
			$update_query = "UPDATE `ss_jobseekers` SET password = '$password' WHERE `id`=".$_SESSION["EMP"]['ID'];

			$update_result = $db->query($update_query);	
			
			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your password has been updated successfully.</div>';	

			echo "<script>document.location.href='".$baseurl."employer-change-password.php'</script>";
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
		<div class="container"><h1>Change Password</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Change Password</a>
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
                <div class="mtitle">Change Password</div>
                <div class="rws-mcontent">
                	<?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                    
                   <div class="rws-fields">
                                    <input type="password" name="oldpassword" id="oldpassword" value="<?php echo $_SESSION['myForm']['oldpassword']; ?>" placeholder="*Old Password" required />
                    </div>
                   <div class="rws-fields">
                                    <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required />
                    </div>
                    <div class="rws-fields">
                        <input type="password" name="rwscpassword" id="rwscpassword" value="<?php echo $_SESSION['myForm']['rwscpassword']; ?>" placeholder="*Confirm Password" required />
                    </div>
            
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

<!-- RWS Footer Starts --> 