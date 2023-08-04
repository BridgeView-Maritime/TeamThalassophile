<?php include("includes/config.php");  $gtpage = "Agent-Edit-Profile"; $gtjqueryui = "Yes"; $gtckeditor = "Yes";

checkagentlogin(); 
checkagentloginrole("None");
unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	if (empty($_POST['firstname']) ) 	{	$errors[]="Please fill out the firstname field.";		}	
	if (empty($_POST['lastname']) ) 	{	$errors[]="Please fill out the lastname field.";	}
	if (empty($_POST['company']) ) 		{	$errors[]="Please fill out the company field.";		}
	
	/*if (empty($_POST['country_code']) ) 	{	$errors[]="Please fill out the country code field.";		} */
	
	if(empty($_POST['mobile']) ) { $errors[]="Please fill out the Mobile field."; } 
	else if(!is_numeric($_POST['mobile'])) { $errors[]="Mobile number should be numeric only."; }
	else if(strlen($_POST['mobile'])!=10) { $errors[]="Mobile Number should be 10 digits."; }
	
	
	
	$today_date = date("Y-m-d");
		
	if (empty($_POST['address']) ) 	{	$errors[]="Please fill out the Address field.";		}
	if (empty($_POST['city']) ) 	{	$errors[]="Please fill out the City field.";		}
	if (empty($_POST['state']) ) 	{	$errors[]="Please fill out the State field.";		}
	if (empty($_POST['pincode']) ) 	{	$errors[]="Please fill out the Postcode field.";		} 
	else if(strlen($_POST['pincode'])!=4) { $errors[]="Postcode should be 4 digits."; }
	
	/*if (empty($_POST['country']) ) 	{	$errors[]="Please fill out the Country field.";		} */
	
	if(empty($_POST["oldimage_1"])) {
		
		if(empty($_FILES["image_1"]) ) {	$errors[]="Please fill out the Compnay Logo field.";		}
		
	}

	// Allowed file types. add file extensions WITHOUT the dot.
	$allowtypes=array("jpg", "JPG", "JPEG", "jpeg", "PNG", "png");
	$max_file_size="2048";
	// checks that profile pic condition


	/*


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
	$allowtypes=array("jpg", "JPG", "JPEG", "jpeg", "PNG", "png");
	//Check if the file type uploaded is a valid file type. 
	if (!in_array($ext, $allowtypes)) {
		$errors[]="Cover Pic <strong>".$filename."</strong> has been rejected! Only the following cover pic formats are allowed: .jpg, .JPG, .jpeg, .JPEG and .PNG.";	
	// check the size of each file
	} elseif($filesize > $max_bytes) {
		$errors[]= "Cover Pic: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
	}
	} // if !empty FILES


	*/
	
	if(empty($errors)) 
	{
        //for company logo
		$image_1 =time().$_FILES['image_1']['name'];

        $temp1=  $_FILES['image_1']['tmp_name'];

		$profilename = "usercvdata/companylogo/$image_1";

        move_uploaded_file($temp1, "usercvdata/companylogo/$image_1") ;



         //for coverpic
		$image_2 =time().$_FILES['image_2']['name'];

        $temp=  $_FILES['image_2']['tmp_name'];

		$covername = "usercvdata/empcoverpic/$image_2";

        move_uploaded_file($temp, "usercvdata/empcoverpic/$image_2") ;
		
		/*
		
		$array_rand = array("rad", "dfd","met","axz", "yza", "tst", "tms", "lpg","art","mec","efc","mar","kar","lad","mah");
			$rand1 = mt_rand(100,999);
			$rand2 = mt_rand(100000,999999);
			$rand_keys = array_rand($array_rand, 2);

			$year = date("Y");
			$month = date("m");
			$date = date("d");			

			$yearfolder = 'empcompanylogos/'.$year;
			$monthfolder = 'empcompanylogos/'.$year.'/'.$month;
			$datefolder = 'empcompanylogos/'.$year.'/'.$month.'/'.$date;
			if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('userpics/index.html', $yearfolder.'/index.html'); }
			if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('userpics/index.html', $monthfolder.'/index.html'); }
			if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('userpics/index.html', $datefolder.'/index.html'); }

			$uploadfolder = $datefolder;
			$imgurl = 'empcompanylogos/'.$year.'/'.$month.'/'.$date.'/';
			
			$yearfolder = 'empcoverpic/'.$year;
			$monthfolder = 'empcoverpic/'.$year.'/'.$month;
			$datefolder = 'empcoverpic/'.$year.'/'.$month.'/'.$date;
			if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('usercvdata/index.html', $yearfolder.'/index.html'); }
			if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('usercvdata/index.html', $monthfolder.'/index.html'); }
			if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('usercvdata/index.html', $datefolder.'/index.html'); }

			$uploadfolder_2 = $datefolder;
			$resumeurl = 'empcoverpic/'.$year.'/'.$month.'/'.$date.'/';

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
					if($k==1)
					{
						$imageuploadname[$k] = $imgurl.$k."_".$rand2."_".$arrayimage[$k];	
					}
					else
					{
						$imageuploadname[$k] = $resumeurl.$k."_".$rand2."_".$arrayimage[$k];	
					}
				}
				else
				{
					$imageuploadname[$k]=$_POST['oldimage_'.$k];
				}
			}
			

			*/


			$firstname 			= addslashes($_POST['firstname']);	
			$lastname 			= addslashes($_POST['lastname']);				
			$company 			= addslashes($_POST['company']);
			$mobile 			= addslashes($_POST['mobile']);
		
			
			$address 			= addslashes($_POST['address']);
			$city 				= addslashes($_POST['city']);
			$state 				= addslashes($_POST['state']);
			$pincode 			= addslashes($_POST['pincode']);
			$country 			= addslashes($_POST['country']);			
			
			$description 		= addslashes($_POST['description']);
			
			$website 			= addslashes($_POST['website']);
			$twitter 			= addslashes($_POST['twitter']);
			$linkedin           = addslashes( $_POST['linkedin']);
			$facebook 			= addslashes($_POST['facebook']);
			$insta 				= addslashes($_POST['instagram']);
			
			
			
			/* Update Data To Database */
			
			$update_query = "UPDATE `ss_agent` SET firstname = '$firstname', lastname = '$lastname', company = '$company', mobile = '$mobile', logo = '$profilename', coverpic = '$covername', address = '$address', city = '$city', state = '$state', pincode = '$pincode', country = '$country', description = '$description', website = '$website', twitter = '$twitter' , linkedin = '$linkedin' ,
			facebook = '$facebook' , instagram = '$insta'  WHERE `id`=".$_SESSION["AGN"]['ID'];

			$update_result = $db->query($update_query);	
			
			$_SESSION["AGN"]['Firstname']		=	$firstname;
			$_SESSION["AGN"]['Lastname']		=	$lastname;				
			$_SESSION["AGN"]['Mobile']			=	$mobile;	
			$_SESSION["AGN"]['Picture']			=	$profilename;
			
			$js_id = $_SESSION["AGN"]['ID'];
			
			$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your profile has been updated.</div>';	

			echo "<script>document.location.href='".$baseurl."agent-edit-profile.php'</script>";
			exit;
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
	$select_query = 'SELECT * FROM `ss_agent` WHERE id = "'.$_SESSION["AGN"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
	$_SESSION['myForm']['firstname'] = stripslashes($rowut['firstname']);	
	$_SESSION['myForm']['lastname'] = stripslashes($rowut['lastname']);	
	$_SESSION['myForm']['company'] = stripslashes($rowut['company']);
	$_SESSION['myForm']['email'] = stripslashes($rowut['email']);
	$_SESSION['myForm']['mobile'] = stripslashes($rowut['mobile']);
	
	$_SESSION['myForm']['logo'] = stripslashes($rowut['logo']);
	$_SESSION['myForm']['coverpic'] = stripslashes($rowut['coverpic']);
	$_SESSION['myForm']['address'] = stripslashes($rowut['address']);
	$_SESSION['myForm']['city'] = stripslashes($rowut['city']);
	$_SESSION['myForm']['state'] = stripslashes($rowut['state']);
	$_SESSION['myForm']['pincode'] = stripslashes($rowut['pincode']);
	$_SESSION['myForm']['country'] = stripslashes($rowut['country']);	
	
	/* $_SESSION['myForm']['country_code'] = stripslashes($rowut['country_code']); */
	
	$_SESSION['myForm']['description'] = stripslashes($rowut['description']);
	
	$_SESSION['myForm']['website'] = stripslashes($rowut['website']);
	$_SESSION['myForm']['twitter'] = stripslashes($rowut['twitter']);
	$_SESSION['myForm']['linkedin'] = stripslashes($rowut['linkedin']);
	$_SESSION['myForm']['facebook'] = stripslashes($rowut['facebook']);
	$_SESSION['myForm']['instagram'] = stripslashes($rowut['instagram']);
	
	
	
}
else
{
	
}


?>

<style>


    .list {
			height: 250px !important; 
    		overflow-y: auto !important;
    		width:100% !important;
		}

    .nice-select { width:100% !important; }

</style>


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




<!-- RWS Header Starts -->  
<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Company Profile</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Company Profile</a>
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
        
        
        <div class="col-md-9">
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
                        	<label class="rws-flabel"><span>*</span>Firstname</label>
                             <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['myForm']['firstname']; ?>" placeholder="*Firstname" required />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Lastname</label>
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['myForm']['lastname']; ?>" placeholder="*Lastname" required />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Company</label>
                             <input type="text" name="company" id="company" value="<?php echo $_SESSION['myForm']['company']; ?>" placeholder="*Company" required />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Mobile</label>
                            <div class="row">
                            <div class="col-xs-7">                            
                            <input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="*Mobile" required />
                            </div>
                            </div>
                            
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Address</label>
                             <input type="text" name="address" id="address" value="<?php echo $_SESSION['myForm']['address']; ?>" placeholder="*Address" required />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>City</label>
                            <input type="text" name="city" id="city" value="<?php echo $_SESSION['myForm']['city']; ?>" placeholder="*City" required />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>State</label>
                             <input type="text" name="state" id="state" value="<?php echo $_SESSION['myForm']['state']; ?>" placeholder="*State" required />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Postcode</label>
                            <input type="text" name="pincode" id="pincode" value="<?php echo $_SESSION['myForm']['pincode']; ?>" placeholder="*Postcode" required maxlength="4" />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <!--
                    <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Country</label>
                        <input type="radio" name="country" id="country_1" value="Australia" required <?php if($_SESSION['myForm']['country']=="Australia") { echo 'checked="checked"'; } else { } ?> /> &nbsp;&nbsp;Australia (+61)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="country" id="country_1" value="New Zealand" required  <?php if($_SESSION['myForm']['country']=="New Zealand") { echo 'checked="checked"'; } else { } ?>  />&nbsp;&nbsp; New Zealand (+64)
                    </div>
					
					-->

                    <div class="rws-fields">
                        <label>Select Country</label><br/>

          				 <?php
 		              
 		                    $country="select * from ss_countries  where country!='' GROUP BY country order by country ASC";

                            $result = $db->query($country);
	                        $rowlist = $result->rows;
              		    ?>

              			<select name="country" id="country">
			
					 <option selected ><?php echo $_SESSION['myForm']['country']; ?></option>
					
    							
    					<?php
        				    foreach($rowlist as $key => $row)
	                        {
            					echo "<option  value='". $row['country'] ."'>" .$row['country'] ."</option>"; 
							//echo "<option  value='".$_SESSION['myForm']['country'] ."'>" .$row['country'] ."</option>"; 
        					}	
    					?>  
					
  						</select>                    
                    </div><br><br>



                    <!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Company Logo (Only JPG &amp; PNG Allowed)</label>
                            <input type="file" name="image_1" id="image_1" accept="image/jpeg, image/png, image/jpg" />
                            <?php if(!empty($_SESSION['myForm']['logo'])) { echo '<p><a href="'.$baseurl.$_SESSION['myForm']['logo'].'" title="View" target="_blank">View Company Logo</a></p>';} ?>
                            
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Cover Picture (Only JPG Allowed)</label>
                            <input type="file" name="image_2" id="image_2" accept="application/jpeg" />
                            <?php if(!empty($_SESSION['myForm']['coverpic'])) { echo '<p><a href="'.$baseurl.$_SESSION['myForm']['coverpic'].'" title="View" target="_blank">View Cover Picture</a></p>';} ?>
                        </div>        
                    </div>
             <!--       <input type="hidden" name="oldimage_1" value="<?php echo $_SESSION['myForm']['logo']; ?>" />
                    <input type="hidden" name="oldimage_2" value="<?php echo $_SESSION['myForm']['coverpic']; ?>" />   -->
            		<!-- Row Ends -->
                    
                    <div class="rws-fields">   
                    	<label class="rws-flabel"><span>*</span>Company Profile</label>
                        <textarea name="description" id="description" placeholder="Company Profile"><?php echo $_SESSION['myForm']['description']; ?></textarea>
                    </div>
                	<!-- Row Ends -->                    
               

                    <div class="rws-fields row  rws-socialinfouser">    
                        <div class="col-sm-4">
                             <label class="rws-flabel">Website</label>
                             <input type="url" name="website" id="website" value="<?php echo $_SESSION['myForm']['website']; ?>" placeholder="Website" required />
                        </div> 
                        <div class="col-sm-4">
                        	<label class="rws-flabel">Twitter ID</label>
                            <input type="text" name="twitter" id="twitter" value="<?php echo $_SESSION['myForm']['twitter']; ?>"/>
                        </div>                   
                        <div class="col-sm-4">
                        	<label class="rws-flabel">Linkedin ID</label>
                             <input type="text" name="linkedin" id="linkedin" value="<?php echo $_SESSION['myForm']['linkedin']; ?>"/>
                        </div>        
                    </div>

                    <div class="rws-fields row  rws-socialinfouser">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Facebook ID</label>
                             <input type="text" name="facebook" id="website" value="<?php echo $_SESSION['myForm']['facebook']; ?>"/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Instagram ID</label>
                            <input type="text" name="instagram" id="video" value="<?php echo $_SESSION['myForm']['instagram']; ?>"/>
                        </div>        
                    </div>

            		<!-- Row Ends --> 
            
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
<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->
<!-- RWS Footer Starts --> 

<script>
$('select[id="country"]').find('option[value="'+country+'"]').attr("selected",true);
</script>