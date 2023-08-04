<style>
	table tr th{
		text-align:center;
	}
	table {
		text-align:center;
	}
</style>


<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile"; $gtjqueryui = "Yes";

checkuserlogin(); 

$_SESSION['myForm']=array();

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
	/*if (empty($_POST['occupation']) ) 	{	$errors[]="Please fill out the occupation field.";		}	
	if (empty($_POST['jobcompany']) ) 	{	$errors[]="Please fill out the company field.";	}
	if (empty($_POST['joblocation']) ) 	{	$errors[]="Please fill out the location field.";		}

	if (empty($_POST['start_month']) ) 	{	$errors[]="Please fill out the start month field.";		}	
	if (empty($_POST['start_year']) ) 	{	$errors[]="Please fill out the start year field.";		}  
	
	$sm_number = $array_months_number[$_POST['start_month']];
	$em_number = $array_months_number[$_POST['end_month']];
	
	if($sm_number<10) { $sm_number = '0'.$sm_number;}
	if($em_number<10) { $em_number = '0'.$em_number;}
	
	if (empty($_POST["currently_work_hear"]) ) 	
	{	
		if (empty($_POST['end_month']) ) 	{	$errors[]="Please fill out the end month field.";		}	
		if (empty($_POST['end_year']) ) 	{	$errors[]="Please fill out the end year field.";		}
		
		$startdate = $_POST['start_year'].'-'.$sm_number.'-01';		
		$enddate = $_POST['end_year'].'-'.$em_number.'-01';	
		
		$tpdate1 = strtotime($enddate);
		$tpdate2 = strtotime($startdate);
		$interval2 = $tpdate1 - $tpdate2;
		$tdays = floor($interval2 / 86400);
		
		if($tdays<0)
		{
			$errors[]='The selected end month and year must be earlier than start month and year.';
		}
		
	}
	else
	{
		if($_POST["post_id"]>0)
		{
			$totalcheck = tocheckdatepresent("id", "ss_jobseekers_employment", " `id`!='".$_POST["post_id"]."' AND `js_id`=".$_SESSION["USER"]['ID']." AND `currently_work_hear`='Yes'");	
		
		if($totalcheck>0) { $errors[]='You have already selected currently working status in previous employment history. If you want to change then please go and edit that employement history and uncheck the currently working status.'; }
		
		}
		else
		{
		$totalcheck = tocheckdatepresent("id", "ss_jobseekers_employment", "`js_id`=".$_SESSION["USER"]['ID']." AND `currently_work_hear`='Yes'");	
		
		if($totalcheck>0) { $errors[]='You have already selected currently working status in previous employment history. If you want to change then please go and edit that employement history and uncheck the currently working status.'; }
		}
		
		
	}  */
	
	

	// Employment History Multiple Blank check
	$jobcompany 			= $_POST["jobcompany"];
	$ship_name 				= $_POST["ship_name"];
	$ship_type 				= $_POST["ship_type"];
	$dp_system 				= $_POST["dp_system"];
	$grt 					= $_POST["grt"];
	$kw 					= $_POST["kw"];
	$position 				= $_POST["position"];
	$sign_on 				= $_POST["sign_on"];
	$sign_off 				= $_POST["sign_off"];
	$currently_work_hear 	= $_POST["currently_work_hear"];
	
	$i=0;
	if(trim($ship_name[0])!="")
	{
		foreach($ship_name as $key=>$val)
		{
		   /* if(empty($ship_name[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." Ship name field.";
			}
			
			if(empty($ship_type[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." Ship type field.";
			}
			
			if(empty($dp_system[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." DP System field.";
			}
			
			if(empty($grt[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." GRT field.";
			}
			
			if(empty($kw[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." KW field.";
			}
			
			if(empty($position[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." position field.";
			}
			
			if(empty($sign_on[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." sign on date field.";
			}
			
			if(empty($sign_off[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." sign off date field.";
			}   */
			
		/*	$tpdate1 = strtotime($sign_off[$i]);
			$tpdate2 = strtotime($sign_on[$i]);
			$interval2 = $tpdate1 - $tpdate2;
			$tdays = floor($interval2 / 86400);   */
			
			if($tdays<0)
			{
				$errors[]='The selected '.($i+1).' Sign Off Date <em>'.$sign_off[$i].'</em> must be a future date compare to <em>'.$sign_on[$i].'</em>.';
			}
			
			/*if(empty($currently_work_hear[$i]))
			{			
				if(empty($end_month[$i]))
				{
					$errors[]="Please fill out the $i employment location field.";
				}
				
				if(empty($end_year[$i]))
				{
					$errors[]="Please fill out the $i employment location field.";
				}
			}*/
			
			$i++;
		}
	}

	
	if(empty($errors)) 
	{
			$occupation 			= $_POST["occupation"];
			$jobcompany 			= $_POST["jobcompany"];
			$joblocation 			= $_POST["joblocation"];
			$start_month 			= $_POST["start_month"];
			$start_year 			= $_POST["start_year"];
			
			if(empty($_POST["currently_work_hear"]))
			{
				$end_month 				= $_POST["end_month"];
				$end_year 				= $_POST["end_year"];
			}
			else
			{
				$end_month 				= "";
				$end_year 				= "";
			}
			
			$description 			= $_POST["description"];
			$currently_work_hear 	= $_POST["currently_work_hear"];	
			
			$post_id 				= $_POST["post_id"];
			
			/*if($currently_work_hear=="Yes") { $db->query($update_query = "UPDATE `ss_jobseekers_employment` SET currently_work_hear = '' WHERE `js_id`=".$_SESSION["USER"]['ID']);  }		*/

			/* Update Data To Database */
			if($post_id>0)
			{
				$update_query = "UPDATE `ss_jobseekers_employment` SET occupation = '$occupation', company = '$jobcompany', location = '$joblocation', start_month = '$start_month', start_year = '$start_year', end_month = '$end_month', end_year = '$end_year', description = '$description', currently_work_hear = '$currently_work_hear', sort_order = '0' WHERE `id`='$post_id' AND `js_id`=".$_SESSION["USER"]['ID'];
				
				$update_result = $db->query($update_query);	
				
				$emp_id = $post_id;
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your employment history has been updated.</div>';	
				
			}
			else
			{
				$update_query = "INSERT INTO `ss_jobseekers_employment` SET js_id = '".$_SESSION["USER"]['ID']."', occupation = '$occupation', company = '$jobcompany', location = '$joblocation',start_month = '$start_month', start_year = '$start_year', end_month = '$end_month', end_year = '$end_year', description = '$description', currently_work_hear = '$currently_work_hear', sort_order = '0', add_date = '$gtcurrenttime'";
				$update_result = $db->query($update_query);	
				
				$emp_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your employment history has been added.</div>';	
			}
			
			$js_id = $_SESSION["USER"]['ID'];
			
			/* Add Employment History to Database Code Starts */
			
			$db->query("DELETE FROM `ss_jobseekers_employment_details` WHERE `js_id`='$js_id' AND `emp_id`='$emp_id'");
			
			$jobcompany 	        = $_POST["jobcompany"];
			$ship_name 				= $_POST["ship_name"];
			$ship_type 				= $_POST["ship_type"];
			$dp_system 				= $_POST["dp_system"];
			$grt 					= $_POST["grt"];
			$kw 					= $_POST["kw"];
			$position 				= $_POST["position"];
			$sign_on 				= $_POST["sign_on"];
			$sign_off 				= $_POST["sign_off"];
			$currently_work_hear 	= $_POST["currently_work_hear"];
			
			$i=0;
			foreach($ship_name as $key=>$val)
			{
				if(!empty($ship_name[$i]))
				{
				$tpdate1 = strtotime($sign_off[$i]);
				$tpdate2 = strtotime($sign_on[$i]);
				$interval2 = $tpdate1 - $tpdate2;
				$tdays = floor($interval2 / 86400);
			
				$query_insert = "INSERT INTO `ss_jobseekers_employment_details` SET company='$jobcompany', js_id = '$js_id', emp_id = '$emp_id', ship_name = '".$ship_name[$i]."', ship_type = '".$ship_type."', dp_system = '".$dp_system[$i]."', grt = '".$grt[$i]."', kw = '".$kw[$i]."', position = '".$position[$i]."', sign_on = '".$sign_on[$i]."',sign_off = '".$sign_off[$i]."' , total_days = '".$tdays."', sort_order = '0', add_date = '$gtcurrenttime'";

				$update_result = $db->query($query_insert);
				}
				
				$i++;
			}
			
			/* Add Employment History to Database Code Ends */

			echo "<script>document.location.href='".$baseurl."jobseekers-employment-history-add.php'</script>";
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
	$select_query = 'SELECT * FROM `ss_jobseekers_employment` WHERE `id`="'.$post_id.'" AND js_id = "'.$_SESSION["USER"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
	$_SESSION['myForm']['occupation'] 			= $rowut["occupation"];
	$_SESSION['myForm']['jobcompany'] 			= $rowut["company"];
	$_SESSION['myForm']['joblocation'] 			= $rowut["location"];
	$_SESSION['myForm']['start_month'] 			= $rowut["start_month"];
	$_SESSION['myForm']['start_year'] 			= $rowut["start_year"];
	$_SESSION['myForm']['end_month'] 			= $rowut["end_month"];
	$_SESSION['myForm']['end_year'] 			= $rowut["end_year"];
	$_SESSION['myForm']['description'] 			= $rowut["description"];
	$_SESSION['myForm']['currently_work_hear'] 	= $rowut["currently_work_hear"];
		
	/* Employment Records */
	$select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE `emp_id`="'.$post_id.'" AND js_id = "'.$_SESSION["USER"]['ID'].'"';
	$select_result = $db->query($select_query);
	$empitems = $select_result->rows;
	$emptotal = $select_result->num_rows;
	
	if($emptotal>0)
	{
		foreach($empitems as $key => $rowemp) { 
			$_SESSION['myForm']['jobcompany'][] 		= $rowemp["jobcompany"];
			$_SESSION['myForm']['ship_name'][] 			= $rowemp["ship_name"];
			$_SESSION['myForm']['ship_type'][] 			= $rowemp["ship_type"];
			$_SESSION['myForm']['dp_system'][] 			= $rowemp["dp_system"];
			$_SESSION['myForm']['grt'][] 				= $rowemp["grt"];
			$_SESSION['myForm']['kw'][] 				= $rowemp["kw"];
			$_SESSION['myForm']['position'][] 			= $rowemp["position"];
			$_SESSION['myForm']['sign_on'][] 			= tochangedateformat($rowemp["sign_on"],"Show");
			$_SESSION['myForm']['sign_off'][] 			= tochangedateformat($rowemp["sign_off"],"Show");
		}
	}
	else
	{
	    	$_SESSION['myForm']['jobcompany'][] 		= "";
			$_SESSION['myForm']['ship_name'][] 			= "";
			$_SESSION['myForm']['ship_type'][] 			= "";
			$_SESSION['myForm']['dp_system'][] 			= "";
			$_SESSION['myForm']['grt'][] 				= "";
			$_SESSION['myForm']['kw'][] 				= "";
			$_SESSION['myForm']['position'][] 			= "";
			$_SESSION['myForm']['sign_on'][] 			= "";
			$_SESSION['myForm']['sign_off'][] 			= "";
	}
	
	}
	
}
else
{
	$emptotal = count($_SESSION['myForm']['ship_name']);
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update Employment History";
}
else
{
	$pagetitle = "Add New Employment History";
}


?>


<style>


    .list {
			height: 200px !important; 
    		overflow-y: auto !important;
    		width:100% !important;
		}

    .nice-select { width:100% !important; }

    

</style>

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

		 <!---------------show data table----------->

		 <?php
    		$query="SELECT * FROM ss_jobseekers_employment_details WHERE js_id=".$_SESSION["USER"]['ID']." ";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
               <!-- <div class="mtitle">Passpost Data <span class="rws-addnewitem"><a href="jobseekers-education-add.php">Add New</a></span></div>   -->
                
                <div class="mtitle">Employment Details <span class="rws-addnewitem"></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Company</th>
                                <th>Ship Name</th>
                                <th>Ship Type</th>
                                <th>Sign On</th>
								<th>Sign Off</th>
								<th>Total Days</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["company"]; ?></td>
                                <td><?php echo $row["ship_name"]; ?></td>
                                <td><?php echo $row["ship_type"]; ?></td>
								
								<td><?php echo date('d-m-Y',strtotime($row['sign_on'])); ?></td>
								<td><?php echo date('d-m-Y',strtotime($row['sign_off'])); ?></td>
                        <!--    <td><?php echo $row["sign_on"]; ?></td>     
						         <td><?php echo $row["sign_off"]; ?></td>   -->
							
								<td><?php echo $row["total_days"]." "."days"; ?></td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    

                </div>
                </div>
            </div>
            <?php } ?>
        
        

        <!---------------------end-------------------->

        <?php
    		$query="SELECT * FROM ss_jobseekers_employment WHERE js_id=".$_SESSION["USER"]['ID']." ORDER BY add_date DESC LIMIT 0, 200";
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>


    <!--    <div class="rws-module">                
                <div class="rws-mcontent">
                    <div class="orderlist">					
                	<?php if($foundnum>0) { ?>
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Occupation</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>From</th>
                                <th>To</th>                               
                                <th>Working Here</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 				
						
						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["occupation"]; ?></td>
                                <td><?php echo $row["company"]; ?></td>
                                <td><?php echo $row["location"]; ?></td>
                                <td><?php echo $row["start_month"]; ?> <?php echo $row["start_year"]; ?></td>
                                <td><?php if(!empty($row["end_year"])) { echo $row["end_month"]; ?> <?php echo $row["end_year"]; } else { echo "-"; } ?></td>
                                <td><?php echo $row["currently_work_hear"]; ?></td>                                
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    <?php } ?>

                </div>
                </div>
            </div>  -->
        
        
        <!--
        	<div class="rws-module">
                <div class="rws-mcontent">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                	<div class="rws-fields">   
                    	<label class="rws-flabel active"><span>*</span>Occupation / Title</label>
                        <input type="text" name="occupation" value="<?php echo $_SESSION['myForm']["occupation"];?>" placeholder="*Occupation / Title" required />
                        <input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
                    </div>
                	
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Company</label>
                             <input type="text" name="jobcompany" id="company" value="<?php echo $_SESSION['myForm']["jobcompany"];?>" placeholder="*Company" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Location</label>
                            <input type="text" name="joblocation" id="location" value="<?php echo $_SESSION['myForm']["joblocation"];?>" placeholder="*Location" required/>
                        </div>        
                    </div>
            		 
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>From</label>
                             <div class="row">
                             	<div class="col-7">
                                	<?php echo todisplay($array_months, "start_month", "Start Month", $_SESSION['myForm']["start_month"], $onchange="required"); ?>
                                </div>
                                <div class="col-5">
                                	<?php echo togetyearemployment("start_year",$_SESSION['myForm']["start_year"],$period=0,$others="required"); ?>
                                </div>
                             </div>
                        </div>                    
                        
                       <div class="col-sm-6">
                       	<label class="rws-flabel">To</label>
                             <div class="row">
                             	<div class="col-7">
                                	<?php echo todisplay($array_months, "end_month", "End Month", $_SESSION['myForm']["end_month"], $onchange=""); ?>
                                </div>
                                <div class="col-5">
                                	<?php echo togetyearemployment("end_year",$_SESSION['myForm']["end_year"],$period=0,$others=""); ?>
                                </div>
                             </div>
                        </div>
                                 
                    </div>
            		
                    
                    <div class="rws-fields">   
                    	<label class="rws-flabel"><span>*</span>Job Description</label>
                    	<textarea name="description" placeholder="Job Description" required><?php echo $_SESSION['myForm']["description"];?></textarea>
                    </div>
                
                    
                    <div class="rws-fields">   
                    	<input type="checkbox" name="currently_work_hear" value="Yes" <?php if($_SESSION['myForm']["currently_work_hear"]=="Yes") { echo "checked"; } ?>> I currently work here.
                    </div>
                	
                    
                </div>
            </div>
             -->
          
          <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">

            <h3>Employment History (If available)</h3>


            <?php if($emptotal>0) {
				$ier=0;
				foreach($_SESSION['myForm']["ship_name"] as $key_emp=>$val_emp) 
				{
				?>
                
                <div class="rws-module clonedInput" id="nameinput<?php echo ($ier+1); ?>">
                <div class="rws-mcontent">				
				
				<div class="rws-fields row">   
					
				
 
                        <div class="col-sm-6"> 
                    		<label class="rws-flabel">Ship Name<span>*</span></label>
                        	<input type="text" name="ship_name[]" value="<?php echo $_SESSION['myForm']["ship_name"][$ier];?>" placeholder="Ship Name" />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Ship Type</label>
                             <?php echo todisplay($array_shiptype, "ship_type[]", "Select Ship Type", $_SESSION['myForm']["ship_type"][$ier], $onchange=""); ?>
                        </div>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">DP System<span>*</span></label>
                             <?php echo todisplay($array_dpsystem, "dp_system[]", "Select DP System", $_SESSION['myForm']["dp_system"][$ier], $onchange=""); ?>
                        </div>                    
                        <!--<div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Position</label>
                            <?php echo todisplay($array_shipworkposition, "position[]", "Select Position", $_SESSION['myForm']["position"][$ier], $onchange=""); ?>
                        </div> -->       
                    </div>
            		<!-- Row Ends --> 
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">GRT<span>*</span></label>
                             <input type="number" name="grt[]" value="<?php echo $_SESSION['myForm']['grt'][$ier]; ?>" placeholder="GRT" />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">KW<span>*</span></label>
                            <input type="number" name="kw[]" value="<?php echo $_SESSION['myForm']['kw'][$ier]; ?>" placeholder="KW" />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row">
                        	<div class="col-sm-6">
                            	<label class="rws-flabel">Sign On<span>*</span></label>
                            	<input type="text" name="sign_on[]" value="<?php echo $_SESSION['myForm']['sign_on'][$ier]; ?>" placeholder="Sign On" class="gtdatedropdown" />
                            </div>
                            <div class="col-sm-6">
                            	<label class="rws-flabel">Sign Off<span>*</span></label>
                            	<input type="text" name="sign_off[]" value="<?php echo $_SESSION['myForm']['sign_off'][$ier]; ?>"  placeholder="Sign Off"  class="gtdatedropdown"/>
                            </div>
                        </div>
                	<!-- Row Ends -->
                    
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

				<div class="col-sm-12 row"><br>
                        	<label class="rws-flabel">Company Name<span>*</span></label>
                             <input type="text" name="jobcompany" id="company" value="<?php echo $_SESSION['myForm']["jobcompany"];?>" placeholder="*Company" required/>
                 </div>
                	<div class="rws-fields row">    
                        <div class="col-sm-6"> 
                    		<label class="rws-flabel">Ship Name</label>
                        	<input type="text" name="ship_name[]" value="" placeholder="*Ship Name" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Ship Type</label>
							
							
							<?php
						
						$shiptype ="select * from shiptype";
						$result = $db->query($shiptype);
						$ship = $result->rows;
						?>

						<select name="ship_type" id="ship_type" required>
				
							<option selected>Select Certificate	</option>	
						<?php
							foreach($ship as $key => $row)
							{
								echo "<option  value='". $row['shiptype'] ."'>" .$row['shiptype'] ."</option>"; 
							}	
						?>  
						</select>     
                       
						
						
						<?php  // echo todisplay($array_shiptype, "ship_type[]", "Select Ship Type", "", $onchange=""); ?>
                        </div>
                    </div>
                	<!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-12">
                        	<label class="rws-flabel">DP System</label>
                             <?php echo todisplay($array_dpsystem, "dp_system[]", "Select DP System","", $onchange=""); ?>
                        </div>                    
                        <!--<div class="col-sm-6">
                            <?php echo todisplay($array_shipworkposition, "position[]", "Select Position", "", $onchange=""); ?>
                        </div>  -->      
                    </div>
            		<!-- Row Ends --> 
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">GRT</label>
                             <input type="number" name="grt[]" value="" placeholder="*GRT" />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">KW</label>
                            <input type="number" name="kw[]" value="" placeholder="*KW" />
                        </div>        
                    </div>
            		<!-- Row Ends -->
                    
                    <div class="rws-fields row">
                        	<div class="col-sm-6">
                            	<label class="rws-flabel">Sign On</label>
                            	<input type="date" name="sign_on[]" value="" placeholder="*Sign On" required/>
                            </div>
                            <div class="col-sm-6">
                            	<label class="rws-flabel">Sign Off</label>
                            	<input type="date" name="sign_off[]" value=""  placeholder="*Sign Off" required/>
                            </div>
                        </div>
                	<!-- Row Ends -->
                    
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
            <?php } ?>
            <!-- Multiple Row Code -->
            
     <!--       <div class="rws-multiplebtnsection">
            	<input type="button" name="rwsaddposition" id="rwsaddposition" class="btn btn-success" value="Add New Employment History" />
            </div>      -->
            <!-- Employment History Ends -->             
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" /> 
					<input type="button" value="Next" onClick="document.location.href='jobseekers-education-add.php'" class="rwsbutton width_100" />    
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