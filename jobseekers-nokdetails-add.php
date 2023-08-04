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
	
	
	if(empty($errors)) 
	{
			$nokname 				= $_POST["nokname"];
			$nokrel 				= $_POST["nokrel"];
			$nokcontact 		    = $_POST["nokcontact"];
			$nokalternate 			= $_POST["nokalternate"];
			$nokaddress		        = $_POST["nokaddress"];
            $nok_emailid		    = $_POST["nok_emailid"];
			$rel_name 			    = $_POST["rel_name"];	
            $rel_contact 			= $_POST["rel_contact"];	
            $rel_address 			= $_POST["rel_address"];	
			
			$post_id 				= $_POST["post_id"];			

			/* Update Data To Database */
			if($post_id>0)
			{
				$update_query = "UPDATE `nokdetails` SET js_id = '".$_SESSION["USER"]['ID']."', nokname = '$nokname', nokrel = '$nokrel', nokcontact = '$nokcontact', nokalternate = '$nokalternate', nokaddress = '$nokaddress', nok_emailid = '$nok_emailid', rel_name = '$rel_name', rel_contact = '$rel_contact',rel_address = '$rel_address' WHERE `id`='$post_id' AND `js_id`=".$_SESSION["USER"]['ID'];
				
				$update_result = $db->query($update_query);	
				
			//	$emp_id = $post_id;

            if($update_result){
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your educational history has been updated.</div>';	

            }
				
			}
			else
			{
				$update_query = "INSERT INTO `nokdetails` SET js_id = '".$_SESSION["USER"]['ID']."', nokname = '$nokname', nokrel = '$nokrel', nokcontact = '$nokcontact', nokalternate = '$nokalternate', nokaddress = '$nokaddress', nok_emailid = '$nok_emailid', rel_name = '$rel_name', rel_contact = '$rel_contact',rel_address = '$rel_address' ";
				$update_result = $db->query($update_query);	
				
			//	$emp_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your educational history has been added.</div>';	
			}
			
			$js_id = $_SESSION["USER"]['ID'];
			
			echo "<script>document.location.href='".$baseurl."jobseekers-nokdetails-add.php'</script>";
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
		$select_query = 'SELECT * FROM `nokdetails` WHERE `id`="'.$post_id.'" ';
		$select_result = $db->query($select_query);
		$rowut = $select_result->row;
		
		$_SESSION['myForm']['nokname'] 				= $rowut["nokname"];
		$_SESSION['myForm']['nokrel'] 			    = $rowut["nokrel"];
		$_SESSION['myForm']['nokcontact'] 			= $rowut["nokcontact"];
		$_SESSION['myForm']['nokalternate'] 	    = $rowut["nokalternate"];
		$_SESSION['myForm']['nokaddress'] 			= $rowut["nokaddress"];		
        $_SESSION['myForm']['nok_emailid'] 			= $rowut["nok_emailid"];
		$_SESSION['myForm']['rel_name'] 		    = $rowut["rel_name"];	
		$_SESSION['myForm']['rel_contact'] 	        = $rowut["rel_contact"];
		$_SESSION['myForm']['rel_address'] 			= $rowut["rel_address"];		

	
		
	}
	
}
else
{
	
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update Nok Details";
}
else
{
	$pagetitle = "Add New Nok Details";
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
    		$query="SELECT * FROM nokdetails WHERE js_id=".$_SESSION["USER"]['ID']." ";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
           <div class="mtitle">Nok Details <span class="rws-addnewitem"></span></div>   
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Nok Name</th>
                                <th>Relation</th>
                                <th>Contact No</th>
                                <th>Emailid</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["nokname"]; ?></td>
                                <td><?php echo $row["nokrel"]; ?></td>
                                <td><?php echo $row["nokcontact"]; ?></td>
                                <td><?php echo $row["nok_emailid"]; ?></td>
                                <td><?php echo $row["nokaddress"]; ?></td>
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
            
        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        
        	<div class="rws-module">
                <div class="rws-mcontent">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>


             <div class="mtitle">NOK Details <span class="rws-addnewitem"></span></div><br>   
                    
                   <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Name of NOK<span>*</span></label>
                             <input type="text" name="nokname" id="nokname" value="<?php echo $_SESSION['myForm']["nokname"];?>" placeholder="Enter Name" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Relation<span>*</span></label>
                            <input type="text" name="nokrel" id="nokrel" value="<?php echo $_SESSION['myForm']["nokrel"];?>" placeholder="Relation" required/>
                        </div>        
                    </div>

                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">NOK Contact No<span>*</span></label>
                             <input type="number" name="nokcontact" id="nokcontact" value="<?php echo $_SESSION['myForm']["nokcontact"];?>"  placeholder="Enter Contact No" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Alternate Conatct No<span>*</span></label>
                            <input type="number" name="nokalternate" id="nokalternate" value="<?php echo $_SESSION['myForm']["nokalternate"];?>" placeholder="Alternate Contact No" required/>
                        </div>        
                    </div>

                    <div class="rws-fields">   
                    	<label class="rws-flabel">Emailid<span>*</span></label>
                        <input type="email" name="nok_emailid" id="nok_emailid" value="<?php echo $_SESSION['myForm']["nok_emailid"];?>" placeholder="*Emailid"  required/>
                        <input type="hidden" name="post_id" value="<?php echo $_GET["post_id"]; ?>" />
                    </div>

                    <div class="rws-fields"> 
                    	<label class="rws-flabel">Address</label>  
                    	<textarea name="nokaddress"  id="nokaddress" placeholder="Enter Address"><?php echo $_SESSION['myForm']["nokaddress"];?></textarea>
                    </div>                 

                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Relative Name<span>*</span></label>
                             <input type="text" name="rel_name" id="rel_name" value="<?php echo $_SESSION['myForm']["rel_name"];?>" placeholder="Enter Relative Name" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Relative Conatct No<span>*</span></label>
                            <input type="number" name="rel_contact" id="rel_contact" value="<?php echo $_SESSION['myForm']["rel_contact"];?>"  placeholder="Enter Conatct No" required/>
                        </div>        
                    </div>

                    
                    <div class="rws-fields"> 
                    	<label class="rws-flabel">Relative Address</label>  
                    	<textarea name="rel_address" id="rel_address" placeholder="Enter Relative Address"><?php echo $_SESSION['myForm']["rel_address"];?></textarea>
                    </div>
                	<!-- Row Ends -->
                    
                    
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />  
					<input type="button" value="Next" onClick="document.location.href='jobseekers-bankdetails-add.php'" class="rwsbutton width_100" />   
                </div>
            </div>
            
            </form>
        </div>
        
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->

<!-- RWS Footer Starts --> 