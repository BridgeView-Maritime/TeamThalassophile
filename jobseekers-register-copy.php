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

	if (empty($_POST['fullname']) ) 	{	$errors[]="Please fill out the fullname field.";		}
	
	if (empty($_POST['cv_category']) ) 	{	$errors[]="Please select the cv_category field.";		}
	/*if(empty($_POST['mobile']) ) { $errors[]="Please fill out the Mobile field."; } 
	else if(!is_numeric($_POST['mobile'])) { $errors[]="Mobile number should be numeric only."; }
	else if(strlen($_POST['mobile'])!=10) { $errors[]="Mobile Number should be 10 digits."; }*/
	
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

	/*    ------start-----------tanuja code--------------------------------*/

	//if (empty($_POST['category']) ) 	{	$errors[]="Please fill out the category field.";	}

	/*    --------end---------tanuja code--------------------------------*/
	
	if (empty($_POST['termsofuse']) ) 	{	$errors[]="Please select terms and conditions field.";		}
	
	if (empty($_POST["capt_code"]) ) {$errors[]='We need you to confirm that you are human and not a robot , Please enter the CAPTCHA.';}

	if(empty($errors))

	{
		
		if ($_POST['capt']!=$_POST['capt_code']) {
			
			$gt_msgerror = '<div id="rws-formfeedback">The Captcha code you entered was incorrect. Please try again.</div>';
		}
		else
		{	
			if(isUnique("email", $_POST['rwsusername'], "ss_jobseekers"))
			{

				
				$cv_category       	= $_POST["cv_category"];
				$fullname			= $_POST["fullname"];
				$email 				= $_POST["rwsusername"];
				$mobile				= $_POST["mobile"];
				$password 			= md5($_POST["rwspassword"]);
				$sendpass 			= $_POST["rwspassword"];	
				$dateofbirth		= $_POST["dateofbirth"];					
				$country			= $_POST["country"];			
				$termsofuse			= $_POST["termsofuse"];
				//$resume			    = $_POST["resume"];
				$rank_cat			= $_POST["rank_cat"];
				$prank			    = $_POST["prank"];
				$arank			    = $_POST["arank"];
				//$rankname			= $_POST["rankname"];
				//$category			= $_POST["category"];
				
				
		/*		if($rank_cat=="marine"){
					$rankname = $_POST["rank1"];
					$applied_rank = $_POST["arank1"];
				}else if($rank_cat=="rings"){
					$rankname = $_POST["rank2"];
					$applied_rank = $_POST["arank2"];
				}else if($rank_cat=="offshore"){
					$rankname = $_POST["rank3"];
					$applied_rank = $_POST["arank3"];
				}else{
					$rankname="";
					$applied_rank="";
				}

    */



/*

if((!empty($_FILES["resume"])) && ($_FILES['resume']['error'] == 0)) {
	// basename -- Returns filename component of path
	$filename = basename($_FILES['resume']['name']);
	$ext = substr($filename, strrpos($filename, '.') + 1);
	$filesize=$_FILES['resume']['size'];
	$max_bytes=$max_file_size*1024;	
	$allowtypes=array("doc", "docx", "pdf");
	//Check if the file type uploaded is a valid file type. 
	if (!in_array($ext, $allowtypes)) {
		$errors[]="Resume <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .doc, .docx, .pdf.";	
	// check the size of each file
	} elseif($filesize > $max_bytes) {
		$errors[]= "Resume: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
	}
	} 

*/
	
/*
	$target_path = 'usercvdata/'.time().$filename;  
	 	
	if(move_uploaded_file($_FILES['resume']['tmp_name'], $target_path)) {  
		echo "File uploaded successfully!";  
	} else{  
		echo "Sorry, file not uploaded, please try again!";  
	}     
*/

        $resume =time().$_FILES['resume']['name'];

        $temp=  $_FILES['resume']['tmp_name'];

		$cvname = "usercvdata/$resume";

        move_uploaded_file($temp, "usercvdata/$resume") ;


	//$resumeurl = 'usercvdata/'.$resume.'/';
	//move_uploaded_file ($fileThumbnail, $add_thumbnail);		
	
				/* Insert Code to Database */
				$query_insert = "INSERT INTO `ss_jobseekers` SET  cv_category ='$cv_category',fullname ='$fullname', mobile = '$mobile', email = '$email', password = '$password', dateofbirth ='$dateofbirth', country = '$country', resume = '$cvname', rank_cat = '$rank_cat', rankname = '$prank',applied_rank='$arank', termsofuse = '$termsofuse', profile_display = 'Yes', profile_access = 'Yes', contact_access = 'Yes', contact_directly = 'Yes', view_certificates = 'Yes', view_certificates_need_approval = 'Yes', status = '1', validate = '0', mstatus = '0', add_date = '$gtcurrenttime'";

                 //echo $query_insert;exit;

		//		$query=mysqli_query($db,$query_insert);

			
	
				$update_result = $db->query($query_insert);

	
				$userid = $db->getLastId();


				$validateid = base64_encode("SS-".$userid);



				
				/* Send SMS to User */
				
			//	$textmsg2 = 'Dear '.$firstname.', Thank you for registering with Optimo Cards. Your password is '.$verificationcode;
			
			//	$usermobile2 = $mobile;
				
				//sendsms($usermobile2,$textmsg2);
	
				$activeurl = $baseurl."jobseekers-validate.php?vid=".str_replace('=','rEN',$validateid);
	
				/* Email Verification Code */
			//	$subject = "Hello $firstname, Your Account has been created successfully on ".$sitename;
			//	$body = $emailheader.'
		 /* <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello '.$firstname.',<br /><br />
			Thank you for registering to '.$sitename.'. Your password is <strong>'.$sendpass.'</strong><br/><br/>
			Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br/><br/><br/><br/>
			</td>
		  </tr>	  
		  '.$emailfooter;

	
				//sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				
				/* Send Email To Admin */


			//	$subject = "Hello Admin, New Jobseeker Account has been created by $firstname successfully on ".$sitename;
			//	$body = $emailheader.'
		 /* <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello Admin,<br /><br />
			A new user recently created his account on our website '.$sitename.'. Here is the complete Details:<br/><br/>
			Name: '.$firstname.' '.$lastname.'<br/>
			Email ID: '.$email.'<br/>
			Country: '.$country.'
			<br/><br/>			
			</td>
		  </tr>	  
		  '.$emailfooter; */



				
		                  //Email For Candidate

			/* $email name replace with   	$emailadd   */

	        	//$emailadd 	= 	$email;
		  		 $to = $email;

				//  echo $to; exit();

		
				$subject = "Hello ".$fullname.", Your Account has been created successfully on ".$sitename;

				$message ='<tr>
			
					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			
					Hello '.$fullname.',<br><br>

					Thank you for registering to '.$sitename.'. <br> Your password is <strong>'.$sendpass.'</strong><br><br>
					Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br><br>


						Best Regards <br>
						TeamThalassophile <br><br><br>
				
					</td>
		  			
		  			</tr>';

		  		// Always set content-type when sending HTML email

                  $headers = "MIME-Version: 1.0" . "\r\n";

                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                  
                  $headers .= 'From: <admin@teamthalassophile.com>' . "\r\n";
				
				//$mail=  mail($to,$subject,$message,$headers);


				smtp_mailer($to,$subject,$message);  //gmail smtp 

		

				  
			 //Email For Admin


				$to2="admin@teamthalassophile.com";
			//	$to2="itsupport@bridgeviewmaritime.com";
				$subject2 = "Hello Admin, New Jobseeker Account has been created by $fullname successfully on ".$sitename;
				$message2='<tr>

					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			
					Hello Admin,<br /><br />

					A new user recently created his account on our website '.$sitename.'. Here is the complete Details:<br/><br/>
					Name: '.$fullname.'<br/>
					Email ID: '.$email.'<br/>
					Country: '.$country.'<br/><br/>			
			
					</td>
		  
		  			</tr>';

				//mail($to2,$subject2,$message2,$headers);
				

				//sendmail($admin_emaildemo_1,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				//sendmail($admin_emaildemo_2,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				//sendmail($admin_emaildemo_3,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);


				/* Send Email To Admin */
	
			/*	$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Dear User, you have successfully register with us.
				<p style="color:red";> We have sent a verification link to your registered email id.</p><strong>
				Please validate your account.</strong> Please check your <strong>spam/junk folder</strong> also. </div>';
            */

				$_SESSION["GTMsgtoUser"] = '<div class="card text-white bg-secondary mb-3" style="max-width: 68rem;background-color:#1add9980;padding:10px;text-align: center; margin-bottom: 20;">
		    	<div class="card-header"><i  style="font-size: 39px;color: #0047abeb; " class="fa fa-envelope" aria-hidden="true"></i></div>
				<div class="card-body">
				<h5 class="card-title" style="color:white;">Dear User, you have successfully register with us.</h5>
				        <h5 class="card-title" style="color:white;">Please validate your account.</h5>
				<h5 class="card-title">We have sent a verification link to your <strong>registered email id.</strong> Please check your 
				  <strong> Inbox/ Spam/ Junk / All Mail/ folder</strong> also.</h5>
				 
				</div>
			    </div>';
	
			
			
			
			
				unset($_SESSION['myForm']);
				
				$_SESSION["GTmobileReg"] = $email;
				
				echo "<script>document.location.href='".$baseurl."jobseekers-login.php'</script>";
				exit;
	
			}
			else
			{
	
				$gt_msgerror ='<div id="rws-formfeedback">This Email ID already exists. Please use another email id for registration. </div>';
	
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


<!--   Email ID already exists to our database. Please use another email id for registration.   -->


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
			height: 250px !important; 
    		overflow-y: auto !important;
    		width:100% !important;
		}


	.nice-select { width:100% !important; }

</style>

</head>
<body>


<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Jobseeker - Create Your Profile</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Jobseeker - Create Your Profile</a>
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
                		<h1 class="mtitle">Register Now</h1>
                        <div class="rws-mcontent">  
                            <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                            <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
                             
								<div class="rws-fields">
									<label> Select CV Category</label>   
								<select name="cv_category"  id="cv_category" class="selectheight">	
									<option value="">--Select CV Category--</option>													
									<option value="Marine">For Marine Jobs</option>
									<option value="Shore">For Shore Jobs</option>
									<option value="Oil and Gas">For Oil and Gas Jobs</option>						
								</select>
	                            </div>                   
							
																										
							    <div class="rws-fields">
                                	<label>Enter Your Full Name</label>
                                    <input type="text" name="fullname" id="fullname" value="<?php echo $_SESSION['myForm']['fullname']; ?>" placeholder="*Your Fullname" required />
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
                                	<label>DOB</label>
                                    <input type="date" name="dateofbirth" id="dateofbirth" value="<?php echo $_SESSION['myForm']['dateofbirth']; ?>" placeholder="*DOB" required />
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

                    
                                </div> <br>
        <!----start----------------------------------------tanuja code------------------------>
        						<!-- <div class="rws-fields">
                                	<label>Select CV</label>
                                    <input type="file" name="resume" id="resume" value="<?php echo $_SESSION['myForm']['resume']; ?>" placeholder="*choose file" required />
                                </div>   -->

                         <div class="rws-fields">
                        	<label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
                            <input type="file" name="resume" id="resume" accept="application/msword,application/pdf" />
                            <?php if(!empty($_SESSION['myForm']['resume'])) { echo '<p><a href="'.$baseurl.$_SESSION['myForm']['resume'].'" title="View" target="_blank">Download Resume</a></p>';} ?>
                        </div>   

                         
                             <div class="rws-fields">
                             	<label> Rank Categories</label>   
							<select name="rank_cat"  id="rank_cat" class="selectheight">	
							    <option value="">--Select Category--</option>													
								<option>MARINE</option>
								<option value="Rigs">RIGS/DRILLING RIGS</option>
								<option>OFFSHORE</option>		
								<option>SHORE</option>				
							</select>                      
                          

						  <div class="rws-fields">
							  <label class="rws-flabel"><span>*</span>Present Rank</label>    <br> 
								
								<select name="prank" id="prank">   
												
									<option value="">--Select Present Rank--</option>
																	
								</select> 
						  </div>     

						  <div class="rws-fields">
							  <label class="rws-flabel"><span>*</span>Applied Rank</label>    <br> 
								
								<select name="arank" id="arank">   
												
									<option value="">--Select Applied Rank--</option>
																	
								</select> 
						  </div>     

		                        
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


                                <div class="rws-fields"> &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="termsofuse" id="termsofuse" value="1" required="required" <?php if($_SESSION['myForm']['termsofuse']==1) { echo 'checked="checked"'; } else { } ?> /> Are you agree with our <a href="terms-and-conditions.php" target="_blank">terms and conditions</a>?
                                </div>


                                             
                                <div class="rws-fields text-center">
                                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Register" class="rwsbutton width_100" />
                                </div>   
                                
                               <p>Already have an Account? <a href="<?php echo $baseurl;?>jobseekers-login.php">Log In</a></p>
                            </form>
                        </div>
                    </div>
                    <!-- Module Ends -->
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- ./wrapper -->





<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>

  $.widget.bridge('uibutton', $.ui.button);

</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/raphael/raphael.min.js"></script>

<script src="bower_components/morris.js/morris.min.js"></script>

<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="bower_components/moment/min/moment.min.js"></script>

<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/pages/dashboard.js"></script>

<script src="dist/js/demo.js"></script>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>






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


<script>

$("#rank_cat").change(function(){

    var cat=$(this).val();

//	alert(cat);

    var action="rankrequest";

    $.ajax({

        method : "POST",

        data : {cat:cat,action:action},

        url  : "jobseeker_register_ajax.php",

        success:function(result){

 //        alert(result);

           $("#prank").html(result);

		   $("#arank").html(result);

        }

    });

 });

</script>