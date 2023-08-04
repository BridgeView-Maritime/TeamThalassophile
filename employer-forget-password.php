<?php include("includes/config.php");  $gtpagevar = "home"; tocheckloginstate();?>
<!-- RWS Header Starts -->
<?php $loginbg = 1;  include("app/gtheader.php"); ?>
<?php $gt_msgerror= "";

if(isset($_POST["email"]))

{

	$_SESSION['myForm'] = $_POST;
	
	if(empty($_POST['email']) ) { $errors[]="Please fill out the email field."; } 
	/*else if(!is_numeric($_POST['mobile'])) { $errors[]="Mobile number should be numeric only."; }
	else if(strlen($_POST['mobile'])!=10) { $errors[]="Mobile Number should be 10 digits."; }*/

	if(empty($errors)) 

	{	
		$email = $_POST['email'];

		$query="SELECT * FROM `ss_employer` WHERE `email`='$email' ";	
			
		
		$result = $db->query($query);

		$numrows=$result->num_rows;

		if($numrows>0)

		{

			$row = $result->row;

			if($row["status"] == 0)
			{
				$gt_msgerror='<div id="rws-formfeedback">Sorry! Your Account has been temporarily suspend Please call us immediately on '.$admin_support_mobile.'.</div>';
			}
			elseif($row["validate"] == 0)
			{
				$jsid 			= $row["id"];
				$firstname 		= $row["firstname"];
				
				$validateid = base64_encode("SS-".$jsid);
				
				$activeurl = $baseurl."employer-validate.php?vid=".str_replace('=','rEN',$validateid);
				
				/* Email Verification Code */
				$subject = "Hello $firstname, Validate your account on ".$sitename;
				$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello '.$firstname.',<br /><br />
			Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br/><br/><br/><br/>
			</td>
		  </tr>	  
		  '.$emailfooter;
	
				sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				
				$gt_msgerror='<div id="rws-formattention">Sorry! Your Account has not validated. We have sent a validation link to your registered email id. Please check and validate your account.</div>';

			}
			else
			{	

			$firstname 	= $row["firstname"];
			
			$email	 	= $row["email"];
			
			$mobile		= $row["mobile"];
			$userid 	= $row["id"];
			
			$verificationcode 	= rand(100000,999999);
			$password 			= md5($verificationcode);
			$sendpass 			= $verificationcode;
			
			// Update Passowrd Code
			
			$query_insert = "UPDATE `ss_employer` SET password = '$password' WHERE `id`='$userid'";
			$result = $db->query($query_insert);
			// Send SMS Code 
			
			$textmsg2 = 'Dear '.$firstname.', Your password for JobSEAkers account is '.$verificationcode;
		
			$usermobile2 = $mobile;
			
			//sendsms($usermobile2,$textmsg2);
			
			/* Email Verification Code */
			$subject = "Hello $firstname, Your New Password on ".$sitename;
			$body = $emailheader.'
			  <tr>
				<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
				Hello '.$firstname.',<br /><br />
				Your password is <strong>'.$sendpass.'</strong><br/><br/>
				</td>
			  </tr>	  
			  '.$emailfooter;
		
			sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);

			
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Your password has been sent to register <strong>email</strong> id with JobSEAkers.</div>';			
			echo "<script>document.location.href='".$baseurl."employer-login.php'</script>";
			exit;

			}

	}
	else
	{
		$gt_msgerror='<div id="rws-formfeedback">Sorry! your email id doesn\'t exist in our database. Please call us immediately on '.$admin_support_mobile.'.</div>';
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

?>
<!-- RWS Header Starts -->  

<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Employer Forgot Password?</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>      

<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
	<div class="container">	
    <div class="row">    
    	<div class="col-sm-offset-3 col-sm-6">
        <div class="rws-maincontentinn">
            <div class="rws-module">
                <h3 class="mtitle">Get New Password</h3>
                <div class="rws-mcontent">
            <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
            <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        	<div class="rws-fields">    
                <input type="email" name="email" id="email" value="" placeholder="*Email ID" required />    
            </div>            
            <div class="rws-fields text-center">    
                <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />    
            </div>  
            </form> 
            
            <div class="rws-fields">

                <div class="row">

                	<div class="col-6"><a href="employer-login.php">Login</a></div>

                    <div class="col-6" style="text-align:right;"><a href="employer-register.php">Register</a></div>

                </div>

            </div>         
        
        </div>
        </div>
        </div>
        
    </div>
    </div>        
</div>
<!-- RWS Dashboard Starts -->        

<!-- RWS Footer Starts -->
<?php include("app/gtfooter.php"); ?>
<!-- RWS Footer Starts --> 