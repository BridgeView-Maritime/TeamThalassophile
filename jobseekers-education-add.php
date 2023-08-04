<style>
	table tr th{
		text-align:center;
	}
	table {
		text-align:center;
	}
</style>


<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile";

checkuserlogin(); 

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
	if (empty($_POST['school']) ) 	{	$errors[]="Please fill out the school name field.";		}	
	if (empty($_POST['degree']) ) 	{	$errors[]="Please fill out the degree field.";	}
	if (empty($_POST['start_year']) ) 	{	$errors[]="Please fill out the start year field.";		}
	if (empty($_POST['end_year']) ) 	{	$errors[]="Please fill out the end year field.";		}
	
	$yeardifference = $_POST['end_year']-$_POST['start_year'];		
			
	if($yeardifference<0)
	{
		$errors[]='The selected end year must be earlier or equal to start year.';
	}	
	//if (empty($_POST['marks_percentage']) ) 	{	$errors[]="Please fill out the marks obtained field.";		}
	
	if(empty($errors)) 
	{
			$school 				= $_POST["school"];
			$degree 				= $_POST["degree"];
			$start_year 			= $_POST["start_year"];
			$end_year 				= $_POST["end_year"];
			$marks_percentage 		= $_POST["marks_percentage"];
			$description 			= $_POST["description"];	
			
			$post_id 				= $_POST["post_id"];			

			/* Update Data To Database */
			if($post_id>0)
			{
				$update_query = "UPDATE `ss_jobseekers_education` SET school = '$school', degree = '$degree', start_year = '$start_year', end_year = '$end_year', marks_percentage = '$marks_percentage', description = '$description' WHERE `id`='$post_id' AND `js_id`=".$_SESSION["USER"]['ID'];
				
				$update_result = $db->query($update_query);	
				
				$emp_id = $post_id;
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your educational history has been updated.</div>';	
				
			}
			else
			{
				$update_query = "INSERT INTO `ss_jobseekers_education` SET js_id = '".$_SESSION["USER"]['ID']."', school = '$school', degree = '$degree', start_year = '$start_year', end_year = '$end_year', marks_percentage = '$marks_percentage', description = '$description', sort_order = '0', add_date = '$gtcurrenttime'";
				$update_result = $db->query($update_query);	
				
				$emp_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your educational history has been added.</div>';	
			}
			
			$js_id = $_SESSION["USER"]['ID'];
			
			echo "<script>document.location.href='".$baseurl."jobseekers-passport.php'</script>";
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
	$post_id = $_GET["post_id"];
	if($post_id>0)
	{
		$select_query = 'SELECT * FROM `ss_jobseekers_education` WHERE `id`="'.$post_id.'" AND js_id = "'.$_SESSION["USER"]['ID'].'"';
		$select_result = $db->query($select_query);
		$rowut = $select_result->row;
		
		$_SESSION['myForm']['school'] 				= $rowut["school"];
		$_SESSION['myForm']['degree'] 				= $rowut["degree"];
		$_SESSION['myForm']['start_year'] 			= $rowut["start_year"];
		$_SESSION['myForm']['end_year'] 			= $rowut["end_year"];
		$_SESSION['myForm']['marks_percentage']		= $rowut["marks_percentage"];
		$_SESSION['myForm']['description'] 			= $rowut["description"];			
		
	}
	
}
else
{
	
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update Educational Details";
}
else
{
	$pagetitle = "Add New Educational Details";
}

?>

<!-- RWS Header Starts -->

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
		<div class="container"><h1><?php echo $pagetitle; ?></h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)"><?php echo $pagetitle; ?></a>
            </div>
        </div>
    </div>
</div>

<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
	<div class="container">
    <div class="row">
    	<div class="col-md-4">
        	<?php include("app/jobseekers-leftmenu.php"); ?>        	
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">
        <?php
    		$query="SELECT * FROM ss_jobseekers_education WHERE js_id=".$_SESSION["USER"]['ID']." ORDER BY add_date DESC LIMIT 0, 200";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
            <!--    <div class="mtitle">Educational History <span class="rws-addnewitem"><a href="jobseekers-education-add.php">Add New</a></span></div>   -->
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>School</th>
                                <th>Degree</th>
                                <th>Start Year</th>
                                <th>End Year</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["school"]; ?></td>
                                <td><?php echo $row["degree"]; ?></td>
                                <td><?php echo $row["start_year"]; ?></td>
                                <td><?php echo $row["end_year"]; ?></td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    

                </div>
                </div>
            </div>
            <?php } ?>
            
        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        
        	<div class="rws-module">
                <div class="rws-mcontent">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>


                <div class="mtitle">Educational History <span class="rws-addnewitem">
					
			<!--	<a href="jobseekers-education-add.php">Add New</a>    -->   </span>
			
			</div><br>  


                	<div class="rws-fields">   
                    	<label class="rws-flabel">School / University<span>*</span></label>
                        <input type="text" name="school" value="<?php echo $_SESSION['myForm']["school"];?>" placeholder="*School / University" required />
                        <input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields">  
                    	<label class="rws-flabel">Degree<span>*</span></label>  
                        <input type="text" name="degree" id="degree" value="<?php echo $_SESSION['myForm']["degree"];?>" placeholder="*Degree" required/>       
                    </div>
            		<!-- Row Ends --> 
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Start Year<span>*</span></label>
                             <input type="text" name="start_year" id="start_year" value="<?php echo $_SESSION['myForm']["start_year"];?>" placeholder="Start Year" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">End Year<span>*</span></label>
                            <input type="text" name="end_year" id="end_year" value="<?php echo $_SESSION['myForm']["end_year"];?>" placeholder="End Year" required/>
                        </div>        
                    </div>
            		<!-- Row Ends --> 
                    
                    <div class="rws-fields"> 
                    	<label class="rws-flabel">Description</label>  
                    	<textarea name="description" placeholder="Description"><?php echo $_SESSION['myForm']["description"];?></textarea>
                    </div>
                	<!-- Row Ends -->
                    
                    
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />  
					<input type="button" value="Next" onClick="document.location.href='jobseekers-passport.php'" class="rwsbutton width_100" />   
                </div>
            </div>
            
            </form>
        </div>
        
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->

<!-- RWS Footer Starts --> 