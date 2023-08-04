<?php include("includes/config.php");  $gtpage = "Employer-Post-Offshore-Jobs";

checkemplogin(); 
checkemploginrole("None");

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
	if (empty($_POST['firstname']) ) 		{	$errors[]="Please fill out the firstname field.";		}	
	if (empty($_POST['lastname']) ) 		{	$errors[]="Please fill out the lastname field.";	}
	if (empty($_POST['email']) ) 			{	$errors[]="Please fill out the email field.";		}
				
	if (empty($_POST['role']) ) 			{	$errors[]="Please fill out the role field.";		}	
	
	if(empty($_POST["post_id"]))
	{
		if (empty($_POST['password']) ) 		{	$errors[]="Please fill out the password field.";		}	
		else { 
			
			$uppercase = preg_match('@[A-Z]@', $_POST['password']);
			$lowercase = preg_match('@[a-z]@', $_POST['password']);
			$number    = preg_match('@[0-9]@', $_POST['password']);
			$specialChars = preg_match('@[^\w]@', $_POST['password']);
			
			if(strlen($_POST['password']) < 8) { $errors[]='Password must be at least 8 characters long!'; }
			
			if(!$uppercase || !$lowercase || !$number || !$specialChars) {
				$errors[] = $_POST['password'].' Password should include at least one upper case letter, at least one lower case letter, one number, and one special character.';
			}
		}
		
		if(isUnique("email", $_POST['email'], "ss_employer_manager"))
		{
			
		}
		else
		{
			$errors[]="Email ID already exists to our database. Please use another email id.";
		}
	}
	else
	{
		if (!empty($_POST['password']) ) 		
		{	
			$uppercase = preg_match('@[A-Z]@', $_POST['password']);
			$lowercase = preg_match('@[a-z]@', $_POST['password']);
			$number    = preg_match('@[0-9]@', $_POST['password']);
			$specialChars = preg_match('@[^\w]@', $_POST['password']);
			
			if(strlen($_POST['password']) < 8) { $errors[]='Password must be at least 8 characters long!'; }
			
			if(!$uppercase || !$lowercase || !$number || !$specialChars) {
				$errors[] = $_POST['password'].' Password should include at least one upper case letter, at least one lower case letter, one number, and one special character.';
			}		
		}			
	}
		
	if(empty($errors)) 
	{
			$firstname 					= addslashes($_POST["firstname"]);
			$lastname 					= addslashes($_POST["lastname"]);
			$email 						= addslashes($_POST["email"]);
			$role 						= addslashes($_POST["role"]);
			
			$password 					= md5($_POST["password"]);
			
			$sendpassword				= $_POST["password"];
			
			$post_id 					= $_POST["post_id"];
			
			$emp_id 					= $_SESSION["EMP"]['ID'];			

			/* Update Data To Database */
			if($post_id>0)
			{
				$modify_date 				= $gtcurrenttime;	
				
				if(!empty($sendpassword))
				{
					$update_query = "UPDATE `ss_employer_manager` SET firstname = '$firstname', lastname = '$lastname', email = '$email', role = '$role', password = '$password' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
				}
				else
				{
					$update_query = "UPDATE `ss_employer_manager` SET firstname = '$firstname', lastname = '$lastname', email = '$email', role = '$role' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
				}
				
				$update_result = $db->query($update_query);	
				
				$job_id = $post_id;
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your team member detail has been updated successfully.</div>';	
				
			}
			else
			{
				$update_query = "INSERT INTO `ss_employer_manager` SET firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password', role = '$role', status = '1', `validate`='1', `emp_id`='".$_SESSION["EMP"]['ID']."', add_date = '$gtcurrenttime'";
				
				$update_result = $db->query($update_query);	
				
				$job_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your team member detail has been added successfully.</div>';	
				
				// Send Email to User with his login details:
				
				/* Email Verification Code */
				$subject = "Hello $firstname, Your Account has been created successfully on ".$sitename;
				$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello '.$firstname.',<br /><br />
			'.$_SESSION["EMP"]['Company'].' has created your account on '.$sitename.'. Now you can login and manage their account. Here is login details:<br/><br/>
			<strong>Username:</strong> '.$email.'<br/>
			<strong>Password:</strong> '.$sendpassword.'<br/><br/>
			<a href="'.$baseurl.'employer-login.php">Click here</a> to get login and manage your account<br/><br/>
			</td>
		  </tr>	  
		  '.$emailfooter;
	
		sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
								
			}
			
			echo "<script>document.location.href='".$baseurl."employer-team-list.php'</script>";
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
	$post_id = $_GET["post_id"];
	if($post_id>0)
	{
	$select_query = 'SELECT * FROM `ss_employer_manager` WHERE `id`="'.$post_id.'" AND emp_id = "'.$_SESSION["EMP"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
	$_SESSION['myForm']['firstname'] 			= stripslashes($rowut["firstname"]);
	$_SESSION['myForm']['lastname'] 			= stripslashes($rowut["lastname"]);
	$_SESSION['myForm']['email'] 				= stripslashes($rowut["email"]);
	$_SESSION['myForm']['password'] 			= "";
	$_SESSION['myForm']['role'] 				= stripslashes($rowut["role"]);
	
	
	}
	
}
else
{
	
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update Team Member Details";
}
else
{
	$pagetitle = "Add New Team Member";
}


?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts -->  

<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1><?php echo $pagetitle; ?></h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)"><?php echo $pagetitle; ?></a>
            </div>
        </div>
    </div>
</div>

<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
	<div class="container">
    <div class="row">
    	<div class="col-md-4">
        	<?php include("app/employer-leftmenu.php"); ?>        	
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">        
        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        <input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
        	<div class="rws-module">
                <div class="rws-mcontent" style="overflow:hidden;">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                	<div class="rws-fields">
                        <input type="text" name="firstname" value="<?php echo $_SESSION['myForm']["firstname"];?>" placeholder="*Firstname" required />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">
                        <input type="text" name="lastname" value="<?php echo $_SESSION['myForm']["lastname"];?>" placeholder="*Lastname" required />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">
                        <input type="email" name="email" value="<?php echo $_SESSION['myForm']["email"];?>" placeholder="*Email ID" required />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">
                        <input type="password" name="password" value="<?php echo $_SESSION['myForm']["password"];?>" placeholder="*Password" />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">
                    	<?php echo todisplay($array_emp_team_role, "role", "Select Role", $_SESSION['myForm']["role"], $onchange="required"); ?>
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