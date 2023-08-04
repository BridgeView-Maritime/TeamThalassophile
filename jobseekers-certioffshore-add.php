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

unset($_SESSION['myForm']);

if(isset($_POST["rwsformsubmit"]))
{
	$_SESSION['myForm'] = $_POST;
	
	if (empty($_POST['offname']) ) 		{	$errors[]="Please select certificate name field.";		}	
	
	$offname = $_POST["offname"];


		$checkoff="select * from addoffshore where certificate='".$offname."' AND js_id='".$_SESSION["USER"]['ID']."' ";
		$result = $db->query($checkoff);
		$offrows = $result->num_rows;

		if($offrows>0){

			$errors[]='You have already added the <em>'.$offname.'</em> certificate.'; 

		
	
		}
		
		
	if(empty($errors)) 
	{
		//    $offname 				= $_POST["offname"];									
			$post_id 				= $_POST["post_id"];
            $number			    	= $_POST["number"];	
            $issue_auth             = $_POST["issue_auth"];
			$issue_date             = $_POST["issue_date"];
			$expiry_date            = $_POST["expiry_date"];
		
						
			/* Update Data To Database */
			if($post_id>0)
			{
				$update_query = "UPDATE `addoffshore` SET js_id = '".$_SESSION["USER"]["ID"]."', certificate = '$offname', number = '$number', issue_auth = '$issue_auth', issuedate = '$issue_date', expdate = '$expiry_date'  WHERE `id`='$post_id' AND `js_id`=".$_SESSION["USER"]['ID'];
				
				$update_result = $db->query($update_query);	
				
				if($update_result){	
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your certificate has been updated.</div>';	

				}
				
			}
			else
			{
			
				$update_query = "INSERT INTO `addoffshore` SET js_id = '".$_SESSION["USER"]["ID"]."', certificate = '$offname', number = '$number', issue_auth = '$issue_auth', issuedate = '$issue_date', expdate = '$expiry_date' ";
				$update_result = $db->query($update_query);	
				
			//	$emp_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your certificate has been added.</div>';	
			}
			
		
		
			$js_id = $_SESSION["USER"]['ID'];
			
			
			echo "<script>document.location.href='".$baseurl."jobseekers-certioffshore-add.php'</script>";
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
		$select_query = 'SELECT * FROM `addoffshore` WHERE `id`="'.$post_id.'" ';
		$select_result = $db->query($select_query);
		$rowut = $select_result->row;
		
		$_SESSION['myForm']['certificate'] 		= $rowut["certificate"]; 
		$_SESSION['myForm']['number'] 			= $rowut["number"];
		$_SESSION['myForm']['issue_auth'] 		= $rowut["issue_auth"];
		$_SESSION['myForm']['issuedate'] 	    = $rowut["issuedate"];
		$_SESSION['myForm']['expdate'] 			= $rowut["expdate"];	
		
	}
	
}
else
{
	
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update Certificate Details";
}
else
{
	$pagetitle = "Add New Certificate Details";
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

          <!---------------show data table----------->

		  <?php
    		$query="SELECT * FROM addoffshore WHERE js_id=".$_SESSION["USER"]['ID']." ";	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
               <!-- <div class="mtitle">Passpost Data <span class="rws-addnewitem"><a href="jobseekers-education-add.php">Add New</a></span></div>   -->
                
                <div class="mtitle"> Offshore Details <span class="rws-addnewitem"></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Certificate Name</th>
                                <th>Certificate Number</th>
                                <th>Date Of Issue</th>
                                <th>Date Of Expire</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["certificate"]; ?></td>
                                <td><?php echo $row["number"]; ?></td>
						<td><?php echo date('d-m-Y',strtotime($row['issuedate']));?></td>
                        <td><?php echo date('d-m-Y',strtotime($row['expdate']));?></td>
                       <!--     <td><?php echo $row["issuedate"]; ?></td>
                                <td><?php echo $row["expdate"]; ?></td>    -->
								<td>
                                <a href="?post_id=<?php echo $row['id']; ?>"
                                   post_id="<?php  echo $row["id"]; ?>" 
                                   title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                 </td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    

                </div>
                </div>
            </div>
            <?php } ?>
        
        

        <!---------------------end-------------------->




        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        
        	<div class="rws-module">
                <div class="rws-mcontent">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>

			   <label class="rws-flabel"><h4>ADD CERTIFICATE OF OFFSHORE <span>*</span></h4> </label> 
                		<br>	<br>


                	<div class="rws-fields">   
					<label class="rws-flabel">Select Certificate<span>*</span></label>		                  	
                        <?php //echo todisplaymultiplewithgroupname($array_competency_certificate, $array_course_certificate, $array_medical_certificate, $array_endorsements_certificate, $array_national_certificate, "", "Competency Certificate, Courses, Medical, Endorsements, National Documents", 'name', "Select Certificate", $_SESSION['myForm']["name"], $onchange="required"); ?>
                      
						<?php
						
						$certioff ="select * from ss_offcertificate where certificate!='' GROUP BY certificate order by certificate ASC";
						$result = $db->query($certioff);
						$rowlist = $result->rows;
						?>

						<select name="offname" id="offname">
				<!--		<option selected ><?php echo $_SESSION['myForm']['certificate']; ?></option>   -->
							<option selected>Select Certificate	</option>	
						<?php
							foreach($rowlist as $key => $row)
							{
								if($row['certificate']== $_SESSION['myForm']['certificate']){
                                    echo "<option  value='". $row['certificate'] ."' selected>" .$row['certificate'] ."</option>"; 
                                    }else{
								echo "<option  value='". $row['certificate'] ."'>" .$row['certificate'] ."</option>"; 
									}
							}	
						?>  
						</select>         
					
					

						<input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
                    </div>
                	<!-- Row Ends -->

					<div class="rws-fields row">    
				    	<div class="col-sm-6">
                            <label class="rws-flabel">Certificate Number<span>*</span></label>                          
                            <input type="text" name="number" value="<?php echo	$_SESSION['myForm']['number'];  ?>" placeholder="Certificate Number*" required />                        
                        </div>        

						<div class="col-sm-6">
                            <label class="rws-flabel">Issue Authority<span>*</span></label>                          
                            <input type="text" name="issue_auth"  value="<?php echo	$_SESSION['myForm']['issue_auth'];  ?>" placeholder="Issue Authority*" required/>                        
                        </div>        
					</div>

                	<div class="rws-fields row">    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Issue Date<span>*</span></label>
                            <input type="date" name="issue_date" value="<?php echo	$_SESSION['myForm']['issuedate'];  ?>"  placeholder="Issue Date*" required/>
                        </div>       
						
						<div class="rws-fields row">    
                        <div class="col-sm-6">
						<label class="rws-flabel">Expiry Date<span>*</span></label>
                 <!--        <input type="text" class="gtexpirycertificate" name="expiry_date" id="expiry_date" value="<?php echo $_SESSION['myForm']["expdate"];?>" placeholder="*Expiry Date"/>   -->
                             <input type="date" class="gtexpirycertificate" name="expiry_date" id="expiry_date" value="<?php echo $_SESSION['myForm']["expdate"];?>" required/>
							</div>                                  
                    </div>

                       
                    </div>
					

                    
                 
                    
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" /> &nbsp;&nbsp; 
			<!--		<input type="button" name="rwsformsubmit" id="rwsformsubmit" value="Back" onClick="document.location.href='jobseekers-certificate.php'" class="rwsbutton width_100" />    -->
					<input type="button" name="rwsformsubmit" id="rwsformsubmit" value="Next" onClick="document.location.href='jobseekers-certiothers-add.php'" class="rwsbutton width_100" />  
                   
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