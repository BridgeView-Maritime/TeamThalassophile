<?php include("includes/config.php");
$gtpage = "Agent-Post-Candidate";
$gtjqueryui = "Yes";
$gtckeditor = "Yes";

checkagentlogin();
checkagentloginrole("Admin");
unset($_SESSION['myForm']);

if (isset($_POST["rwsformsubmit"])) {
	$_SESSION['myForm'] = $_POST;

	if (empty($_POST['fullname'])) {
		$errors[] = "Please fill out the first name field.";
	}
	// if (empty($_POST['lastname'])) {
	// 	$errors[] = "Please fill out the last name field.";
	// }
	if (empty($_POST['email'])) {
		$errors[] = "Please fill out the email field.";
	}
	// if (empty($_POST['country_code'])) {
	// 	$errors[] = "Please fill out the country_code field.";
	// }
	if (empty($_POST['mobile'])) {
		$errors[] = "Please fill out the mobile field.";
	}
	if (empty($_POST['dateofbirth'])) {
		$errors[] = "Please fill out the dateofbirth field.";
	}
	if (empty($_POST['country'])) {
		$errors[] = "Please fill out the country field.";
	}



	if (empty($_POST['cv_category'])) {
		$errors[] = "Please fill out the cv_category field.";
	}
	// if (empty($_POST['jobarea'])) {
	// 	$errors[] = "Please fill out the jobtitle field.";
	// }
	// if (empty($_POST['jobtitle'])) {
	// 	$errors[] = "Please fill out the jobtitle field.";
	// }
	// if (empty($_POST['company_name'])) {
	// 	$errors[] = "Please fill out the company nmae field.";
	// }
	//if (empty($_POST['job_type']) ) 		{	$errors[]="Please fill out the job type field.";		}
	//if (empty($_POST['ship_type']) ) 		{	$errors[]="Please fill out the ship type field.";		}	


	// if (empty($_POST['currency'])) {
	// 	$errors[] = "Please fill out the currency field.";
	// }
	// if (empty($_POST['period'])) {
	// 	$errors[] = "Please fill out the period field.";
	// }
	// if (empty($_POST['salary'])) {
	// 	$errors[] = "Please fill out the end date field.";
	// }
	// if (empty($_POST['area_of_operation'])) {
	// 	$errors[] = "Please fill out the start year field.";
	// }
	// if (empty($_POST['experience'])) {
	// 	$errors[] = "Please fill out the experience field.";
	// }
	// if (empty($_POST['contract'])) {
	// 	$errors[] = "Please fill out the contract field.";
	// }
	// if (empty($_POST['vessel'])) {
	// 	$errors[] = "Please fill out the vessel field.";
	// }
	// if (empty($_POST['description'])) {
	// 	$errors[] = "Please fill out the description field.";
	// }
	// if (empty($_POST['end_date'])) {
	// 	$errors[] = "Please fill out the approximate joining field.";
	// }
	// if (empty($_POST['person_email'])) {
	// 	$errors[] = "Please fill out the Contact Person Email field.";
	// }



	if (empty($errors)) {

		
		// $agn_id  				=  $_SESSION["AGN"]['ID'] ;
		$fullname 				= addslashes($_POST["fullname"]);
		$email 					= addslashes($_POST["email"]);
		$country_code 			= addslashes($_POST["country_code"]);
		$mobile 				= addslashes($_POST["mobile"]);
		$dateofbirth 			= addslashes($_POST["dateofbirth"]);
		$country 				= addslashes($_POST["country"]);
		$state 					= addslashes($_POST["state"]);
		$city 					= addslashes($_POST["city"]);
		$cv_category 			= addslashes($_POST["cv_category"]);
		$rank 					= addslashes($_POST["rank"]);
		$pre_currency 			= addslashes($_POST["pre_currency"]);
		$pre_period 			= addslashes($_POST["pre_period"]);
		$pre_salary 			= addslashes($_POST["pre_salary"]);
		$exp_currency 			= addslashes($_POST["exp_currency"]);
		$exp_period 			= addslashes($_POST["exp_period"]);
		$exp_salary 			= addslashes($_POST["exp_salary"]);
		// $salary 				= addslashes($_POST["salary"]);
		// $cv 					= addslashes($_POST["cv"]);
		// $cv_path 				= addslashes($_POST["cv_path"]);

		// $category 					= addslashes($_POST["category"]);
		// $jobarea 					= addslashes($_POST["jobarea"]);
		// $jobtitle 					= addslashes($_POST["jobtitle"]);
		// $company_name 				= addslashes($_POST["company_name"]);
		// $currency 					= addslashes($_POST["currency"]);
		// $period 					= addslashes($_POST["period"]);
		// $salary 					= addslashes($_POST["salary"]);
		// $area_of_operation 			= addslashes($_POST["area_of_operation"]);
		// $experience 				= addslashes($_POST["experience"]);
		// $contract 				    = addslashes($_POST["contract"]);
		// $vessel 				    = addslashes($_POST["vessel"]);
		// $description 				= addslashes($_POST["description"]);
		// $end_date 				    = addslashes($_POST["end_date"]);
		//  $end_date 					= tochangedateformat($_POST["end_date"],"DB");
		// $person_email 				= addslashes($_POST["person_email"]);

		/*		$job_type 					= addslashes($_POST["job_type"]);
			$location 					= addslashes($_POST["location"]);			
			$compensation_from 			= addslashes($_POST["compensation_from"]);
			$compensation_to 			= addslashes($_POST["compensation_to"]);
			$benefits 					= addslashes($_POST["benefits"]);
			$how_to_appy 				= addslashes($_POST["how_to_appy"]);
			$skills 					= addslashes($_POST["skills"]);
			
			$person_name 				= addslashes($_POST["person_name"]);
			
			$person_phone 				= addslashes($_POST["person_phone"]);
			$start_date 				= tochangedateformat($_POST["start_date"],"DB");	
			
			
			$ship_type 					= addslashes($_POST["ship_type"]);
			$client 					= addslashes($_POST["client"]);
			
			$salary_terms 				= addslashes($_POST["salary_terms"]);	
			$swing_length 				= addslashes($_POST["swing_length"]);	*/

		$post_id 					= $_POST["post_id"];

		$agn_id 					= $_SESSION["AGN"]['ID'];

		$resume = time() ."_". $_FILES['cv']['name'];

		$temp =  $_FILES['cv']['tmp_name'];

		$cvname = "usercvdata/$resume";

		move_uploaded_file($temp, "usercvdata/$resume");


		/* Update Data To Database */
		if ($post_id > 0) {
			$modify_date 				= $gtcurrenttime;

			$update_query = "UPDATE `ss_agent_candidate` SET fullname = '$fullname', email = '$email', country_code = '$country_code', mobile = '$mobile', dateofbirth = '$dateofbirth', country = '$country',state = '$state', city = '$city', cv_category = '$cv_category', rank = '$rank', pre_currency = '$pre_currency',pre_period = '$pre_period',pre_salary = '$pre_salary', exp_currency = '$exp_currency',exp_period = '$exp_period',exp_salary = '$exp_salary', cv = '$resume', cv_path = '$cvname', `agn_id`=" . $_SESSION["AGN"]['ID'] . ", `job_id`='$post_id'";

			$insert_query = "INSERT into `ss_agent_candidate` SET fullname = '$fullname', email = '$email', country_code = '$country_code', mobile = '$mobile', dateofbirth = '$dateofbirth', country = '$country',state = '$state', city = '$city', cv_category = '$cv_category', rank = '$rank', pre_currency = '$pre_currency',pre_period = '$pre_period',pre_salary = '$pre_salary', exp_currency = '$exp_currency',exp_period = '$exp_period',exp_salary = '$exp_salary', cv = '$resume', cv_path = '$cvname', `agn_id`=" . $_SESSION["AGN"]['ID'] . ", `job_id`='$post_id'";

			$update_result = $db->query($insert_query);
			// echo $insert_query;exit;

			$job_id = $post_id;

			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your candidate has been updated successfully.</div>';
		} else {
			$update_query = "INSERT into `ss_agent_candidate` SET fullname = '$fullname', email = '$email', country_code = '$country_code', mobile = '$mobile', dateofbirth = '$dateofbirth', country = '$country',state = '$state', city = '$city', cv_category = '$cv_category', rank = '$rank', pre_currency = '$pre_currency',pre_period = '$pre_period',pre_salary = '$pre_salary', exp_currency = '$exp_currency',exp_period = '$exp_period',exp_salary = '$exp_salary',  cv = '$resume', cv_path = '$cvname', status = '1',`job_id`='$post_id', `agn_id`=" . $_SESSION["AGN"]['ID'];
			$update_result = $db->query($update_query);
			// echo $update_query;exit;

			$job_id = $db->getLastId();

			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your candidate has been added successfully.</div>';

			// sendmail($admin_emaildemo_1, $subject, $admin_fromemail, $admin_fromname, $body, $path, $resumefilename);
			// sendmail($admin_emaildemo_2, $subject, $admin_fromemail, $admin_fromname, $body, $path, $resumefilename);
			// sendmail($admin_emaildemo_3, $subject, $admin_fromemail, $admin_fromname, $body, $path, $resumefilename);
			/* Send Email To Admin */
		}

		/* Add Multiple Question to Database Code Starts */

		// $db->query("DELETE FROM `ss_employer_jobs_query` WHERE `job_id`='$job_id' AND `emp_id`='$emp_id'");

		// $query 				= $_POST["query"];

		// $i = 0;
		// foreach ($query as $key => $val) {

		// 	if (!empty($query[$i])) {
		// 		$query_insert = "INSERT INTO `ss_employer_jobs_query` SET job_id = '$job_id', emp_id = '$emp_id', query = '" . addslashes($query[$i]) . "', status = '1', sort_order = '0', add_date = '$gtcurrenttime'";

		// 		$update_result = $db->query($query_insert);
		// 	}

		// 	$i++;
		// }

		/* Add Multiple Question to Database Code Ends */

		echo "<script>document.location.href='" . $baseurl . "agent-vacancy-list.php'</script>";
		exit;
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

if (empty($_POST)) {
	$post_id = $_GET["post_id"];
	if ($post_id > 0) {
		$select_query = 'SELECT * FROM `ss_agent_candidate` WHERE agn_id = "' . $_SESSION["AGN"]['ID'] . '"';
		$select_result = $db->query($select_query);
		$rowut = $select_result->row;

		// $_SESSION['myForm']['agn_id'] 		= $_SESSION["AGN"]['ID'];
		// $_SESSION['myForm']['fullname'] 		= stripslashes($rowut["fullname"]);
		// $_SESSION['myForm']['email'] 		= stripslashes($rowut["email"]);
		// $_SESSION['myForm']['country_code'] 		= stripslashes($rowut["country_code"]);
		// $_SESSION['myForm']['mobile'] 		= stripslashes($rowut["mobile"]);
		// $_SESSION['myForm']['dateofbirth'] 		= stripslashes($rowut["dateofbirth"]);
		// $_SESSION['myForm']['country'] 		= stripslashes($rowut["country"]);
		// $_SESSION['myForm']['state'] 		= stripslashes($rowut["state"]);
		// $_SESSION['myForm']['city'] 		= stripslashes($rowut["city"]);
		// $_SESSION['myForm']['cv_category'] 		= stripslashes($rowut["cv_category"]);
		// $_SESSION['myForm']['rank'] 		= stripslashes($rowut["rank"]);
		// $_SESSION['myForm']['pre_currency'] 		= stripslashes($rowut["pre_currency"]);
		// $_SESSION['myForm']['pre_period'] 		= stripslashes($rowut["pre_period"]);
		// $_SESSION['myForm']['pre_salary'] 		= stripslashes($rowut["pre_salary"]);
		// $_SESSION['myForm']['exp_currency'] 		= stripslashes($rowut["exp_currency"]);
		// $_SESSION['myForm']['exp_period'] 		= stripslashes($rowut["exp_period"]);
		// $_SESSION['myForm']['exp_salary'] 		= stripslashes($rowut["exp_salary"]);
		// // $_SESSION['myForm']['salary'] 		= stripslashes($rowut["salary"]);
		// $_SESSION['myForm']['cv'] 		= stripslashes($rowut["cv"]);
		// $_SESSION['myForm']['cv_path'] 		= stripslashes($rowut["cv_path"]);
		// $_SESSION['myForm']['agn_id'] 		= $_SESSION["AGN"]['ID'];

	}
} else {
	// $emptotal = count($_SESSION['myForm']['query']);
}

if (!empty($_GET["post_id"])) {
	$pagetitle = "Update New Job";
} else {
	$pagetitle = "Add New Job";
}

?>


<style>
	.list {
		height: 200px !important;
		overflow-y: auto !important;
		width: 100% !important;
	}


	.nice-select {
		width: 40% !important;
	}

	.country_code {
		width: 60px;
	}

	.number {
		display: flex;
	}
</style>

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

<!-- RWS Header Starts -->
<?php
// include("app/gtheader.php"); 
?>
<!-- RWS Header Starts -->
<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container">
			<h1><?php echo $pagetitle; ?></h1>
		</div>
	</div>
</div>

<div class="rws-breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<a href="<?php echo $baseurl; ?>">Home</a>
				<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
				<a href="javascript:void(0)"><?php echo $pagetitle; ?></a>
			</div>
		</div>
	</div>
</div>
<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
	<div class="" style="padding:0 30px ;">
		<div class="row">
			<div class="col-md-3">
				<?php include("app/agent-leftmenu.php"); ?>
			</div>
			<!-- Left Section Ends -->


			<div class="col-md-8">
				<form action="" method="post" enctype="multipart/form-data" name="agentcandidatepost" id="agentcandidatepost">
					<input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
					<div class="rws-module">
						<div class="mtitle">Post New Job </div>
						<div class="rws-mcontent">
							<?php echo $gt_msgerror;
							if (isset($_SESSION["GTMsgtoUser"])) {
								echo $_SESSION["GTMsgtoUser"];
								unset($_SESSION["GTMsgtoUser"]);
							} ?>

							<div class="row">


								<div class="rws-fields col-lg-6">
									<label class="rws-flabel"><span>*</span> Full Name </label> <br>
									<input type="text" name="fullname" value="<?php echo $_SESSION['myForm']["fullname"]; ?>" required />
								</div>

								<!-- <div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span> Last Name </label> <br>
									<input type="text" name="lastname" value="<?php echo $_SESSION['myForm']["lastname"]; ?>" required />
								</div> -->

								<div class="rws-fields col-lg-6">
									<label class="rws-flabel"><span>*</span> Email </label> <br>
									<input type="email" name="email" value="<?php echo $_SESSION['myForm']["email"]; ?>" required />
								</div>

								<div class="rws-fields col-lg-6">
									<label class="rws-flabel"><span>*</span> Phone Number </label> <br>
									<?php

									$country = "select * from ss_countries  where country!='' GROUP BY country order by country ASC";

									$result = $db->query($country);
									$rowlist = $result->rows;
									?>
									<div class="number">
										<select name="country_code" class="country_code">
											<option selected>-- Select Country --</option>

											<?php
											foreach ($rowlist as $key => $row) {
												echo "<option  value='" . $row['phonecode'] . "'>" . $row['country'] . "</option>";
											}
											?>

										</select>
										<div style="width: 100%;">
											<input type="number" name="mobile" id="mobile" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="*Phone" required />
										</div>
									</div>

								</div>

								<div class="rws-fields col-lg-6">
									<label class="rws-flabel"><span>*</span> DOB </label> <br>
									<input type="date" name="dateofbirth" id="dateofbirth" value="<?php echo $_SESSION['myForm']['dateofbirth']; ?>" required />
								</div>
								<br>

								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span> Country </label> <br>
									<?php

									$country = "select * from ss_countries  where country!='' GROUP BY country order by country ASC";

									$result = $db->query($country);
									$rowlist = $result->rows;
									?>
									<div class="">
										<select name="country" id="country" class="">
											<option selected>-- Select Country --</option>

											<?php
											foreach ($rowlist as $key => $row) {
												echo "<option  value='" . $row['id'] . "'>" . $row['country'] . "</option>";
											}
											?>

										</select>
									</div>

								</div>


								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span> State</label> <br>

									<select name="state" id="state">

										<option value="">--Select State--</option>

									</select>
								</div>

								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span> City</label> <br>

									<!-- <select name="city" id="city">

										<option value="">--Select city--</option>

									</select> -->
									<input type="text" name="city" id="city" value="<?php echo $_SESSION['myForm']['city ']; ?>" placeholder="*City" required />
								</div>

								<div class="rws-fields col-lg-6">

									<label class="rws-flabel"><span>*</span> Rank Categories</label> <br>
									<select name="cv_category" id="cv_category" class="">
										<option value=''>--Select--</option>
										<?php

										fetch_category($getCat);
										?>
									</select>
								</div>


								<div class="rws-fields col-lg-6">
									<label class="rws-flabel"><span>*</span> Present Rank</label> <br>

									<select name="rank" id="rank">

										<option value="">--Select Present Rank--</option>

									</select>
								</div>


								<label class="rws-flabel">Previous Salary</label>
								<br>
								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span>Currency</label> <br>
									
									<?php

									$currency = "select * from ss_currency  where currency_name!='' GROUP BY currency_name order by currency_name ASC";

									$result = $db->query($currency);
									$rowlist = $result->rows;
									?>
									<div class="">
										<select name="pre_currency" id="pre_currency" class="">
											<option selected>-- Select currency --</option>

											<?php
											foreach ($rowlist as $key => $row) {
												echo "<option  value='" . $row['currency_name'] . "'>" . $row['currency_name'] . "</option>";
											}
											?>

										</select>
									</div>
								</div>

								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span>Period</label> <br>

									<?php echo todisplay($array_salary_period, "pre_period", "--Select Period--", $_SESSION['myForm']["period"], $onchange = ""); ?>

								</div>


								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span>Salary</label>
									<input type="text" name="pre_salary" value="<?php echo $_SESSION['myForm']["salary"]; ?>" required />
								</div>

								<label class="rws-flabel">Expected Salary</label>
								<br>
								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span>Currency</label> <br>
									
									<?php

									$currency = "select * from ss_currency  where currency_name!='' GROUP BY currency_name order by currency_name ASC";

									$result = $db->query($currency);
									$rowlist = $result->rows;
									?>
									<div class="">
										<select name="exp_currency" id="exp_currency" class="">
											<option selected>-- Select currency --</option>

											<?php
											foreach ($rowlist as $key => $row) {
												echo "<option  value='" . $row['currency_name'] . "'>" . $row['currency_name'] . "</option>";
											}
											?>

										</select>
									</div>
								</div>

								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span>Period</label> <br>
									<?php echo todisplay($array_salary_period, "exp_period", "--Select Period--", $_SESSION['myForm']["period"], $onchange = ""); ?>

								</div>


								<div class="rws-fields col-lg-4">
									<label class="rws-flabel"><span>*</span>Salary</label>
									<input type="text" name="exp_salary" value="<?php echo $_SESSION['myForm']["salary"]; ?>" required />
								</div>


								<!-- <div class="rws-fields col-lg-6">
									<label class="rws-flabel"><span>*</span>Salary</label>
									<input type="text" name="salary" value="<?php echo $_SESSION['myForm']["salary"]; ?>" required />
								</div> -->

								<div class="rws-fields col-lg-6">
									<label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
									<input type="file" name="cv" id="cv" accept="application/msword,application/pdf" />
									<?php if (!empty($_SESSION['myForm']['resume'])) {
										echo '<p><a href="' . $baseurl . $_SESSION['myForm']['resume'] . '" title="View" target="_blank">Download Resume</a></p>';
									} ?>
								</div>


							</div>


							<!-- <div class="rws-fields">
								<label class="rws-flabel"><span>*</span>Experience Required</label>
								<input type="text" name="experience" value="<?php echo $_SESSION['myForm']["experience"]; ?>" required />
							</div> -->

						</div>
					</div>
					<!-- Box Ends -->


					<!-- Multiple Row Code 
            
            <div class="rws-multiplebtnsection">
            	<input type="button" name="rwsaddposition" id="rwsaddposition" class="btn btn-success" value="Add New Question" />
            </div>  <br>
			-->

					<!-- Employment History Ends -->

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


<script>
	//  $('#jobtitle').prop('enabled', true).niceSelect('update');

	$("#category").change(function() {

		var cat = $(this).val();

		//	alert(cat);

		var action = "rankrequest";

		$.ajax({

			method: "POST",

			data: {
				cat: cat,
				action: action
			},

			url: "employer_postjob_ajax.php",

			success: function(result) {

				//        alert(result);

				$("#jobtitle").html(result);

			}

		});

	});



	$("#country").change(function() {

		var cat = $(this).val();

		// alert(cat);

		var action = "country";

		$.ajax({

			method: "POST",

			data: {
				cat: cat,
				action: action
			},

			url: "jobseeker_register_ajax.php",

			success: function(result) {

				//        alert(result);

				$("#state").html(result);

				// $("#arank").html(result);

			}

		});

	});

	$("#state").change(function() {

		var cat = $(this).val();

		// alert(cat);

		var action = "state";

		$.ajax({

			method: "POST",

			data: {
				cat: cat,
				action: action
			},

			url: "jobseeker_register_ajax.php",

			success: function(result) {

				//        alert(result);

				$("#city").html(result);

				// $("#arank").html(result);

			}

		});

	});


	$("#cv_category").change(function() {

		var cat = $(this).val();

		//	alert(cat);

		var action = "rankrequest";

		$.ajax({

			method: "POST",

			data: {
				cat: cat,
				action: action
			},

			url: "jobseeker_register_ajax.php",

			success: function(result) {

				//        alert(result);

				$("#rank").html(result);

				$("#arank").html(result);

			}

		});

	});
</script>