<?php include("includes/config.php"); $rwspagevar = "registerjobseeker"; tocheckloginstate();

unset($_SESSION["USER"]);
unset($_SESSION["EMP"]);

$_SESSION['myForm']="";
$gt_msgerror= "";
if(isset($_POST["rwsformsubmit"]))
{
	
	$_SESSION['myForm'] = $_POST;

	if(empty($_POST['rwsusername']) ) {$errors[]='Email ID field can\'t be blank!';}
		
	if (empty($_POST['rwspassword']) ) 	{	$errors[]="Please fill out the password field.";		}
	
	if(empty($errors))
	{
		$rwsusername	=	$db->escape($_POST['rwsusername']);
		$rwspassword	=	md5($_POST['rwspassword']);
		$rwsusertype	=	$_POST['rwsusertype'];

		$query_login="SELECT * FROM `ss_jobseekers` WHERE `email`='$rwsusername' AND `password`='$rwspassword' ";
		$result = $db->query($query_login);

		$numrows=$result->num_rows;

		if($numrows>0)
		{
			$row = $result->row;
			
			if($row["status"] == 0)
			{
				echo"test";
	
				$gt_msgerror='<div id="rws-formfeedback">Sorry! Your Account has been temporarily suspend Please call us immediately on '.$admin_support_mobile.'.</div>';

			}
			elseif($row["validate"] == 0)
			{
		
				$jsid 			= $row["id"];
				$fullname 		= $row["fullname"];
				
				$validateid = base64_encode("SS-".$jsid);
				
				$activeurl = $baseurl."jobseekers-validate.php?vid=".str_replace('=','rEN',$validateid);
			
				/* Email Verification Code */
				$subject = "Hello $fullname, Validate your account on ".$sitename;
				$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello '.$fullname.',<br /><br />
			Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br/><br/><br/><br/>
			</td>
		  </tr>	  
		  '.$emailfooter;
		
				sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				
				$gt_msgerror='<div id="rws-formattention">Sorry! Your Account has not validated. We have sent a validation link to your registered email id. Please check and validate your account.</div>';

			}
			elseif($row["admin_approval"] == 0)
			{
				$gt_msgerror='<div id="rws-formfeedback">Sorry! Your Account is under review. Account activated within 24 hours. </div>';
				
			}
			else
			{
				
				$_SESSION["USER"]['ID']					=	$row["id"];
				$_SESSION["USER"]['Fullname']			=	$row["fullname"];
			//	$_SESSION["USER"]['Lastname']			=	$row["lastname"];
				$_SESSION["USER"]['Email']				=	$row["email"];
				$_SESSION["USER"]['Mobile']				=	$row["mobile"];
				$_SESSION["USER"]['Picture']			=	$row["profile_pic"];
				$_SESSION["USER"]['Headline']			=	$row["professional_headline"];
			
				$_SESSION["USER"]['Type']				=	"Jobseeker";
				$_SESSION["USER"]['GTUserProfileID']	=	$row["oauth_uid"];
				$_SESSION["USER"]['GTUserLoginFrom']	=	$row["oauth_provider"];
				$_SESSION["USER"]['GTUserphotograph']	=	$row["profile_pic"];

				if($_POST["remember_me"]==1)
				{
					// generate cooked of username and password
					setcookie("RWSSSUsername", $_POST['rwsusername']);
					setcookie("RWSSSPassword", $_POST['rwspassword']);
					setcookie("RWSSSSelected", 1);
				}
				else
				{
					setcookie("RWSSSUsername", "");
					setcookie("RWSSSPassword", "");
					setcookie("RWSSSSelected", 0);
				}

				$_SESSION['GTUserCurrentLogin']	=	$gtcurrenttime;
							
				$query_update_logintime = "UPDATE `ss_jobseekers` SET `last_login` = $gtcurrenttime WHERE `id` =".$row["id"];

				$result_logintime = $db->query($query_update_logintime);

				unset($_SESSION['myForm']);
				if($_GET["jobid"]>0)
				{
					echo "<script>document.location.href='".$baseurl."job-details.php?jobid=".$_GET["jobid"]."'</script>";
					exit;
				}
				else
				{
					echo "<script>document.location.href='".$baseurl."jobseekers-dashboard.php'</script>";
					exit;
				}
			}
		}
		else
		{
			$gt_msgerror='<div id="rws-formfeedback">The email id and password you entered do not match.</div>';
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
		<div class="container"><h1>Jobseeker Login</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Jobseeker Login</a>
            </div>
        </div>
    </div>
</div>  

<div class="rws-maincontentinner">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
            	<div class="rws-maincontentinn">
                	<div class="rws-module">
                		<h3 class="mtitle">Welcome Back</h3>
                        <div class="rws-mcontent">  
                            <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                            <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
                                <div class="rws-fields">
                                	<label>Email</label>
                                    <input type="email" name="rwsusername" id="rwsusername" value="<?php echo $_SESSION['myForm']['rwsusername']; ?>" placeholder="*Email ID" required />
                                </div>
                                <div class="rws-fields">
                                	<label>Password</label>
                                    <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required />
                                </div>
                                               
                                <div class="rws-fields text-center">
                                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Login" class="rwsbutton width_100" />
                                </div> 
                                <div class="rws-fields">
                                    <div class="row">
                                    	<div class="col-xs-5"><a href="<?php echo $baseurl;?>jobseekers-register.php">Signup</a></div>
                                        <div class="col-xs-7 textright"><a href="<?php echo $baseurl;?>jobseekers-forget-password.php">Forgot Password?</a></div>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                    </div>
                    <!-- Module Ends -->
                </div>
            </div>
            
        </div>
    </div>
</div>
