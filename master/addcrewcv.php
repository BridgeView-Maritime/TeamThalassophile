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

  if (empty($_POST['fullname'])) {
    $errors[] = "Please fill out the fullname field.";
  }

  // if (empty($_POST['cv_category'])) {
  //   $errors[] = "Please select the cv_category field.";
  // }
  /*if(empty($_POST['mobile']) ) { $errors[]="Please fill out the Mobile field."; } 
	else if(!is_numeric($_POST['mobile'])) { $errors[]="Mobile number should be numeric only."; }
	else if(strlen($_POST['mobile'])!=10) { $errors[]="Mobile Number should be 10 digits."; }*/

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

  /*    ------start-----------tanuja code--------------------------------*/

  //if (empty($_POST['category']) ) 	{	$errors[]="Please fill out the category field.";	}

  /*    --------end---------tanuja code--------------------------------*/

  if (empty($_POST['termsofuse'])) {
    $errors[] = "Please select terms and conditions field.";
  }


  if (empty($errors)) {

    
      if (isUnique("email", $_POST['rwsusername'], "ss_jobseekers")) {


        $cv_category         = $_POST["cv_category"];
        $fullname      = $_POST["fullname"];
        $email         = $_POST["rwsusername"];
        $mobile        = $_POST["mobile"];
        $password       = md5($_POST["rwspassword"]);
        $sendpass       = $_POST["rwspassword"];
        $dateofbirth    = $_POST["dateofbirth"];
        $country      = $_POST["country"];
        $termsofuse      = $_POST["termsofuse"];
        //$resume			    = $_POST["resume"];
        $rank_cat      = $_POST["rank_cat"];
        $prank          = $_POST["prank"];
        $arank          = $_POST["arank"];
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

        $resume = time() . $_FILES['resume']['name'];

        $temp =  $_FILES['resume']['tmp_name'];

        $cvname = "usercvdata/$resume";

        move_uploaded_file($temp, "usercvdata/$resume");


        //$resumeurl = 'usercvdata/'.$resume.'/';
        //move_uploaded_file ($fileThumbnail, $add_thumbnail);		

        /* Insert Code to Database */
        $query_insert = "INSERT INTO `ss_jobseekers` SET  cv_category ='$cv_category',fullname ='$fullname', mobile = '$mobile', email = '$email', password = '$password', dateofbirth ='$dateofbirth', country_code = '$country', resume = '$cvname', rank_cat = '$rank_cat', rankname = '$prank',applied_rank='$arank', termsofuse = '$termsofuse', profile_display = 'Yes', profile_access = 'Yes', contact_access = 'Yes', contact_directly = 'Yes', view_certificates = 'Yes', view_certificates_need_approval = 'Yes', status = '1', validate = '0', mstatus = '0', add_date = '$gtcurrenttime'";

        //echo $query_insert;exit;

        //		$query=mysqli_query($db,$query_insert);



        $update_result = $db->query($query_insert);


        $userid = $db->getLastId();


        $validateid = base64_encode("SS-" . $userid);




        /* Send SMS to User */

        //	$textmsg2 = 'Dear '.$firstname.', Thank you for registering with Optimo Cards. Your password is '.$verificationcode;

        //	$usermobile2 = $mobile;

        //sendsms($usermobile2,$textmsg2);

        $activeurl = $baseurl . "jobseekers-validate.php?vid=" . str_replace('=', 'rEN', $validateid);

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
        

    





        unset($_SESSION['myForm']);

        $_SESSION["GTmobileReg"] = $email;

        echo "<script>document.location.href='" . $baseurl . "candidate_approve.php'</script>";
        exit;
      } else {

        $gt_msgerror = '<div id="rws-formfeedback">This Email ID already exists. Please use another email id for registration. </div>';

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

  .country {
    width: 60px;
  }

  .number {
    display: flex;
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

        Add Candidate

        <small></small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add Candidate</li>

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
                <h1>Candidate - Create Your Profile</h1>
              </div>
            </div>
          </div>

          <div class="rws-breadcrumbs">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <a href="<?php echo $baseurl; ?>">Home</a>
                  <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                  <a href="javascript:void(0)">Candidate - Create Your Profile</a>
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
                              <label> Rank Categories</label>
                              <select name="rank_cat" id="rank_cat" class="wide form-control">
                                <?php
                                echo "<option value = ''>--Select--</option>";
                                fetch_category($getCat);
                                ?>
                              </select>
                            </div>

                            <div class="col-md-4">
                              <label class="rws-flabel"><span>*</span>Present Rank</label> <br>

                              <select name="prank" id="prank" class="wide form-control">

                                <option value="">--Select Present Rank--</option>

                              </select>
                            </div>

                            <div class="col-md-4">
                              <label class="rws-flabel"><span>*</span>Applied Rank</label> <br>

                              <select name="arank" id="arank" class="wide form-control">

                                <option value="">--Select Applied Rank--</option>

                              </select>
                            </div>

                            <div class="col-md-4">
                              <label>Enter Your Full Name</label>
                              <input type="text" name="fullname" id="fullname" class="wide form-control" value="<?php echo $_SESSION['myForm']['fullname']; ?>" placeholder="*Your Fullname" required />
                            </div>
                            <div class="col-md-4">
                              <label>Email ID</label>
                              <input type="email" name="rwsusername" id="rwsusername" class="wide form-control" value="<?php echo $_SESSION['myForm']['rwsusername']; ?>" placeholder="*Email ID" required />
                            </div>
                            <div class="col-md-4">
                              <label>Password</label>
                              <input type="password" name="rwspassword" id="rwspassword" class="wide form-control" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required />
                            </div>
                            <div class="col-md-4">
                              <label>Confirm Password</label>
                              <input type="password" name="rwscpassword" id="rwscpassword" class="wide form-control" value="<?php echo $_SESSION['myForm']['rwscpassword']; ?>" placeholder="*Confirm Password" required />
                            </div>

                            <div class="col-md-4">
                              <label>DOB</label>
                              <input type="date" name="dateofbirth" id="dateofbirth" class="wide form-control" value="<?php echo $_SESSION['myForm']['dateofbirth']; ?>" placeholder="*DOB" required />
                            </div>

                            <div class="col-md-4">
                              <label>Phone Number</label><br />

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
                              <div class="number">
                                <select name="country" class="wide form-control country">
                                  <option selected>-- Select Country --</option>

                                  <?php
                                  foreach ($rowlist as $key => $row) {
                                    echo "<option  value='" . $row['phonecode'] . "'>" . $row['country'] . "</option>";
                                  }
                                  ?>

                                </select>
                                <div style="width: 100%;">
                                  <input type="number" name="mobile" id="mobile" class="wide form-control" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="*Phone" required />
                                </div>
                              </div>

                            </div>


                          </div>

                          <div class="row">

                            <div class="col-md-4">
                              <label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
                              <input type="file" name="resume" id="resume" accept="application/msword,application/pdf" class="wide form-control" />
                              <?php if (!empty($_SESSION['myForm']['resume'])) {
                                echo '<p><a href="' . $baseurl . $_SESSION['myForm']['resume'] . '" title="View" target="_blank">Download Resume</a></p>';
                              } ?>
                            </div>
                          </div>
                          <div class="row">

                            <div class="col-md-4">
                              <input type="checkbox" name="termsofuse" id="termsofuse" value="1" required="required" <?php if ($_SESSION['myForm']['termsofuse'] == 1) {
                                                                                                                        echo 'checked="checked"';
                                                                                                                      } else {
                                                                                                                      } ?> /> Are you agree with our <a href="terms-and-conditions.php" target="_blank">terms and conditions</a>?
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

<script>
  // var cat="<?php echo $_GET['category_3']; ?>";
  // var rank="<?php echo $_GET['prank']; ?>";

  // // alert("cat - "+cat +" " +rank);
  // // alert(cat +" "+ rank);
  // function load_filter(cat,rank){
  // // alert(cat+ " " +rank);
  // var action="rankrequest";


  // $.ajax({
  //     method  : "POST",
  //     data    : {action:action, cat:cat, rank:rank},
  //     url     : "search_result_jobs_ajax.php",
  //     success:function(result){

  //     $("#prank").html(result);
  //     $("#arank").html(result);
  //     // console.log(result);
  //     }
  // });
  // }


  // load_filter(cat,rank);



  // $(document).on("change","#category_3",function(){

  //   var cat=$(this).val();
  //   var rank="";
  //   load_filter(cat,rank);

  // });


  $("#rank_cat").change(function() {

    var cat = $(this).val();

    //	alert(cat);

    var action = "rankrequest";

    $.ajax({

      method: "POST",

      data: {
        cat: cat,
        action: action
      },

      url: "candidate_approve_ajax.php",

      success: function(result) {

        //        alert(result);

        $("#prank").html(result);

        $("#arank").html(result);

      }

    });

  });
</script>