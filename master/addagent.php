<?php include('header.php');
$gtpage = 'candidate_approve';
$listjs = 1;

// include("./includes/config.php");
include("./includes/config.php");

$rwspagevar = "registerjobseeker";
tocheckloginstate();

//include_once 'securimage/securimage.php';

//$securimage = new Securimage();

$_SESSION['myForm'] = "";
$gt_msgerror = "";
if (isset($_POST["rwsformsubmit"])) {
  $_SESSION['myForm'] = $_POST;

  if (empty($_POST['firstname'])) {
    $errors[] = "Please fill out the firstname field.";
  }
  if (empty($_POST['lastname'])) {
    $errors[] = "Please fill out the lastname field.";
  }

  if (empty($_POST['company'])) {
    $errors[] = "Please fill out the company field.";
  }

  if (empty($_POST['rwsusername'])) {
    $errors[] = 'Email ID field can\'t be blank!';
  }

  if (empty($_POST['rwspassword'])) {
    $errors[] = "Please fill out the password field.";
  } else {

    $uppercase = preg_match('@[A-Z]@', $_POST['rwspassword']);
    $lowercase = preg_match('@[a-z]@', $_POST['rwspassword']);
    $number    = preg_match('@[0-9]@', $_POST['rwspassword']);
    $specialChars = preg_match('@[^\w]@', $_POST['rwspassword']);

    if (strlen($_POST['rwspassword']) < 8) {
      $errors[] = 'Password must be at least 8 characters long!';
    }

    if (!$uppercase || !$lowercase || !$number || !$specialChars) {
      $errors[] = $_POST['rwspassword'] . ' Password should include at least one upper case letter, at least one lower case letter, one number, and one special character.';
    }
    /*
		if(strlen($_POST['rwspassword']) < 6) { $errors[]='Password must be at least 6 characters long!'; } 
		
		if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{8,20}$/',$_POST['rwspassword'])) {
$errors[]="Password must contain at least one uppercase letter (A to Z), one lowercase letter (a to z), and one numeric number (0 to 9)";
}*/
  }

  if (empty($_POST['rwscpassword'])) {
    $errors[] = "Please fill out the confirm password field.";
  } else {
    if ($_POST['rwspassword'] != $_POST['rwscpassword']) {
      $errors[] = 'Confirm password does not match?';
    }
  }


  if (empty($_POST['country'])) {
    $errors[] = "Please fill out the country field.";
  }

  if (empty($_POST['termsofuse'])) {
    $errors[] = "Please select terms and conditions field.";
  }


  if (empty($errors)) {
    
      if (isUnique("email", $_POST['rwsusername'], "ss_agent")) {

        $firstname      = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $company      = $_POST["company"];
        $email         = $_POST["rwsusername"];
        $mobile        = $_POST["mobile"];
        $website        = $_POST["website"];
        $password       = md5($_POST["rwspassword"]);
        $sendpass       = $_POST["rwspassword"];
        $country      = $_POST["country"];
        $termsofuse      = $_POST["termsofuse"];


        /* Insert Code to Database */
        $query_insert = "INSERT INTO `ss_agent` SET firstname = '$firstname', lastname = '$lastname', mobile = '$mobile', email = '$email', password = '$password', company = '$company', website = '$website', country = '$country', termsofuse = '$termsofuse', status = '1', validate = '0', approval = '0', mstatus = '0', add_date = '$gtcurrenttime'";

        // echo $query_insert;exit;

        $query = mysqli_query($db, $query_insert);


        $update_result = $db->query($query_insert);


        $userid = $db->getLastId();


        $validateid = base64_encode("SS-" . $userid);

        /* Send SMS to User */

        // $textmsg2 = 'Dear '.$firstname.', Thank you for registering with JobSEAkers. Your password is '.$verificationcode;

        // $usermobile2 = $mobile;

        //sendsms($usermobile2,$textmsg2);

        $activeurl = $baseurl . "agent-validate.php?vid=" . str_replace('=', 'rEN', $validateid);

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






        $_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Dear User, you have successfully register with us. We have sent a verification link to your registered email id. <strong>Please validate your account.</strong> Please check your <strong>spam/junk folder</strong> also. </div>';

        unset($_SESSION['myForm']);

        $_SESSION["GTmobileReg"] = $email;

        echo "<script>document.location.href='" . $baseurl . "agent-list.php'</script>";
        exit;
      } else {

        $gt_msgerror = '<div id="rws-formfeedback">Email ID already exists to our database. Please use another email id for registration. </div>';

        $json['proceed'] = '0';
        $json['info'] = $gt_msgerror;
      }
    
  } else {
    if (!empty($errors)) {
      $gt_msgerror = '<div id="rws-formfeedback"><b><font size="4">WHOOPS! Please review the following issues:</font></b><ul>';
      foreach ($errors as $msg) { //prints each error
        $gt_msgerror .= "<li>$msg</li>";
      } // end of foreach
      $gt_msgerror .= '</ul></div>';
    }
  }
}



?>

<style>
  .captchaa {
    background-image: url(images/captchaaa.png) !important;
  }

  .list {

    height: 300px !important;
    overflow-y: auto !important;
  }

  .nice-select {
    width: 100% !important;
  }
</style>



<div class="wrapper row-offcanvas row-offcanvas-left">

  <!-- Left side column. contains the logo and sidebar -->

  <?php include('sidebar.php'); ?>



  <!-- Right side column. Contains the navbar and content of the page -->

  <aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Add Agent

        <small></small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add Agent</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12"><!-- /.box -->


          <!-----------------load model------------------------------------------------->
          <style>
            @media (min-width: 768px) {
              .modal-dialog {
                width: 60%;
                margin: 30px auto;
              }
            }
          </style>
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

            <div class="modal-dialog" style="width: 60%; margin:30px auto;" role="document">

              <div class="modal-content">

                <div class="modal-header">

                  <!-- <h5 class="modal-title" id="exampleModalLongTitle" align="center" style="font-size: 30px;">RESUME</h5> -->

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                  </button>

                </div>

                <div class="modal-body">



                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                </div>

              </div>

            </div>

          </div>
          <!-------------------end model---------------------------------------------->

          <?php if (!empty($msg)) { ?>

            <div id="gt-formsuccess">

              <?php echo $msg; ?>

            </div>

          <?php } ?>


          <div class="rws-userpages">
            <div class="rws-userpagesinner">
              <div class="container">
                <h1>Agent - Create Your Profile</h1>
              </div>
            </div>
          </div>

          <div class="rws-breadcrumbs">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <a href="<?php echo $baseurl; ?>">Home</a>
                  <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                  <a href="javascript:void(0)">Agent - Create Your Profile</a>
                </div>
              </div>
            </div>
          </div>


          <div class="rws-maincontentinner">
            <div class="container">
              <div class="row">
                <div class="">
                  <div class="rws-maincontentinn">
                    <div class="rws-module">
                      <h3 class="mtitle">Register Now</h3>
                      <div class="rws-mcontent">
                        <?php echo $gt_msgerror;
                        if (isset($_SESSION["GTMsgtoUser"])) {
                          echo $_SESSION["GTMsgtoUser"];
                          unset($_SESSION["GTMsgtoUser"]);
                        } ?>
                        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">


                          <div class="row">
                            <div class="col-md-4">
                              <label>Firstname</label>
                              <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $_SESSION['myForm']['firstname']; ?>" placeholder="*Firstname" required />
                            </div>

                            <div class="col-md-4">
                              <label>Lastname</label>
                              <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $_SESSION['myForm']['lastname']; ?>" placeholder="*Lastname" required />
                            </div>

                            <div class="col-md-4">
                              <label>Company</label>
                              <input type="text" name="company" id="company" class="form-control" value="<?php echo $_SESSION['myForm']['company']; ?>" placeholder="*Company" required />
                            </div>

                            <div class="col-md-4">
                              <label>Email ID</label>
                              <input type="email" name="rwsusername" id="rwsusername" class="form-control" value="<?php echo $_SESSION['myForm']['rwsusername']; ?>" placeholder="*Email ID" required />
                            </div>
                            <div class="col-md-4">
                              <label>Mobile</label>
                              <input type="number" name="mobile" id="mobile" class="form-control" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="*Mobile" required />
                            </div>
                            <div class="col-md-4">
                              <label>Website</label>
                              <input type="text" name="website" id="rwsusername" class="form-control" value="<?php echo $_SESSION['myForm']['website']; ?>" placeholder="*Website" required />
                            </div>
                             <div class="col-md-4">
                              <label>Password</label>
                              <input type="password" name="rwspassword" id="rwspassword" class="form-control" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required />
                          </div>

                          <div class="col-md-4">
                            <label>Confirm Password</label>
                            <input type="password" name="rwscpassword" id="rwscpassword" class="form-control" value="<?php echo $_SESSION['myForm']['rwscpassword']; ?>" placeholder="*Confirm Password" required />
                          </div>

                          <div class="col-md-4">
                            <label>Select Country</label><br />

                            <?php

                            //   $db = new database("sg2nlmysql41plsk.secureserver.net:3306","teamthalassophil","Ausea#123","teamthalassophil");

                            //   if ($db->connect_error) {

                            //   die("Connection failed: " . $db->connect_error);

                            //   }

                            //  echo "Connected successfully";

                            $country = "select * from ss_countries  where country!='' GROUP BY country order by country ASC";

                            $result = $db->query($country);
                            $rowlist = $result->rows;
                            ?>

                            <select name="country" class="form-control">
                              <option selected>-- Select Country --</option>

                              <?php
                              foreach ($rowlist as $key => $row) {
                                echo "<option  value='" . $row['country'] . "'>" . $row['country'] . "</option>";
                              }
                              ?>

                            </select>

                          </div>

                          
                      </div>
                      <div class="row">

                        <div class="col-md-4">
                          <input type="checkbox" name="termsofuse" id="termsofuse" value="1" required="required" <?php if ($_SESSION['myForm']['termsofuse'] == 1) {
                                                                                                                    echo 'checked="checked"';
                                                                                                                  } else {
                                                                                                                  } ?> />
                          Are you agree with our <a href="terms-and-conditions.php" target="_blank">terms and conditions</a>?
                        </div>
                        </div>
                      <div class="row">

                        <div class="col-md-4">
                          <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Register" class="rwsbutton width_100" />
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




      </div>
</div>
</section>


<footer>

  <?php include('footer-copyright.php'); ?>

</footer>

</aside><!-- /.right-side -->

</div><!-- ./wrapper -->

<?php include('footer.php'); ?>

<script type="text/javascript">
  //Javascript Captcha validation


</script>

