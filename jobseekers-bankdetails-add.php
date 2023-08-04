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

  

			$name 				= $_POST["name"];
			$accountno 			= $_POST["accountno"];
			$code 		        = $_POST["code"];
			$bank_name 			= $_POST["bank_name"];
			$bank_address		= $_POST["bank_address"];
           			
			$post_id 		    = $_GET["post_id"];			

			/* Update Data To Database */
			if($post_id>0)
			{
				$update_query = "UPDATE `bank_details` SET js_id = '".$_SESSION["USER"]['ID']."', name = '$name', accountno = '$accountno', code = '$code', bank_name = '$bank_name', bank_address = '$bank_address' WHERE `id`='$post_id' 
                AND `js_id`=".$_SESSION["USER"]['ID'];
				
				$update_result = $db->query($update_query);	
				
			//	$emp_id = $post_id;

            if($update_result){
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your bank details has been updated.</div>';	

            }
				
			}
			else
			{
				$update_query = "INSERT INTO `bank_details` SET js_id = '".$_SESSION["USER"]['ID']."', name = '$name', accountno = '$accountno', code = '$code', bank_name = '$bank_name', bank_address = '$bank_address' ";
				$update_result = $db->query($update_query);	
				
			//	$emp_id = $db->getLastId();
				
				$_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your bank details has been added.</div>';	
			}
			
			$js_id = $_SESSION["USER"]['ID'];
			
			echo "<script>document.location.href='".$baseurl."jobseekers-bankdetails-add.php'</script>";
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
		$select_query = 'SELECT * FROM `bank_details` WHERE `id`="'.$post_id.'" ';
		$select_result = $db->query($select_query);
		$rowut = $select_result->row;
		
		$_SESSION['myForm']['name'] 				= $rowut["name"];
		$_SESSION['myForm']['accountno'] 		    = $rowut["accountno"];
		$_SESSION['myForm']['code'] 			    = $rowut["code"];
		$_SESSION['myForm']['bank_name'] 	        = $rowut["bank_name"];
		$_SESSION['myForm']['bank_address'] 	    = $rowut["bank_address"];		
     
        	
		
	}
	
}
else
{
	
}

if(!empty($_GET["post_id"]))
{
	$pagetitle = "Update Bank Details";
}
else
{
	$pagetitle = "Add Bank Details";
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
    		$query="SELECT * FROM bank_details WHERE js_id=".$_SESSION["USER"]['ID']." ";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
           <div class="mtitle">Bank Details <span class="rws-addnewitem"></span></div>   
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Account Holder Name</th>
                                <th>Account No</th>
                                <th>Swift/IFSC Code</th>
                                <th>Bank Name</th>
                                <th>Bank Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["accountno"]; ?></td>
                                <td><?php echo $row["code"]; ?></td>
                                <td><?php echo $row["bank_name"]; ?></td>
                                <td><?php echo $row["bank_address"]; ?></td>
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


             <div class="mtitle">Bank Details <span class="rws-addnewitem"></span></div><br>   
                    
                   <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Name Account Holder<span>*</span></label>
                             <input type="text" name="name" id="name" value="<?php echo $_SESSION['myForm']["name"];?>" placeholder="Name Account Holder" required/>
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Account No<span>*</span></label>
                            <input type="text" name="accountno" id="accountno" value="<?php echo $_SESSION['myForm']["accountno"];?>" placeholder="Account No" />
                        </div>        
                    </div>

                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Swift/IFSC Code<span>*</span></label>
                             <input type="text" name="code" id="code" value="<?php echo $_SESSION['myForm']["code"];?>"  placeholder="Swift/IFSC Code" />
                        </div>                    
                        <div class="col-sm-6">
                        	<label class="rws-flabel">Bank Name<span>*</span></label>
                            <input type="text" name="bank_name" id="bank_name" value="<?php echo $_SESSION['myForm']["bank_name"];?>" placeholder="Bank Name" />
                        </div>        
                    </div>
           

                    <div class="rws-fields"> 
                    	<label class="rws-flabel">Bank Address</label>  
                    	<textarea name="bank_address"  id="bank_address" placeholder="Enter Address"><?php echo $_SESSION['myForm']["bank_address"];?></textarea>
                    </div>                 

                 
                	<!-- Row Ends -->
                    
                    
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />  
					<input type="button" value="Next" onClick="document.location.href='jobseekers-generate-cv.php'" class="rwsbutton width_100" />   
                </div>
            </div>
            
            </form>
        </div>
        
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->

<!-- RWS Footer Starts --> 