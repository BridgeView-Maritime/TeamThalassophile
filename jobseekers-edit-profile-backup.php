<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile";

checkuserlogin(); 

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	if (empty($_POST['firstname']) ) 	{	$errors[]="Please fill out the firstname field.";		}	
	if (empty($_POST['lastname']) ) 	{	$errors[]="Please fill out the lastname field.";	}
	if (empty($_POST['location']) ) 	{	$errors[]="Please fill out the location field.";		}

	if(empty($_POST['mobile']) ) { $errors[]="Please fill out the Mobile field."; } 
	else if(!is_numeric($_POST['mobile'])) { $errors[]="Mobile number should be numeric only."; }
	else if(strlen($_POST['mobile'])!=10) { $errors[]="Mobile Number should be 10 digits."; }
	
	if (empty($_POST['country']) ) 	{	$errors[]="Please fill out the location field.";		}

	
	/*if (empty($_POST['location']) ) {	$errors[]="Please fill out the Landmark field.";		}
	if (empty($_POST['address']) ) 	{	$errors[]="Please fill out the Address field.";		}
	if (empty($_POST['city']) ) 	{	$errors[]="Please fill out the City field.";		}
	if (empty($_POST['state']) ) 	{	$errors[]="Please fill out the State field.";		}
	if (empty($_POST['pincode']) ) 	{	$errors[]="Please fill out the Pincode field.";		}
	if (empty($_POST['country']) ) 	{	$errors[]="Please fill out the Country field.";		}*/

	// Allowed file types. add file extensions WITHOUT the dot.
	$allowtypes=array("jpg", "JPG", "JPEG", "jpeg", "PNG", "png");
	$max_file_size="2048";
	// checks that profile pic condition
	if((!empty($_FILES["image_1"])) && ($_FILES['image_1']['error'] == 0)) {
	// basename -- Returns filename component of path
	$filename = basename($_FILES['image_1']['name']);
	$ext = substr($filename, strrpos($filename, '.') + 1);
	$filesize=$_FILES['image_1']['size'];
	$max_bytes=$max_file_size*1024;
	//Check if the file type uploaded is a valid file type. 

	if (!in_array($ext, $allowtypes)) {
		$errors[]="Profile pic <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .jpg, .JPG, .jpeg, .JPEG and .PNG.";
	// check the size of each file
	} elseif($filesize > $max_bytes) {
		$errors[]= "Profile pic: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
	}
	} // if !empty FILES
	// checks that profile pic condition
	if((!empty($_FILES["image_2"])) && ($_FILES['image_2']['error'] == 0)) {
	// basename -- Returns filename component of path
	$filename = basename($_FILES['image_2']['name']);
	$ext = substr($filename, strrpos($filename, '.') + 1);
	$filesize=$_FILES['image_2']['size'];
	$max_bytes=$max_file_size*1024;	
	$allowtypes=array("doc", "docx", "pdf");
	//Check if the file type uploaded is a valid file type. 
	if (!in_array($ext, $allowtypes)) {
		$errors[]="Resume <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .doc, .docx, .pdf.";	
	// check the size of each file
	} elseif($filesize > $max_bytes) {
		$errors[]= "Resume: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
	}
	} // if !empty FILES
	
	// Employment History blank check
	
	$occupation 			= $_POST["occupation"];
	$jobcompany 			= $_POST["jobcompany"];
	$joblocation 			= $_POST["joblocation"];
	$start_month 			= $_POST["start_month"];
	$start_year 			= $_POST["start_year"];
	$end_month 				= $_POST["end_month"];
	$end_year 				= $_POST["end_year"];
	$description 			= $_POST["description"];
	$currently_work_hear 	= $_POST["currently_work_hear"];
	
	$i=0;
	if(trim($occupation[0])!="")
	{
		foreach($occupation as $key=>$val)
		{
			if(empty($occupation[$i]))
			{
				$errors[]="Please fill out the $i employment location field.";
			}
			
			if(empty($jobcompany[$i]))
			{
				$errors[]="Please fill out the $i employment location field.";
			}
			
			if(empty($joblocation[$i]))
			{
				$errors[]="Please fill out the $i employment location field.";
			}
			
			if(empty($start_month[$i]))
			{
				$errors[]="Please fill out the $i employment location field.";
			}
			
			if(empty($start_year[$i]))
			{
				$errors[]="Please fill out the $i employment location field.";
			}
			
			if(empty($currently_work_hear[$i]))
			{			
				if(empty($end_month[$i]))
				{
					$errors[]="Please fill out the $i employment location field.";
				}
				
				if(empty($end_year[$i]))
				{
					$errors[]="Please fill out the $i employment location field.";
				}
			}
			
			if(empty($description[$i]))
			{
				$errors[]="Please fill out the $i employment location field.";
			}
			
			$i++;
		}
	}

	
	if(empty($errors)) 
	{
			$array_rand = array("rad", "dfd","met","axz", "yza", "tst", "tms", "lpg","art","mec","efc","mar","kar","lad","mah");
			$rand1 = mt_rand(100,999);
			$rand2 = mt_rand(100000,999999);
			$rand_keys = array_rand($array_rand, 2);

			$year = date("Y");
			$month = date("m");
			$date = date("d");			

			$yearfolder = "userpics/".$year;
			$monthfolder = 'userpics/'.$year.'/'.$month;
			$datefolder = 'userpics/'.$year.'/'.$month.'/'.$date;
			if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('userpics/index.html', $yearfolder.'/index.html'); }
			if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('userpics/index.html', $monthfolder.'/index.html'); }
			if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('userpics/index.html', $datefolder.'/index.html'); }

			$uploadfolder = $datefolder;
			$imgurl = 'userpics/'.$year.'/'.$month.'/'.$date.'/';
			
			$yearfolder = "usercvdata/".$year;
			$monthfolder = 'usercvdata/'.$year.'/'.$month;
			$datefolder = 'usercvdata/'.$year.'/'.$month.'/'.$date;
			if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('usercvdata/index.html', $yearfolder.'/index.html'); }
			if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('usercvdata/index.html', $monthfolder.'/index.html'); }
			if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('usercvdata/index.html', $datefolder.'/index.html'); }

			$uploadfolder_2 = $datefolder;
			$resumeurl = 'usercvdata/'.$year.'/'.$month.'/'.$date.'/';

			for($k=1;$k<=2;$k++)
			{
				if(!empty($_FILES['image_'.$k]['name']))
				{
					$fileThumbnail = $_FILES['image_'.$k]['tmp_name'];
					$arrayimage[$k] = $_FILES['image_'.$k]['name'];
					if($k==1)
					{
						$add_thumbnail=$uploadfolder."/".$k."_".$rand2."_".$arrayimage[$k];
					}
					else
					{
						$add_thumbnail=$uploadfolder_2."/".$k."_".$rand2."_".$arrayimage[$k];
					}
					
					if (is_uploaded_file($fileThumbnail))
					{
						move_uploaded_file ($fileThumbnail, $add_thumbnail);
					}
					$imageuploadname[$k] = $imgurl.$k."_".$rand2."_".$arrayimage[$k];	
				}
				else
				{
					$imageuploadname[$k]=$_POST['oldimage_'.$k];
				}
			}
			$dateofbirth = $_POST['dobyear'].'-'.$_POST['dobmonth'].'-'.$_POST['dobdate'];

			$firstname = $_POST['firstname'];	
			$lastname = $_POST['lastname'];	
			$gender = $_POST['gender'];
			$dateofbirth = $_POST['dateofbirth'];
			$mobile = $_POST['mobile'];
			
			$location = $_POST['location'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$pincode = $_POST['pincode'];
			$country = $_POST['country'];			
			
			$professional_headline = $_POST['professional_headline'];
			$additional_skills = $_POST['additional_skills'];
			$jobstatus = $_POST['jobstatus'];
			$availability_1_from = $_POST['availability_1_from'];
			$availability_1_to = $_POST['availability_1_to'];
			$availability_2_from = $_POST['availability_2_from'];
			$availability_2_to = $_POST['availability_2_to'];
			$availability_3_from = $_POST['availability_3_from'];
			$availability_3_to = $_POST['availability_3_to'];
			
			$client_work_with = $_POST['client_work_with'];
			$short_bio = $_POST['short_bio'];
			$linkedin = $_POST['linkedin'];
			$twitter = $_POST['twitter'];
			$website = $_POST['website'];
			$video = $_POST['video'];			

			/* Update Data To Database */
			
			$update_query = "UPDATE `ss_jobseekers` SET firstname = '$firstname', lastname = '$lastname', gender = '$gender', dateofbirth = '$dateofbirth', mobile = '$mobile', profile_pic = '".$imageuploadname[1]."', resume = '".$imageuploadname[2]."', location = '$location', address = '$address', city = '$city', state = '$state', pincode = '$pincode', country = '$country', professional_headline = '$professional_headline', additional_skills = '$additional_skills', jobstatus = '$jobstatus', availability_1_from = '$availability_1_from', availability_1_to = '$availability_1_to', availability_2_from = '$availability_2_from', availability_2_to = '$availability_2_to', availability_3_from = '$availability_3_from', availability_3_to = '$availability_3_to', client_work_with = '$client_work_with', short_bio = '$short_bio', linkedin = '$linkedin', twitter = '$twitter', website = '$website', video = '$video' WHERE `id`=".$_SESSION["USER"]['ID'];

			$update_result = $db->query($update_query);	
			
			$_SESSION["USER"]['Firstname']		=	$firstname;
			$_SESSION["USER"]['Lastname']		=	$lastname;				
			$_SESSION["USER"]['Mobile']			=	$mobile;	
			$_SESSION["USER"]['Picture']		=	$imageuploadname[1];
			
			$js_id = $_SESSION["USER"]['ID'];
			
			/* Add Employment History to Database Code Starts */
			
			$db->query("DELETE FROM `ss_jobseekers_employment` WHERE `js_id`='$js_id'");
			
			$occupation 			= $_POST["occupation"];
			$jobcompany 			= $_POST["jobcompany"];
			$joblocation 			= $_POST["joblocation"];
			$start_month 			= $_POST["start_month"];
			$start_year 			= $_POST["start_year"];
			$end_month 				= $_POST["end_month"];
			$end_year 				= $_POST["end_year"];
			$description 			= $_POST["description"];
			$currently_work_hear 	= $_POST["currently_work_hear"];
			
			$i=0;
			foreach($occupation as $key=>$val)
			{
				$query_insert = "INSERT INTO `ss_jobseekers_employment` SET js_id = '$js_id', occupation = '".$occupation[$i]."', company = '".$jobcompany[$i]."', location = '".$joblocation[$i]."', start_month = '".$start_month[$i]."', start_year = '".$start_year[$i]."', end_month = '".$end_month[$i]."', end_year = '".$end_year[$i]."', description = '".$description[$i]."', currently_work_hear = '".$currently_work_hear[$i]."', sort_order = '0', add_date = '$gtcurrenttime'";

				$update_result = $db->query($query_insert);
				
				$i++;
			}
			
			/* Add Employment History to Database Code Ends */

			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your profile has been updated.</div>';	

			/*echo "<script>document.location.href='".$baseurl."jobseekers-edit-profile.php'</script>";
			exit;*/
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
	$select_query = 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$_SESSION["USER"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
	$_SESSION['myForm']['firstname'] = stripslashes($rowut['firstname']);	
	$_SESSION['myForm']['lastname'] = stripslashes($rowut['lastname']);	
	$_SESSION['myForm']['gender'] = stripslashes($rowut['gender']);
	$_SESSION['myForm']['dateofbirth'] = stripslashes($rowut['dateofbirth']);
	$_SESSION['myForm']['email'] = stripslashes($rowut['email']);
	$_SESSION['myForm']['mobile'] = stripslashes($rowut['mobile']);
	
	$_SESSION['myForm']['profile_pic'] = stripslashes($rowut['profile_pic']);
	$_SESSION['myForm']['resume'] = stripslashes($rowut['resume']);
	$_SESSION['myForm']['location'] = stripslashes($rowut['location']);
	$_SESSION['myForm']['address'] = stripslashes($rowut['address']);
	$_SESSION['myForm']['city'] = stripslashes($rowut['city']);
	$_SESSION['myForm']['state'] = stripslashes($rowut['state']);
	$_SESSION['myForm']['pincode'] = stripslashes($rowut['pincode']);
	$_SESSION['myForm']['country'] = stripslashes($rowut['country']);	
	
	$datearray = explode('-',$_SESSION['myForm']["dateofbirth"]);
	if($_SESSION['myForm']["dobdate"]=="")  { $_SESSION['myForm']["dobdate"] = $datearray[2]; 	}
	if($_SESSION['myForm']["dobmonth"]=="") { $_SESSION['myForm']["dobmonth"] = $datearray[1]; 	}
	if($_SESSION['myForm']["dobyear"]=="")  { $_SESSION['myForm']["dobyear"] = $datearray[0]; 	}
	
	$_SESSION['myForm']['professional_headline'] = stripslashes($rowut['professional_headline']);
	$_SESSION['myForm']['additional_skills'] = stripslashes($rowut['additional_skills']);
	$_SESSION['myForm']['jobstatus'] = stripslashes($rowut['jobstatus']);
	$_SESSION['myForm']['availability_1_from'] = stripslashes($rowut['availability_1_from']);
	$_SESSION['myForm']['availability_1_to'] = stripslashes($rowut['availability_1_to']);
	$_SESSION['myForm']['availability_2_from'] = stripslashes($rowut['availability_2_from']);
	$_SESSION['myForm']['availability_2_to'] = stripslashes($rowut['availability_2_to']);
	$_SESSION['myForm']['availability_3_from'] = stripslashes($rowut['availability_3_from']);
	$_SESSION['myForm']['availability_3_to'] = stripslashes($rowut['availability_3_to']);
	
	$_SESSION['myForm']['client_work_with'] = stripslashes($rowut['client_work_with']);
	$_SESSION['myForm']['short_bio'] = stripslashes($rowut['short_bio']);
	$_SESSION['myForm']['linkedin'] = stripslashes($rowut['linkedin']);
	$_SESSION['myForm']['twitter'] = stripslashes($rowut['twitter']);
	$_SESSION['myForm']['website'] = stripslashes($rowut['website']);
	$_SESSION['myForm']['video'] = stripslashes($rowut['video']);
	
	/* Employment Records */
	$select_query = 'SELECT * FROM `ss_jobseekers_employment` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
	$select_result = $db->query($select_query);
	$empitems = $select_result->rows;
	$emptotal = $select_result->num_rows;
	
	if($emptotal>0)
	{
		foreach($empitems as $key => $rowemp) { 
			$_SESSION['myForm']['occupation'][] 			= $rowemp["occupation"];
			$_SESSION['myForm']['jobcompany'][] 			= $rowemp["company"];
			$_SESSION['myForm']['joblocation'][] 			= $rowemp["location"];
			$_SESSION['myForm']['start_month'][] 			= $rowemp["start_month"];
			$_SESSION['myForm']['start_year'][] 			= $rowemp["start_year"];
			$_SESSION['myForm']['end_month'][] 				= $rowemp["end_month"];
			$_SESSION['myForm']['end_year'][] 				= $rowemp["end_year"];
			$_SESSION['myForm']['description'][] 			= $rowemp["description"];
			$_SESSION['myForm']['currently_work_hear'][] 	= $rowemp["currently_work_hear"];
		}
	}
	
}
else
{
	$emptotal = count($_SESSION['myForm']['occupation']);
}


?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts -->  
<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
	<div class="container">
    <div class="row">
    	<div class="col-md-4">
        	<?php include("app/jobseekers-leftmenu.php"); ?>        	
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">
        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        
        	<div class="rws-module">
                <div class="mtitle">Personal Info</div>
                <div class="rws-mcontent">
                	<?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                    
                    <div class="rws-fields">    
                        <?php echo $_SESSION['myForm']['rwsusername']; ?>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                             <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['myForm']['firstname']; ?>" placeholder="*Firstname" required />
                        </div>                    
                        <div class="col-sm-6">
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['myForm']['lastname']; ?>" placeholder="*Lastname" required />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                             <input type="text" name="location" id="location" value="<?php echo $_SESSION['myForm']['location']; ?>" placeholder="*Location" required />
                        </div>                    
                        <div class="col-sm-6">
                            <input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="*Mobile" required />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">
                        <input type="radio" name="country" id="country_1" value="Australia" required <?php if($_SESSION['myForm']['country']=="Australia") { echo 'checked="checked"'; } else { } ?> /> &nbsp;&nbsp;Australia (+61)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="country" id="country_1" value="New Zealand" required  <?php if($_SESSION['myForm']['country']=="New Zealand") { echo 'checked="checked"'; } else { } ?>  />&nbsp;&nbsp; New Zealand (+64)
                    </div>
                    <!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<p>Profile Picture (Only JPG Allowed)</p>
                            <input type="file" name="image_1" id="image_1" accept="image/jpeg" />
                        </div>                    
                        <div class="col-sm-6">
                        	<p>Resume (Only DOC/PDF Allowed)</p>
                            <input type="file" name="image_2" id="image_2" accept="image/jpeg" />
                        </div>        
                    </div>
                    <input type="hidden" name="oldimage_1" value="<?php echo $_SESSION['myForm']['profile_pic']; ?>" />
                    <input type="hidden" name="oldimage_2" value="<?php echo $_SESSION['myForm']['resume']; ?>" />
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">  
                    	<p>Job Status</p>  
                        <input type="radio" name="jobstatus" id="jobstatus_1" value="Active JobSEAker" required  <?php if($_SESSION['myForm']['jobstatus']=="Active JobSEAker") { echo 'checked="checked"'; } else { } ?> /> Active JobSEAker &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="jobstatus" id="jobstatus_2" value="Not Interested in Jobs" required  <?php if($_SESSION['myForm']['jobstatus']=="Not Interested in Jobs") { echo 'checked="checked"'; } else { } ?> /> Not Interested in Jobs &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="jobstatus" id="jobstatus_2" value="Can Consider
New Jobs" required  <?php if($_SESSION['myForm']['jobstatus']=="Can Consider
New Jobs") { echo 'checked="checked"'; } else { } ?> /> Can Consider New Jobs
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">  
                    	<p>My Next Availability 1</p>  
                        <div class="row">
                        	<div class="col-sm-6">
                            	<input type="date" name="availability_1_from" id="availability_1_from" value="<?php echo $_SESSION['myForm']['availability_1_from']; ?>" placeholder="From" />
                            </div>
                            <div class="col-sm-6">
                            	<input type="date" name="availability_1_to" id="availability_1_to" value="<?php echo $_SESSION['myForm']['availability_1_to']; ?>"  placeholder="To"/>
                            </div>
                        </div>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">  
                    	<p>My Next Availability 2</p>  
                        <div class="row">
                        	<div class="col-sm-6">
                            	<input type="date" name="availability_2_from" id="availability_2_from" value="<?php echo $_SESSION['myForm']['availability_2_from']; ?>" placeholder="From" />
                            </div>
                            <div class="col-sm-6">
                            	<input type="date" name="availability_2_to" id="availability_2_to" value="<?php echo $_SESSION['myForm']['availability_2_to']; ?>"  placeholder="To"/>
                            </div>
                        </div>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">  
                    	<p>My Next Availability 3</p>  
                        <div class="row">
                        	<div class="col-sm-6">
                            	<input type="date" name="availability_3_from" id="availability_3_from" value="<?php echo $_SESSION['myForm']['availability_3_from']; ?>" placeholder="From" />
                            </div>
                            <div class="col-sm-6">
                            	<input type="date" name="availability_3_to" id="availability_3_to" value="<?php echo $_SESSION['myForm']['availability_3_to']; ?>"  placeholder="To"/>
                            </div>
                        </div>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">    
                        <input type="text" name="professional_headline" id="professional_headline" value="<?php echo $_SESSION['myForm']['professional_headline']; ?>" placeholder="*Your professional headline (i.e. Experienced Manager)" required />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<h6>Additional Skills</h6> 
                        <input type="text" name="additional_skills" id="additional_skills" value="<?php echo $_SESSION['myForm']['additional_skills']; ?>" placeholder="*Additional Skills" required />
                        <p>Hint: Separate skills with commas on your keyboard.</p>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<h6>Client you worked with</h6> 
                        <input type="text" name="client_work_with" id="client_work_with" value="<?php echo $_SESSION['myForm']['client_work_with']; ?>" placeholder="*Client you worked with" required />
                        <p>Hint: Separate client with commas on your keyboard.</p>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<textarea name="short_bio" id="short_bio" placeholder="Provide a short Bio"><?php echo $_SESSION['myForm']['professional_headline']; ?></textarea>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields row rws-socialinfouser">    
                        <div class="col-sm-6">
                             <input type="text" name="linkedin" id="linkedin" value="<?php echo $_SESSION['myForm']['linkedin']; ?>" placeholder="Linkedin" />
                        </div>                    
                        <div class="col-sm-6">
                            <input type="text" name="twitter" id="twitter" value="<?php echo $_SESSION['myForm']['twitter']; ?>" placeholder="Twitter" />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row  rws-socialinfouser">    
                        <div class="col-sm-6">
                             <input type="text" name="website" id="website" value="<?php echo $_SESSION['myForm']['website']; ?>" placeholder="Website" />
                        </div>                    
                        <div class="col-sm-6">
                            <input type="text" name="video" id="video" value="<?php echo $_SESSION['myForm']['video']; ?>" placeholder="Video" />
                        </div>        
                    </div>
            		<!-- Row Ends --> 
            
                </div>
            </div>
            <!-- Box Ends -->
            
            <h3>Employment History</h3>
            <?php if($emptotal>0) {
				$ier=0;
				foreach($_SESSION['myForm']["occupation"] as $key_emp=>$val_emp) 
				{
				?>
                
                <div class="rws-module clonedInput" id="nameinput1">
                <div class="rws-mcontent">
                	<div class="rws-fields">   
                    	<p>Occupation / Title</p> 
                        <input type="text" name="occupation[]" value="<?php echo $_SESSION['myForm']["occupation"][$ier];?>" placeholder="*Occupation / Title" />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                             <input type="text" name="jobcompany[]" id="company" value="<?php echo $_SESSION['myForm']["jobcompany"][$ier];?>" placeholder="*Company" />
                        </div>                    
                        <div class="col-sm-6">
                            <input type="text" name="joblocation[]" id="location" value="<?php echo $_SESSION['myForm']["joblocation"][$ier];?>" placeholder="*Location" />
                        </div>        
                    </div>
            		<!-- Row Ends --> 
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                             <div class="row">
                             	<div class="col-7">
                                	<?php echo todisplay($array_months, "start_month[]", "Start Month", $_SESSION['myForm']["start_month"][$ier], $onchange=""); ?>
                                </div>
                                <div class="col-5">
                                	<?php echo togetyearemployment("start_year[]",$_SESSION['myForm']["start_year"][$ier],$period=0,$others=""); ?>
                                </div>
                             </div>
                        </div>                    
                        
                       <div class="col-sm-6">
                             <div class="row">
                             	<div class="col-7">
                                	<?php echo todisplay($array_months, "end_month[]", "End Month", $_SESSION['myForm']["end_month"][$ier], $onchange=""); ?>
                                </div>
                                <div class="col-5">
                                	<?php echo togetyearemployment("end_year[]",$_SESSION['myForm']["end_year"][$ier],$period=0,$others=""); ?>
                                </div>
                             </div>
                        </div>
                                 
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<textarea name="description[]" placeholder="Job Description"><?php echo $_SESSION['myForm']["description"][$ier];?></textarea>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<input type="checkbox" name="currently_work_hear[]" value="Yes" <?php if($_SESSION['myForm']["currently_work_hear"][$ier]=="Yes") { echo "checked"; } ?>> I currently work here.
                    </div>
                	<!-- Row Ends -->
                    <?php if($ier>0) { ?>
                    <div class="rws-fields rwsdelete1" style="display:block;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    <?php } else { ?>
                    <div class="rws-fields rwsdelete1" style="display:none;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    <?php } ?>
                    
                </div>
            </div> 
                
            <?php $ier++; } } else { ?>
                
            <div class="rws-module clonedInput" id="nameinput1">
                <div class="rws-mcontent">
                	<div class="rws-fields">   
                    	<p>Occupation / Title</p> 
                        <input type="text" name="occupation[]" value="" placeholder="*Occupation / Title" />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                             <input type="text" name="jobcompany[]" id="company" value="" placeholder="*Company" />
                        </div>                    
                        <div class="col-sm-6">
                            <input type="text" name="joblocation[]" id="location" value="" placeholder="*Location" />
                        </div>        
                    </div>
            		<!-- Row Ends --> 
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                             <div class="row">
                             	<div class="col-7">
                                	<?php echo todisplay($array_months, "start_month[]", "Start Month", $selected="", $onchange=""); ?>
                                </div>
                                <div class="col-5">
                                	<?php echo togetyearemployment("start_year[]",$editcatid=0,$period=0,$others=""); ?>
                                </div>
                             </div>
                        </div>                    
                        
                       <div class="col-sm-6">
                             <div class="row">
                             	<div class="col-7">
                                	<?php echo todisplay($array_months, "end_month[]", "End Month", $selected="", $onchange=""); ?>
                                </div>
                                <div class="col-5">
                                	<?php echo togetyearemployment("end_year[]",$editcatid=0,$period=0,$others=""); ?>
                                </div>
                             </div>
                        </div>
                                 
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<textarea name="description[]" placeholder="Job Description"></textarea>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<input type="checkbox" name="currently_work_hear[]" value="Yes"> I currently work here.
                    </div>
                	<!-- Row Ends -->
                    <div class="rws-fields rwsdelete1" style="display:none;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    
                </div>
            </div> 
            <?php } ?>
            <!-- Multiple Row Code -->
            
            <div class="rws-multiplebtnsection">
            	<input type="button" name="rwsaddposition" id="rwsaddposition" class="btn btn-success" value="Add Position" />
            </div>  
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