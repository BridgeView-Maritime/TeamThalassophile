
<?php include("includes/config.php");  $gtpage = "Employer-Post-marine-Job"; $gtjqueryui = "Yes"; $gtckeditor = "Yes";

checkemplogin(); 
checkemploginrole("Admin");
unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
    if (empty($_POST['category']) ) 		{	$errors[]="Please fill out the category field.";	   }
	if (empty($_POST['jobarea']) ) 		    {	$errors[]="Please fill out the jobtitle field.";		}
	if (empty($_POST['jobtitle']) ) 		{	$errors[]="Please fill out the jobtitle field.";		}	
	if (empty($_POST['company_name']) ) 	{	$errors[]="Please fill out the company nmae field.";	}
	//if (empty($_POST['job_type']) ) 		{	$errors[]="Please fill out the job type field.";		}
	//if (empty($_POST['ship_type']) ) 		{	$errors[]="Please fill out the ship type field.";		}	

	
	if (empty($_POST['currency']) )			{	$errors[]="Please fill out the currency field.";		}	
	if (empty($_POST['period']) ) 			{	$errors[]="Please fill out the period field.";		}
	if (empty($_POST['salary']) ) 		    {	$errors[]="Please fill out the end date field.";		}
    if (empty($_POST['area_of_operation']) ){	$errors[]="Please fill out the start year field.";		}
    if (empty($_POST['experience']) ) 		{	$errors[]="Please fill out the experience field.";		}
	if (empty($_POST['contract']) ) 		{	$errors[]="Please fill out the contract field.";		}
    if (empty($_POST['vessel']) ) 		    {	$errors[]="Please fill out the vessel field.";		}
    if (empty($_POST['description']) ) 		{	$errors[]="Please fill out the description field.";		}
    if (empty($_POST['end_date']) ) 		{	$errors[]="Please fill out the approximate joining field.";	    }
    if (empty($_POST['person_email']) ) 	{	$errors[]="Please fill out the Contact Person Email field.";		}
   
   
	//if (empty($_POST['compensation_from']) ){	$errors[]="Please fill out the compensation from field.";		}	
	//if (empty($_POST['compensation_to']) ) 	{	$errors[]="Please fill out the compensation to field.";		}	
		
	//if (empty($_POST['start_date']) ) 		{	$errors[]="Please fill out the start date field.";		}	
	
	
	//if (empty($_POST['skills']) ) 			{	$errors[]="Please fill out the skills field.";		}

	//if (empty($_POST['person_name']) ) 		{	$errors[]="Please fill out the Contact Person Name field.";		}
	
	//if (empty($_POST['person_phone']) ) 	{	$errors[]="Please fill out the Contact Person Phone field.";		}
	
/*	$startdate 		= $_POST['start_date'];		
	$enddate		= $_POST['end_date'];	
	$todaydate		= date("Y-m-d");
	
	$tpdate1 = strtotime($startdate);
	$tpdate2 = strtotime($todaydate);
	$interval2 = $tpdate1 - $tpdate2;
	$tdays = floor($interval2 / 86400);
	
	if($tdays<-1)
	{
		$errors[]='The selected start date be earlier than today date.';
	}
	
	$tpdate1 = strtotime($enddate);
	$tpdate2 = strtotime($startdate);
	$interval2 = $tpdate1 - $tpdate2;
	$tdays = floor($interval2 / 86400);
	
	if($tdays<0)
	{
		$errors[]='The selected end date be earlier than start date.';
	}   
    */
	
	
	//if (empty($_POST['swing_length']) ) 	{	$errors[]="Please fill out the start year field.";		}
	
	//if (empty($_POST['client']) ) 			{	$errors[]="Please fill out the start month field.";		}	
	
	
	/*if (empty($_POST['salary_terms']) ) 	{	$errors[]="Please fill out the salary terms field.";		}	
	if (empty($_FILES["image_1"]) ) 		{	$errors[]="Please fill out the salary terms doc field.";		}*/
	
	// checks that profile pic condition
	//$max_file_size="2048";
	
/*	if((!empty($_FILES["image_1"])) && ($_FILES['image_1']['error'] == 0)) {
	// basename -- Returns filename component of path
	$filename = basename($_FILES['image_1']['name']);
	$ext = substr($filename, strrpos($filename, '.') + 1);
	$filesize=$_FILES['image_2']['size'];
	$max_bytes=$max_file_size*1024;	
	$allowtypes=array("doc", "docx", "pdf");
	//Check if the file type uploaded is a valid file type. 
	if (!in_array($ext, $allowtypes)) {
		$errors[]="Salary Terms Document <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .doc, .docx, .pdf.";	
	// check the size of each file
	} elseif($filesize > $max_bytes) {
		$errors[]= "Salary Terms Document: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
	}
	} // if !empty FILES   */
	
	
	
		
	// Employment History Multiple Blank check
	$query 				= $_POST["query"];
		
	$i=0;
	if(trim($query[0])!="")
	{
		foreach($query as $key=>$val)
		{
			if(empty($query[$i]))
			{
				$errors[]="Please fill out the ".($i+1)." Question field.";
			}
			
			$i++;
		}
	}

	
	if(empty($errors)) 
	{
			
			/* Upload Document file */
			
			$array_rand = array("rad", "dfd","met","axz", "yza", "tst", "tms", "lpg","art","mec","efc","mar","kar","lad","mah");
			$rand1 = mt_rand(100,999);
			$rand2 = mt_rand(100000,999999);
			$rand_keys = array_rand($array_rand, 2);

			$year = date("Y");
			$month = date("m");
			$date = date("d");			

			$yearfolder = "salarydoc/".$year;
			$monthfolder = 'salarydoc/'.$year.'/'.$month;
			$datefolder = 'salarydoc/'.$year.'/'.$month.'/'.$date;
			if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('salarydoc/index.html', $yearfolder.'/index.html'); }
			if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('salarydoc/index.html', $monthfolder.'/index.html'); }
			if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('salarydoc/index.html', $datefolder.'/index.html'); }

			$uploadfolder = $datefolder;
			$imgurl = 'salarydoc/'.$year.'/'.$month.'/'.$date.'/';
			
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
			

            $category 					= addslashes($_POST["category"]);
			$jobarea 					= addslashes($_POST["jobarea"]);
			$jobtitle 					= addslashes($_POST["jobtitle"]);
            $company_name 				= addslashes($_POST["company_name"]);
            $currency 					= addslashes($_POST["currency"]);
			$period 					= addslashes($_POST["period"]);
            $salary 					= addslashes($_POST["salary"]);
            $area_of_operation 			= addslashes($_POST["area_of_operation"]);
            $experience 				= addslashes($_POST["experience"]);
			$contract 				    = addslashes($_POST["contract"]);
            $vessel 				    = addslashes($_POST["vessel"]);
            $description 				= addslashes($_POST["description"]);
			$end_date 				    = addslashes($_POST["end_date"]);
        //  $end_date 					= tochangedateformat($_POST["end_date"],"DB");
            $person_email 				= addslashes($_POST["person_email"]);				

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
			
			$emp_id 					= $_SESSION["EMP"]['ID'];			

			/* Update Data To Database */
			if($post_id>0)
			{
				$modify_date 				= $gtcurrenttime;	
				
				$update_query = "UPDATE `ss_employer_jobs` SET jobtitle = '$jobtitle', jobarea = '$jobarea', category = '$category', job_type = '$job_type', location = '$location', description = '$description',vessel = '$vessel', compensation_from = '$compensation_from', compensation_to = '$compensation_to', benefits = '$benefits', how_to_appy = '$how_to_appy', start_date = '$start_date', end_date = '$end_date', currency = '$currency', period = '$period', skills = '$skills', experience = '$experience', contract ='$contract', person_name = '$person_name', person_email = '$person_email', person_phone = '$person_phone', ship_type = '$ship_type', client = '$client', area_of_operation = '$area_of_operation', swing_length='$swing_length', salary_terms = '$salary_terms', salary_terms_doc = '".$imageuploadname[1]."', modify_date = '$modify_date' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
				
				$update_result = $db->query($update_query);	
				
				$job_id = $post_id;
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your job has been updated successfully.</div>';	
				
			}
			else
			{
				$update_query = "INSERT INTO `ss_employer_jobs` SET emp_id = '$emp_id', section = 'Marine', jobtitle = '$jobtitle', category = '$category', jobarea = '$jobarea',description = '$description', end_date = '$end_date', salary = '$salary',company_name = '$company_name',vessel = '$vessel', area_of_operation = '$area_of_operation',currency = '$currency', period = '$period',experience = '$experience', contract ='$contract',person_email = '$person_email', salary_terms_doc = '".$imageuploadname[1]."', status = '1', sort_order = '0', add_date = '$gtcurrenttime'";
				$update_result = $db->query($update_query);	
				
				$job_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your job has been added successfully.</div>';					
				
				/* Send Email To Admin */
				$subject = "Hello Admin, ".$_SESSION["EMP"]['Firstname']." ".$_SESSION["EMP"]['Lastname']." [".$_SESSION["EMP"]['Company']."] has posted a job - $jobtitle successfully on ".$sitename;
				$body = $emailheader.'
		  <tr>
			<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			Hello Admin,<br /><br />
			'.$_SESSION["EMP"]['Company'].' has posted a job '.$jobtitle.' on '.$sitename.'. Please <strong><a href="'.$baseurl.'job-details.php?jobid='.$job_id.'">Click Here</a></strong> to view complete details.<br/><br/>		
			</td>
		  </tr>	  
		  '.$emailfooter;
	
				sendmail($admin_emaildemo_1,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				sendmail($admin_emaildemo_2,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				sendmail($admin_emaildemo_3,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
				/* Send Email To Admin */
				
				
			}
			
			/* Add Multiple Question to Database Code Starts */
			
			$db->query("DELETE FROM `ss_employer_jobs_query` WHERE `job_id`='$job_id' AND `emp_id`='$emp_id'");
			
			$query 				= $_POST["query"];
						
			$i=0;
			foreach($query as $key=>$val)
			{
				
				if(!empty($query[$i]))
				{
					$query_insert = "INSERT INTO `ss_employer_jobs_query` SET job_id = '$job_id', emp_id = '$emp_id', query = '".addslashes($query[$i])."', status = '1', sort_order = '0', add_date = '$gtcurrenttime'";
	
					$update_result = $db->query($query_insert);
				}
				
				$i++;
			}
			
			/* Add Multiple Question to Database Code Ends */

			echo "<script>document.location.href='".$baseurl."employer-job-list.php'</script>";
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
	$select_query = 'SELECT * FROM `ss_employer_jobs` WHERE `id`="'.$post_id.'" AND emp_id = "'.$_SESSION["EMP"]['ID'].'"';
	$select_result = $db->query($select_query);
	$rowut = $select_result->row;
	
    $_SESSION['myForm']['category'] 			= stripslashes($rowut["category"]);
	$_SESSION['myForm']['jobarea'] 		    	= stripslashes($rowut["jobarea"]);
	$_SESSION['myForm']['jobtitle'] 			= stripslashes($rowut["jobtitle"]);
	$_SESSION['myForm']['company_name'] 		= stripslashes($rowut["company_name"]);
    $_SESSION['myForm']['currency'] 			= stripslashes($rowut["currency"]);
	$_SESSION['myForm']['period'] 				= stripslashes($rowut["period"]);
    $_SESSION['myForm']['salary']           	= stripslashes($rowut["salary"]);
    $_SESSION['myForm']['area_of_operation'] 	= stripslashes($rowut["area_of_operation"]);
    $_SESSION['myForm']['experience'] 			= stripslashes($rowut["experience"]);
	$_SESSION['myForm']['contract'] 			= stripslashes($rowut["contract"]);
    $_SESSION['myForm']['vessel'] 			    = stripslashes($rowut["vessel"]);
    $_SESSION['myForm']['description'] 			= stripslashes($rowut["description"]);
	$_SESSION['myForm']['end_date'] 			= stripslashes($rowut["end_date"]);
  //  $_SESSION['myForm']['end_date'] 			= stripslashes(tochangedateformat($rowut["end_date"], "Show"));
    $_SESSION['myForm']['person_email'] 		= stripslashes($rowut["person_email"]);


/*	$_SESSION['myForm']['job_type'] 			= stripslashes($rowut["job_type"]);
	$_SESSION['myForm']['location'] 			= stripslashes($rowut["location"]);
	
	$_SESSION['myForm']['compensation_from'] 	= stripslashes($rowut["compensation_from"]);
	$_SESSION['myForm']['compensation_to'] 		= stripslashes($rowut["compensation_to"]);
	$_SESSION['myForm']['benefits'] 			= stripslashes($rowut["benefits"]);
	$_SESSION['myForm']['how_to_appy'] 			= stripslashes($rowut["how_to_appy"]);
	
	$_SESSION['myForm']['start_date'] 			= stripslashes(tochangedateformat($rowut["start_date"],"Show"));

	$_SESSION['myForm']['ship_type'] 			= stripslashes($rowut["ship_type"]);
	$_SESSION['myForm']['swing_length'] 		= stripslashes($rowut["swing_length"]);
	$_SESSION['myForm']['client'] 				= stripslashes($rowut["client"]);
	
	$_SESSION['myForm']['salary_terms'] 		= stripslashes($rowut["salary_terms"]);
	$_SESSION['myForm']['salary_terms_doc'] 	= stripslashes($rowut["salary_terms_doc"]);
	
	$_SESSION['myForm']['skills'] 				= stripslashes($rowut["skills"]);
	
	$_SESSION['myForm']['person_name'] 			= stripslashes($rowut["person_name"]);
	
	$_SESSION['myForm']['person_phone'] 		= stripslashes($rowut["person_phone"]);  */
	
		
	/* Employment Records */
	$select_query = 'SELECT * FROM `ss_employer_jobs_query` WHERE `job_id`="'.$post_id.'" AND emp_id = "'.$_SESSION["EMP"]['ID'].'"';
	$select_result = $db->query($select_query);
	$empitems = $select_result->rows;
	$emptotal = $select_result->num_rows;
	
	if($emptotal>0)
	{
		foreach($empitems as $key => $rowemp) { 
			$_SESSION['myForm']['query'][] 			= stripslashes($rowemp["query"]);
		}
	}
	
	}
	
}
else
{
	$emptotal = count($_SESSION['myForm']['query']);
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update New Job";
}
else
{
	$pagetitle = "Add New Job";
}

?>


<style>


    .list {
			height: 200px !important;   		
    		overflow-y: auto !important;
    		width:100% !important;
		}


    .nice-select {  width:40% !important; }
    
</style>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
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
        	<?php include("app/employer-leftmenu.php"); ?>        	
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">        
        <form action="employer-dashboard.php" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        <input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
        	<div class="rws-module">
			<div class="mtitle">Post New Job </div>
                <div class="rws-mcontent">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
            
                <div class="row">
               
                <label class="rws-flabel"><span>*</span>Category</label>    <br>                                                  
                        <select name="category"  id="category" class="selectheight">
                          
							<?php  if (($_SESSION['myForm']["category"])=="" ){  ?>
									<option  selected>-- Select Category --</option>
							<?php	 }else{ ?>					    
									<option selected ><?php echo $_SESSION['myForm']["category"];  ?></option>
							<?php	} ?> 

                            <option>Marine</option>
                            <option>Offshore</option>
                            <option>Onshore</option>
							<option>Oil and Gas</option>
                        </select>
                     	<?php //echo todisplay($array_category_offshore, "category", "Select Category", $_SESSION['myForm']["category"], $onchange="required"); ?>
                       
                  
                  <br>  <br>   <br> 

				  		  <!-----start-----select jobarea--------------------->
							<div class="rws-fields">
                        <label class="rws-flabel"><span>*</span> Jobarea</label>    <br> 
                              <?php 
                                    $jobarea="select * from jobarea";
                                    $joba = $db->query($jobarea);
                                    $job = $joba->rows;
                                ?>
                               <select name="jobarea" value="<?php echo $_SESSION['myForm']["jobarea"];  ?>">   
							  
							        <?php  if (($_SESSION['myForm']["jobarea"])=="" ){  ?>
								 			<option  selected>-- Select Jobarea --</option>
							        <?php	 }else{ ?>					    
							                <option selected ><?php echo $_SESSION['myForm']["jobarea"];  ?></option>
							       <?php	} ?>  
    								  
                                  
								  <?php
        								 foreach($job as $key => $jb)
	                                      {
            								echo "<option  value='". $jb['area'] ."'>" .$jb['area'] ."</option>"; 
        								}	
    								?>  
                   
                                 </select> 
                                 </div> <br>   <br> 
					 <!-----end-----select jobarea--------------------->
               
                	<!-- Row Ends -->
                  
                <div class="rws-fields">
                        <label class="rws-flabel"><span>*</span>Rank</label>    <br> 
                               
							<select name="jobtitle" id="jobtitle">   
											
								<option value="">--Select Rank--</option>
													
		
							</select> 
                    </div>     
								
					
					
		
					</div>       
          <br>  <br>
                  
			





                    <!-- Row Ends -->
                 <!--      <label class="rws-flabel"><span>*</span>Offshore Rank</label>
                              <?php 
                                    $country="select * from ss_offshorerank";
                                    $result = $db->query($country);
                                    $rowlist = $result->rows;
                                ?>
                               <select name="jobtitle">   
                               <option selected >-- Select Rank --</option>
    								  
                                    <?php
        								 foreach($rowlist as $key => $row)
	                                      {
            								echo "<option  value='". $row['rankname'] ."'>" .$row['rankname'] ."</option>"; 
        								}	
    								?>  
                   
                                 </select>     

                                
                                 <label class="rws-flabel"><span>*</span>Rings Rank</label>
                              <?php 
                                    $country="select * from ss_rigsrank";
                                    $result = $db->query($country);
                                    $rowlist = $result->rows;
                                ?>
                               <select name="jobtitle">   
                               <option selected >-- Select Rank --</option>
    								  
                                    <?php
        								 foreach($rowlist as $key => $row)
	                                      {
            								echo "<option  value='". $row['rankname'] ."'>" .$row['rankname'] ."</option>"; 
        								}	
    								?>  
                   
                                 </select>      -->
                  
                  

                  <!-- Row Ends -->
                        <div class="rws-fields">
                        <label class="rws-flabel"><span>*</span>Company Name</label>
                     <!--   <input type="text" name="jobtitle" value="<?php //echo $_SESSION['myForm']["jobtitle"];?>" required />  -->
                        <input type="text" name="company_name" value="<?php echo $_SESSION['myForm']["company_name"];?>" required />
                    </div>
                   
                    <!-- Row Ends -->
                    
                 <!--   <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Job type</label>
                            <?php echo todisplay($array_job_type, "job_type", "Select Job type", $_SESSION['myForm']["job_type"], $onchange="required"); ?>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel"><span>*</span>Ship Type</label>
                            <?php echo todisplay($array_shiptype, "ship_type", "Select Ship type", $_SESSION['myForm']["ship_type"], $onchange="required"); ?>
                        </div>        
                    </div>    -->
            		<!-- Row Ends --> 
                    
                   
					<label class="rws-flabel">Offered Salary</label>  
                    <br> 
					
                            	<label class="rws-flabel"><span>*</span>Currency</label>   <br>
                            	<?php echo todisplay($array_salary_currency, "currency", "--Select Currency--", $_SESSION['myForm']["currency"], $onchange=""); ?>
							

								<br> <br> <br> 
                            	<label class="rws-flabel"><span>*</span>Period</label>   <br> 
                            	<?php echo todisplay($array_salary_period, "period", "--Select Period--", $_SESSION['myForm']["period"], $onchange=""); ?>
								
                        
				
                    
                            	<br> <br> <br> 
                            <label class="rws-flabel"><span>*</span>Salary</label>
                            <input type="text" name="salary" value="<?php echo $_SESSION['myForm']["salary"];?>" required />
                         
                    <!--        <div class="col-sm-3">
                                <label class="rws-flabel"><span>*</span>From</label>
                                <input type="number" id="compensation_from" name="compensation_from" placeholder="Compensation From" value="<?php echo $_SESSION['myForm']["compensation_from"];?>" min="100">      
                            </div>                    
                            <div class="col-sm-3">
                                <label class="rws-flabel"><span>*</span>To</label>
                                <input type="number" id="compensation_to" name="compensation_to" placeholder="Compensation From" value="<?php echo $_SESSION['myForm']["compensation_to"];?>" min="100">
                            </div>     -->   
                        
                    <!-- Row Ends --> 

					<br> 
                            	<label class="rws-flabel"><span>*</span>Area of Operation</label><br>
								<?php 
                                    $area_op="select * from area_of_operation";
                                    $areaop = $db->query($area_op);
                                    $area = $areaop->rows;
                                ?>
								   <select name="area_of_operation">   
                              
								   <?php  if (($_SESSION['myForm']["area_of_operation"])=="" ){  ?>
									<option  selected>-- Area of Operation--</option>
							        <?php	 }else{ ?>					    
									<option selected ><?php echo $_SESSION['myForm']["area_of_operation"];  ?></option>
							        <?php	} ?> 
    								  
                                    <?php
        								 foreach($area as $key => $a)
	                                      {
            								echo "<option  value='". $a['op_area'] ."'>" .$a['op_area'] ."</option>"; 
        								}	
    								?>  
                   
                                 </select> 

                          <br>

                      	<!-- Row Ends -->    <br> <br>
                    <div class="rws-fields">
                        <label class="rws-flabel"><span>*</span>Experience Required</label>
                        <input type="text" name="experience" value="<?php echo $_SESSION['myForm']["experience"];?>" required />
                    </div>
                   
                    <!-- Row Ends -->


					<div class="rws-fields">
                        <label class="rws-flabel"><span>*</span>Contract Duration(In Months)</label>
                        <input type="number" name="contract" value="<?php echo $_SESSION['myForm']["contract"];?>" required />
                    </div>
                   
                    <!-- Row Ends -->
                   
                            	<label class="rws-flabel"><span>*</span>Type of Vessel</label>  <br>
                                <?php 
                                    $vessel11="select * from vessel_type";
                                    $result = $db->query($vessel11);
                                    $vessel1 = $result->rows;
                                ?>
                                    <select name="vessel">
                                    
									<?php  if (($_SESSION['myForm']["vessel"])=="" ){  ?>
									<option value="" selected>--Type of Vessel--</option>
							        <?php	 }else{ ?>					    
									<option selected ><?php echo $_SESSION['myForm']["vessel"];  ?></option>
							        <?php	} ?> 
									 
									 <?php                                                                 
                                           foreach($vessel1 as $key => $row)
                                           {
                                             echo "<option  value='". $row['vessel'] ."'>" .$row['vessel'] ."</option>"; 
                                         }	                                                                 
                                            
                                       ?>                                
                                        <option>Other</option>
                                    </select>
                         <br>

                   
                    <div class="rws-fields row">    
                     <!--   <div class="col-sm-6" style="display:none;">
                            <label class="rws-flabel"><span>*</span>Start Date</label>
                            <input type="text" id="start_date" name="start_date" placeholder="Start Date" value="<?php echo date("d-m-Y"); //echo $_SESSION['myForm']["start_date"];?>">      
                        </div>            -->         
						<br>  <br>   <div class="col-sm-12">
                            <label class="rws-flabel"><span>*</span>Approximate Joining Date</label>
                            <input type="date" id="end_date" name="end_date" placeholder="Joining Date" value="<?php echo $_SESSION['myForm']["end_date"];?>">
                        </div>        
                    </div>

                    <div class="rws-fields">   
                    	<label class="rws-flabel"><span>*</span>Job Description</label>
                    	<textarea name="description" id="description" placeholder="Job Description" required><?php echo $_SESSION['myForm']["description"];?></textarea>
                    </div>

                    <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Contact Person Email</label>
                        <input type="email" name="person_email" id="person_email" value="admin@teamthalassohpile.com" placeholder="Contact Person Email" required />
                    </div>
                	                   
                </div>
            </div>
            <!-- Box Ends -->
            		
                    
            <!--        <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Swing Length (in Days, Week or Month)</label>
                        <input type="text" name="swing_length" id="swing_length" value="<?php echo $_SESSION['myForm']["swing_length"];?>" placeholder="Swing Length (in Days, Week or Month)" required />
                    </div>
                
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Client</label>
                            <input type="text" id="client" name="client" placeholder="Client" value="<?php echo $_SESSION['myForm']["client"];?>">      
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Area of Operation</label>
                            <input type="text" id="area_of_operation" name="area_of_operation" placeholder="Area of Operation" value="<?php echo $_SESSION['myForm']["area_of_operation"];?>">
                        </div>        
                    </div>
            	                   
                    <div class="rws-fields">   
                    	<h6>Skills Required</h6> 
                        <input type="text" name="skills" id="skills" value="<?php echo $_SESSION['myForm']['skills']; ?>" placeholder="*Skills Required" required class="taginputsfields"  />
                        <p>Hint: Separate skills with commas or by hitting Enter on your keyboard.</p>
                    </div>
                
                    
                    <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Experience</label>
                        <input type="text" name="experience" id="experience" value="<?php echo $_SESSION['myForm']["experience"];?>" placeholder="Experience" required />
                    </div>
                
                    
                    <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Contact Person Name</label>
                        <input type="text" name="person_name" id="person_name" value="<?php echo $_SESSION['myForm']["person_name"];?>" placeholder="Contact Person Name" required />
                    </div>
                
                    
                    <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Contact Person Email</label>
                        <input type="email" name="person_email" id="person_email" value="<?php echo $_SESSION['myForm']["person_email"];?>" placeholder="Contact Person Email" required />
                    </div>
                
                    
                    <div class="rws-fields">
                    	<label class="rws-flabel"><span>*</span>Contact Person Phone</label>
                        <input type="text" name="person_phone" id="person_phone" value="<?php echo $_SESSION['myForm']["person_phone"];?>" placeholder="Contact Person Phone" required />
                    </div>    -->
                
                    
                
            
      <!--      <h3>Query If Any</h3>
            <?php if($emptotal>0) {
				$ier=0;
				foreach($_SESSION['myForm']["query"] as $key_emp=>$val_emp) 
				{
				?>
                
                <div class="rws-module clonedInput" id="nameinput1">
                <div class="rws-mcontent">
                	<div class="rws-fields">    
                        <p>Your Question <small>(Answer will be recorded in <strong>Yes/No</strong>)</small></p> 
                        <input type="text" name="query[]" value="<?php echo $_SESSION['myForm']["query"][$ier];?>" placeholder="*Question" />
                    </div>
                	
					<!-- Row Ends
                    
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
                        <p>Your Question <small>(Answer will be recorded in <strong>Yes/No</strong>)</small></p> 
                        <input type="text" name="query[]" value="" placeholder="*Question" />
                    </div>
                	<!-- Row Ends 
                    
                    <!-- Row Ends 
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

$("#category").change(function(){

    var cat=$(this).val();

//	alert(cat);

    var action="rankrequest";

    $.ajax({

        method : "POST",

        data : {cat:cat,action:action},

        url  : "employer_postjob_ajax.php",

        success:function(result){

 //        alert(result);

           $("#jobtitle").html(result);

        }

    });

 });

</script>

   