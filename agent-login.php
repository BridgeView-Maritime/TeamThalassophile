<?php include("includes/config.php");
$rwspagevar = "registerjobseeker";
tocheckloginstate();

unset($_SESSION["USER"]);
unset($_SESSION["AGN"]);

$_SESSION['myForm'] = "";
$gt_msgerror = "";
if (isset($_POST["rwsformsubmit"])) {
  $_SESSION['myForm'] = $_POST;

  if (empty($_POST['rwsusername'])) {
    $errors[] = 'Email ID field can\'t be blank!';
  }

  if (empty($_POST['rwspassword'])) {
    $errors[] = "Please fill out the password field.";
  }

  if (empty($errors)) {

    $rwsusername  =  $db->escape($_POST['rwsusername']);
    $rwspassword  =  md5($_POST['rwspassword']);
    $rwsusertype  =  $_POST['rwsusertype'];

    $query_1 = "SELECT * FROM `ss_agent` WHERE `email`='$rwsusername' AND `password`='$rwspassword'";
    $findnum_1 = togetnumrows($query_1);

    $query_2 = "SELECT t1.*, t2.mobile, t2.logo, t2.country, t2.company, t2.coverpic, t2.email as agn_email, t2.firstname as agn_firstname, t2.lastname as agn_lastname FROM ss_employer_manager as t1 INNER JOIN ss_agent as t2 ON t1.emp_id=t2.id WHERE t1.email='$rwsusername' AND t1.password='$rwspassword'";

    $findnum_2 = togetnumrows($query_2);

    if ($findnum_1 > 0) {
      $query_login = $query_1;
    } else {
      $query_login = $query_2;
    }
    //echo $query_login;
    $result = $db->query($query_login);
    $numrows = $result->num_rows;

    if ($numrows > 0) {
      $row = $result->row;

      if ($row["status"] == 0) {
        $gt_msgerror = '<div id="rws-formfeedback">Sorry! Your Account has been temporarily suspend Please call us immediately on ' . $admin_support_mobile . '.</div>';
      } elseif ($row["validate"] == 0) {
        $jsid       = $row["id"];
        $firstname     = $row["firstname"];

        $validateid = base64_encode("SS-" . $jsid);

        $activeurl = $baseurl . "agent-validate.php?vid=" . str_replace('=', 'rEN', $validateid);

        /* Email Verification Code */
        $subject = "Hello $firstname, Validate your account on " . $sitename;
        $body = $emailheader . '
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello ' . $firstname . ',<br /><br />
			Be sure to <a href="' . $activeurl . '">validate your profile</a> in order to make applying to jobs even easier!<br/><br/><br/><br/>
			</td>
		  </tr>	  
		  ' . $emailfooter;

        sendmail($email, $subject, $admin_fromemail, $admin_fromname, $body, $path, $resumefilename);

        $gt_msgerror = '<div id="rws-formattention">Sorry! Your Account has not validated. We have sent a validation link to your registered email id. Please check and validate your account.</div>';
      } elseif ($row["approval"] == 0) {

        $jsid       = $row["id"];
        $firstname     = $row["firstname"];

        $validateid = base64_encode("SS-" . $jsid);

        $activeurl = $baseurl . "agent-approval.php?vid=" . str_replace('=', 'rEN', $validateid);

        // echo $activeurl;
        // exit;
        /* Email Verification Code */
        $subject = "Hello $firstname, Approve your account on " . $sitename;
        $body = $emailheader . '
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello ' . $firstname . ',<br /><br />
			Be sure to <a href="' . $activeurl . '">approve your profile</a> in order to make applying to jobs even easier!<br/><br/><br/><br/>
			</td>
		  </tr>	  
		  ' . $emailfooter;

        // sendmail($email, $subject, $admin_fromemail, $admin_fromname, $body, $path, $resumefilename);

        $gt_msgerror = '<div id="rws-formattention">Sorry! Your Account has not Approved. Your account is under process, please wait admin approval</div>';
      } else {
        if ($findnum_2 > 0) {
          $_SESSION["AGN"]['ID']          =  $row["emp_id"];
          $_SESSION["AGN"]['SubType']        =  $row["role"];
          $_SESSION["AGN"]['MID']          =  $row["id"];
        } else {
          $_SESSION["AGN"]['ID']          =  $row["id"];
          $_SESSION["AGN"]['SubType']        =  "SuperAdmin";
        }

        $_SESSION["AGN"]['Firstname']      =  $row["firstname"];
        $_SESSION["AGN"]['Lastname']      =  $row["lastname"];
        $_SESSION["AGN"]['Email']        =  $row["email"];
        $_SESSION["AGN"]['Mobile']        =  $row["mobile"];
        $_SESSION["AGN"]['Picture']        =  $row["logo"];
        $_SESSION["AGN"]['Country']        =  $row["country"];
        $_SESSION["AGN"]['Company']        =  $row["company"];

        $_SESSION["AGN"]['Type']        =  "Agent";

        $_SESSION["AGN"]['GTUserProfileID']    =  $row["oauth_uid"];
        $_SESSION["AGN"]['GTUserLoginFrom']    =  $row["oauth_provider"];
        $_SESSION["AGN"]['GTUserphotograph']  =  $row["logo"];
        $_SESSION["AGN"]['GTUsercover']      =  $row["coverpic"];

        if ($_POST["remember_me"] == 1) {
          // generate cooked of username and password
          setcookie("RWSSSUsername", $_POST['rwsusername']);
          setcookie("RWSSSPassword", $_POST['rwspassword']);
          setcookie("RWSSSSelected", 1);
        } else {
          setcookie("RWSSSUsername", "");
          setcookie("RWSSSPassword", "");
          setcookie("RWSSSSelected", 0);
        }

        $_SESSION['GTUserCurrentLogin']    =  $gtcurrenttime;

        if ($findnum_2 == 0) {
          $query_update_logintime = "UPDATE `ss_agent` SET `last_login` = '$gtcurrenttime' WHERE `id` =" . $row["id"];
        } else {
          // $query_update_logintime = "UPDATE `ss_employer_manager` SET `last_login` = '$gtcurrenttime' WHERE `id` =".$row["id"];
        }

        //echo $query_update_logintime;


        $result_logintime = $db->query($query_update_logintime);

        unset($_SESSION['myForm']);

        echo "<script>document.location.href='" . $baseurl . "agent-vacancy-list.php'</script>";
        // echo "last testing";exit;
        // header("Location:agent-dashboard.php");
        exit;
      }
    } else {
      $gt_msgerror = '<div id="rws-formfeedback">The email id and password you entered do not match.</div>';
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


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="<?php echo $baseurl; ?>images/favicon.png">
<title>Team Thalassophile !</title>
<link href="<?php echo $baseurl; ?>css/global.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="<?php echo $baseurl; ?>css/style.css" rel="stylesheet">
<link href="<?php echo $baseurl; ?>css/responsiveness.css" rel="stylesheet">


<div class="rws-userpages">
  <div class="rws-userpagesinner">
    <div class="container">
      <h1>Agent Login</h1>
    </div>
  </div>
</div>

<div class="rws-breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <a href="<?php echo $baseurl; ?>">Home</a>
        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
        <a href="javascript:void(0)">Agent Login</a>
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
              <?php echo $gt_msgerror;
              if (isset($_SESSION["GTMsgtoUser"])) {
                echo $_SESSION["GTMsgtoUser"];
                unset($_SESSION["GTMsgtoUser"]);
              } ?>
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
                    <div class="col-xs-5"><a href="<?php echo $baseurl; ?>agent-register.php">Signup</a></div>
                    <div class="col-xs-7 textright"><a href="<?php echo $baseurl; ?>agent-forget-password.php">Forgot Password?</a></div>
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