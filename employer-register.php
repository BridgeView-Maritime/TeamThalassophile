<?php

 include("includes/config.php"); 

 $rwspagevar = "registerjobseeker"; tocheckloginstate();

//include_once 'securimage/securimage.php';

//$securimage = new Securimage();

$_SESSION['myForm']="";
$gt_msgerror= "";
if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;

	if (empty($_POST['firstname']) ) 	{	$errors[]="Please fill out the firstname field.";		}
	if (empty($_POST['lastname']) ) 	{	$errors[]="Please fill out the lastname field.";		}

	if (empty($_POST['company']) ) 		{	$errors[]="Please fill out the company field.";		}
	
	if(empty($_POST['rwsusername']) ) {$errors[]='Email ID field can\'t be blank!';}
	
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
		/*
		if(strlen($_POST['rwspassword']) < 6) { $errors[]='Password must be at least 6 characters long!'; } 
		
		if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{8,20}$/',$_POST['rwspassword'])) {
$errors[]="Password must contain at least one uppercase letter (A to Z), one lowercase letter (a to z), and one numeric number (0 to 9)";
}*/
		
	}
	
	if (empty($_POST['rwscpassword']) ) {	$errors[]="Please fill out the confirm password field.";		} 
	else {
		if($_POST['rwspassword'] != $_POST['rwscpassword'] ) {
			$errors[]='Confirm password does not match?';
		}
	}
	
	
	if (empty($_POST['country']) ) 	{	$errors[]="Please fill out the country field.";		}
	
	if (empty($_POST['termsofuse']) ) 	{	$errors[]="Please select terms and conditions field.";		}
	
	if (empty($_POST["capt_code"]) ) {$errors[]='We need you to confirm that you are human and not a robot., Please enter the CAPTCHA.';}

	if(empty($errors))
	{
		if ($_POST['capt']!=$_POST['capt_code']) {

			$gt_msgerror = '<div id="rws-formfeedback">The Captcha code you entered was incorrect. Please try again.</div>';
		}
		else
		{	
			if(isUnique("email", $_POST['rwsusername'], "ss_employer"))
			{
				
				$firstname			= $_POST["firstname"];
				$lastname			= $_POST["lastname"];
				$company			= $_POST["company"];
				$email 				= $_POST["rwsusername"];
				$mobile				= $_POST["mobile"];
				$password 			= md5($_POST["rwspassword"]);
				$sendpass 			= $_POST["rwspassword"];			
				$country			= $_POST["country"];			
				$termsofuse			= $_POST["termsofuse"];
				
	
				/* Insert Code to Database */
				$query_insert = "INSERT INTO `ss_employer` SET firstname = '$firstname', lastname = '$lastname', mobile = '$mobile', email = '$email', password = '$password', company = '$company', country = '$country', termsofuse = '$termsofuse', status = '1', validate = '0', mstatus = '0', add_date = '$gtcurrenttime'";


				$query=mysqli_query($db,$query_insert);
	

				$update_result = $db->query($query_insert);
	

				$userid = $db->getLastId();
	

				$validateid = base64_encode("SS-".$userid);
				
				/* Send SMS to User */
				
				// $textmsg2 = 'Dear '.$firstname.', Thank you for registering with JobSEAkers. Your password is '.$verificationcode;
			
				// $usermobile2 = $mobile;
				
				//sendsms($usermobile2,$textmsg2);
	
				$activeurl = $baseurl."employer-validate.php?vid=".str_replace('=','rEN',$validateid);
	
				/* Email Verification Code */
				// $subject = "Hello $firstname, Your Account has been created successfully on ".$sitename;
				// $body = $emailheader.'
		  /* <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello '.$firstname.',<br /><br />
			Thank you for registering to '.$sitename.'. Your password is <strong>'.$sendpass.'</strong><br/><br/>
			Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br/><br/><br/><br/>
			</td>
		  </tr>	  
		  '.$emailfooter;
	
				sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				
				/* Send Email To Admin */
				// $subject = "Hello Admin, New Employer Account has been created by $firstname [$company] successfully on ".$sitename;
				// $body = $emailheader.'
		  /* <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello Admin,<br /><br />
			A new user recently created his account on our website '.$sitename.'. Here is the complete Details:<br/><br/>
			Name: '.$firstname.' '.$lastname.'<br/>
			Company: '.$company.'<br/>
			Email ID: '.$email.'<br/>
			Country: '.$country.'
			<br/><br/>			
			</td>
		  </tr>	  
		  '.$emailfooter; */
	


		  												//Email For Employer
	
		  		$to = $email;
				$subject = "Hello ".$firstname.", Your Account has been created successfully on ".$sitename;

				$message ='<tr>
			
					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			
					Hello '.$firstname.',<br /><br />

					Thank you for registering to '.$sitename.'. Your password is <strong>'.$sendpass.'</strong><br/><br/>
					Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br/><br/>


					Best Regards <br/>
					TeamThalassophile <br/><br/><br/>
				
					</td>
		  			
		  			</tr>';

		  			// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
				$headers .= 'From: <admin@teamthalassophil.com>' . "\r\n";
				
				mail($to,$subject,$message,$headers);


				                                        //Email For Admin

				$to2='admin@teamthalassophile.com';
				$subject2 = "Hello Admin, New Employer Account has been created by $firstname successfully on ".$sitename;
				$message2='<tr>

					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			
					Hello Admin,<br /><br />

					A new user recently created his account on our website '.$sitename.'. Here is the complete Details:<br/><br/>
					Name: '.$firstname.' '.$lastname.'<br/>
					Email ID: '.$email.'<br/>
					Country: '.$country.'<br/><br/>			
			
					</td>
		  
		  			</tr>';

				
		  			// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
				$headers .= 'From: <admin@teamthalassophil.com>' . "\r\n";
				
				mail($to2,$subject2,$message2,$headers);



				// sendmail($admin_emaildemo_1,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				// sendmail($admin_emaildemo_2,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				// sendmail($admin_emaildemo_3,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);+

	
				/* Send Email To Admin */
	
				$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Dear User, you have successfully register with us. We have sent a verification link to your registered email id. <strong>Please validate your account.</strong> Please check your <strong>spam/junk folder</strong> also. </div>';
	
				unset($_SESSION['myForm']);
				
				$_SESSION["GTmobileReg"] = $email;
				
				echo "<script>document.location.href='".$baseurl."employer-login.php'</script>";
				exit;
	
			}
			else
			{
	
				$gt_msgerror ='<div id="rws-formfeedback">Email ID already exists to our database. Please use another email id for registration. </div>';
	
				$json['proceed'] = '0';
				$json['info'] = $gt_msgerror;
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



?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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




<style>
    .captchaa{
     background-image: url(images/captchaaa.png) !important;
     }

     .list{

	height: 300px !important; 
    overflow-y: auto !important;
}

.nice-select { width:100% !important; }


</style>

</head>
<body>


<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Employer - Create Your Profile</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Employer - Create Your Profile</a>
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
                		<h3 class="mtitle">Register Now</h3>
                        <div class="rws-mcontent">  
                            <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                            <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
                                <div class="rws-fields">
                                	<label>Firstname</label>
                                    <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['myForm']['firstname']; ?>" placeholder="*Firstname" required />
                                </div>
                                <div class="rws-fields">
                                	<label>lastname</label>
                                    <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['myForm']['lastname']; ?>" placeholder="*Lastname" required />
                                </div>
                                <div class="rws-fields">
                                	<label>Company</label>
                                    <input type="text" name="company" id="company" value="<?php echo $_SESSION['myForm']['lastname']; ?>" placeholder="*Company" required />
                                </div>
                                <div class="rws-fields">
                                	<label>Email ID</label>
                                    <input type="email" name="rwsusername" id="rwsusername" value="<?php echo $_SESSION['myForm']['rwsusername']; ?>" placeholder="*Email ID" required />
                                </div>
                                <div class="rws-fields">
                                	<label>Password</label>
                                    <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required />
                                </div>
                                <div class="rws-fields">
                                	<label>Confirm Password</label>
                                    <input type="password" name="rwscpassword" id="rwscpassword" value="<?php echo $_SESSION['myForm']['rwscpassword']; ?>" placeholder="*Confirm Password" required />
                                </div>

                                
                                <div class="rws-fields">
                                	  <label>Select Country</label><br/>

          							  <?php

                        //   $db = new database("sg2nlmysql41plsk.secureserver.net:3306","teamthalassophil","Ausea#123","teamthalassophil");
								
						//   if ($db->connect_error) {

  						//   die("Connection failed: " . $db->connect_error);
					
						//   }
			
						//  echo "Connected successfully";
 		               
              		                    $country="select * from ss_countries  where country!='' GROUP BY country order by country ASC";

                                        $result = $db->query($country);
	                                    $rowlist = $result->rows;
              		                 ?>

              						<select name="country">
    								<option selected >-- Select Country --</option>
    								
    								<?php
        								 foreach($rowlist as $key => $row)
	                                      {
            								echo "<option  value='". $row['country'] ."'>" .$row['country'] ."</option>"; 
        								}	
    								?>  
  
  									</select>

                    
                                </div> <br><br>

                               
                                <div class="rws-fields">
                                	 <label>Captcha Code</label>
                                     <div class="row">
                                     	<div class="col-xs-3">

                                     		<?php
												//Random Number Generation
												$rand=substr(rand(),0,4); //only show 4 numbers
											?>

                                     		<input type="text" class="captchaa" id="capt" value="<?=$rand?>"  name="capt" readonly="readonly" > 
                                     		
                                        </div>
                                         
                                        <div class="col-xs-3">
                                        	<span>
                                     		 <i class="fa fa-refresh fa-spin"  title="Reload Captcha" onclick="captch()" style="font-size:40px;color:green">  </i> 
                                     		</span>
                                         </div>

                                        <div class="col-xs-6">
                                        	<input type="text" class="input-default" placeholder="Enter Captcha Code" name="capt_code" id="captcha_code" maxlength="6" />
                                        </div>

                                     </div>
                                     

                                </div>


                                <div class="rws-fields">
                                    <input type="checkbox" name="termsofuse" id="termsofuse" value="1" required="required" <?php if($_SESSION['myForm']['termsofuse']==1) { echo 'checked="checked"'; } else { } ?> /> Are you agree with our <a href="terms-and-conditions.php" target="_blank">terms and conditions</a>?
                                </div>
                                          

                                <div class="rws-fields text-center">
                                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Register" class="rwsbutton width_100" />
                                </div>   
                                
                               <p>Already have an Account? <a href="<?php echo $baseurl;?>employer-login.php">Log In</a></p>
                            </form>
                        </div>
                    </div>
                    <!-- Module Ends -->
                </div>
            </div>
            
        </div>
    </div>
</div>





<script type="text/javascript">

//Javascript Captcha validation

function validation()
{


if(document.form1.capt_code.value=="")
{
document.getElementById("error").innerHTML="Enter Captcha!";
document.form1.capt_code.focus();
return false;
}


if(document.form1.capt.value!=document.form1.capt_code.value)
{
document.getElementById("error").innerHTML="Captcha Not Matched!";
document.form1.capt_code.focus();
return false;
}
return true;
}
</script>

<script type="text/javascript">

//Javascript Referesh Random String

function captch() {
    var x = document.getElementById("capt")
    x.value = Math.floor((Math.random() * 10000) + 1);
}
</script>




</body>
</html>