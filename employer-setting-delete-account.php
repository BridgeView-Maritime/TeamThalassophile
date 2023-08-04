<?php include("includes/config.php");  $gtpage = "Employer-Edit-Profile"; $gtjqueryui = "Yes"; $gteditor = "Yes";

checkemplogin(); 
checkemploginrole("None");

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
	if (empty($_POST['confirm'])) 					{	$errors[]="Please confirm to Delete or Temporarily De-Activate or Activate your account.";		}
	
	if($_POST["profile_status"]=="Deactivate")
	{
		if (empty($_POST['deactive_till_date']) || $_POST['deactive_till_date']=="0000-00-00")	{	$errors[]="Please fill out the Temporarily De-Activate until field";		}
	}

	if(empty($errors)) 
	{
			$profile_status			= $_POST['profile_status'];	
			$confirm 				= $_POST['confirm'];	
			$deactive_till_date 	= $_POST['deactive_till_date'];
									
			/* Update Data To Database */
			if(trim($profile_status)=="Deactivate")
			{
				if(!empty($deactive_till_date))
				{
					$update_query = "UPDATE `ss_employer` SET status = '2', deactive_till_date = '$deactive_till_date' WHERE `id`=".$_SESSION["EMP"]['ID'];
		
					$update_result = $db->query($update_query);	
					
					$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your settings has been updated.</div>';	
		
					echo "<script>document.location.href='".$baseurl."employer-setting-delete-account.php'</script>";
					exit;
				
				}
			}
			elseif(trim($profile_status)=="Activate")
			{				
				$update_query = "UPDATE `ss_employer` SET status = '1', deactive_till_date = '' WHERE `id`=".$_SESSION["EMP"]['ID'];
	
				$update_result = $db->query($update_query);	
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your settings has been updated.</div>';	
	
				echo "<script>document.location.href='".$baseurl."employer-setting-delete-account.php'</script>";
				exit;				
				
			}
			else
			{			
				if(trim($profile_status)=="Delete")
				{
					// Delete JobSeeker Account from ss_employer
					$query_delete_1 = "DELETE FROM `ss_employer` WHERE `id`=".$_SESSION["EMP"]['ID'];
					$result_1		= $db->query($query_delete_1);
					
					// Delete JobSeeker Data From from ss_employer_jobs
					$query_delete_2 = "DELETE FROM `ss_employer_jobs` WHERE `emp_id`=".$_SESSION["EMP"]['ID'];
					$result_2		= $db->query($query_delete_2);
					
					// Delete JobSeeker Data From from ss_employer_jobseekars_short_listed	
					$query_delete_2 = "DELETE FROM `ss_employer_jobseekars_short_listed` WHERE `emp_id`=".$_SESSION["EMP"]['ID'];
					$result_2		= $db->query($query_delete_2);
					
					// Delete JobSeeker Data From from ss_employer_jobs_query
					$query_delete_2 = "DELETE FROM `ss_employer_jobs_query` WHERE `emp_id`=".$_SESSION["EMP"]['ID'];
					$result_2		= $db->query($query_delete_2);
					
					// Delete JobSeeker Data From from ss_employer_manager
					$query_delete_2 = "DELETE FROM `ss_employer_manager` WHERE `emp_id`=".$_SESSION["EMP"]['ID'];
					$result_2		= $db->query($query_delete_2);
					
					// Delete JobSeeker Data From from ss_jobseekers_jobapplied
					//$query_delete_2 = "DELETE FROM `ss_jobseekers_jobapplied` WHERE `emp_id`=".$_SESSION["EMP"]['ID'];
					//$result_2		= $db->query($query_delete_2);
					
					// Delete JobSeeker Data From from ss_jobseekers_jobapplied_query
					//$query_delete_2 = "DELETE FROM `ss_jobseekers_jobapplied_query` WHERE `emp_id`=".$_SESSION["EMP"]['ID'];
					//$result_2		= $db->query($query_delete_2);
					
					/* Send Email To Admin */
					
					$feedback = $_POST["feedback"];
					
					/* Email Verification Code */
					$subject = "Hello Admin, ".$_SESSION["EMP"]['Firstname']." user deleted his account successfully from ".$sitename;
					$body = $emailheader.'
				  <tr>
					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
					Hello Admin,<br /><br />
					'.$_SESSION["EMP"]['Firstname'].' Account has been deleted successfully from '.$sitename.'.<br /><br />
					<strong>User Feedback:</strong> <br/>'.$feedback.'<br/><br/>
					</td>
				  </tr>	  
				  '.$emailfooter;
			
				sendmail("wdrangnath@gmail.com",$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				
				/* Send Email To User */
					$subject = "Hello ".$_SESSION["EMP"]['Firstname'].", Your Account has been deleted successfully from ".$sitename;
					$body = $emailheader.'
				  <tr>
					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
					Hello '.$_SESSION["EMP"]['Firstname'].',<br /><br />
					Your Account has been deleted successfully from '.$sitename.'.<br /><br />
					Thank you for using our website.<br/><br/>
					</td>
				  </tr>	  
				  '.$emailfooter;
			
				sendmail($_SESSION["EMP"]['Email'],$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
					
					// Remove Session
					unset($_SESSION["USER"]);
					unset($_SESSION["EMP"]); 
					
					$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your account has been deleted successfully.</div>';	
	
					echo "<script>document.location.href='".$baseurl."employer-register.php'</script>";
					exit;	
				}
			}
			
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
	
	$select_query = 'SELECT * FROM `ss_employer` WHERE id = "'.$_SESSION["EMP"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
	$_SESSION['myForm']['deactive_till_date'] = stripslashes($rowut['deactive_till_date']);		
	$_SESSION['myForm']['profile_status']	  = stripslashes($rowut['status']);		
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
		<div class="container"><h1>Delete / Inactive Account</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Delete / Inactive Account</a>
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
        
        	<div class="rws-module">
                <div class="mtitle">Choose correct info</div>
                <div class="rws-mcontent">
                	<?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                    
                    <div class="row align-items-center">
                    
                    <div class="col-md-8">
                    
                    <div class="rws-fields">    
                    	<input type="radio" name="profile_status" id="profile_status_1" value="Deactivate" required  <?php if($_SESSION['myForm']['profile_status']=="2") { echo 'checked="checked"'; } else { } ?> /> Temporarily De-Activate &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="profile_status" id="profile_status_2" value="Activate" required  <?php if($_SESSION['myForm']['profile_status']=="1") { echo 'checked="checked"'; } else { } ?> /> Activate                        
                        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">    
                        <input type="date" name="deactive_till_date" id="deactive_till_date" value="<?php echo $_SESSION['myForm']['deactive_till_date']; ?>" placeholder="Temporarily De-Activate" required />       
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">    
                    	<input type="checkbox" name="confirm" id="confirm" value="Yes" required <?php if($_SESSION['myForm']['delete']=="Yes") { echo 'checked="checked"'; } else { } ?> /> Please confirm to process the above request.      
                    </div>
                	<!-- Row Ends -->
                    
                    </div>
                    <div class="col-md-4">
                    	<button type="button" data-toggle="modal" data-target="#deletemyaccount" class="btn btn-danger">Delete Account</button>
                    </div>
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

<!-- Modal -->
<div class="modal fade" id="deletemyaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        	<p><input type="checkbox" name="confirm" id="confirm" value="Yes" required /> Are you sure to delete your jobseakers account. Please confirm to complete the process.
            <input type="hidden" value="Delete" name="profile_status" /></p>
            <p><textarea name="feedback" id="feedback" required>Share your feedback....</textarea></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Delete Account</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>  
  </div>
</div>

<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->
<?php include("app/gtfooter.php"); ?>
<!-- RWS Footer Starts --> 