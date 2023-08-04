<?php include("includes/config.php");  $gtpage = "Employer-Job-List";
checkemplogin(); 
checkemploginrole("None");

if(isset($_GET['Action']))
{
	$action 	= $_GET['Action'];
	$post_id	= $_GET['post_id'];
	
	switch($action)
	{
		case 'Delete':	
			$sql="DELETE FROM `ss_employer_manager` WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been deleted successfully.</div>';	
			
			echo "<script>document.location.href='employer-team-list.php'</script>";
		exit;
				
		break;
		
		case 'Enable':				
			$sql="UPDATE `ss_employer_manager` SET `status`='1' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been enabled successfully.</div>';	
			echo "<script>document.location.href='employer-team-list.php'</script>";
		exit;	
		break;
		
		case 'Disable':				
			$sql="UPDATE `ss_employer_manager` SET `status`='0' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been disabled successfully.</div>';	
			echo "<script>document.location.href='employer-team-list.php'</script>";
		exit;	
		break;
		
	}
	
	
}

?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts --> 
<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Manage Team</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Manage Team</a>
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
        
         <?php
    		$query="SELECT * FROM ss_employer_manager WHERE emp_id=".$_SESSION["EMP"]['ID']." ORDER BY add_date DESC LIMIT 0, 500";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
			
			$urltoshow = $baseurl."employer-team-list.php?a=1";
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Team Member List <span class="rws-addnewitem"><a href="<?php echo $baseurl; ?>employer-team-add.php">Add New Member</a></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	<?php if($foundnum>0) { ?>
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th align="left" valign="top">Name</th>
                                <th align="left" valign="top">Email</th>
                                <th align="left" valign="top">Role</th>
                                <th align="left" valign="top">Status</th>
                                <th align="left" valign="top">Last Login</th>
                                <th align="left" valign="top"  width="220">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 				
						
						$editlink = "employer-team-add.php";
						
						if($row["status"]==1) { $class="rwsactive"; $statustext='Active'; }
						if($row["status"]==0) { $class="rwsinactive"; $statustext='Inactive'; }
						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td align="left" valign="top"><?php echo $row["firstname"].' '.$row["lastname"]; ?></td>
                                <td align="left" valign="top"><?php echo $row["email"]; ?></td>
                                <td align="left" valign="top"><?php echo $array_emp_team_role[$row["role"]]; ?></td>
                                <td align="left" valign="top" class="<?php echo $class;?>"><?php echo $statustext; ?></td>
                                <td align="left" valign="top"><?php echo toshowdatewithtime($row["last_login"]); ?></td>
                                <td align="left" valign="top" class="rws-actionbtns">
                                <p><a href="<?php echo $editlink;?>?post_id=<?php echo $row["id"]; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Enable&post_id=<?php echo $row["id"]; ?>', 'Active User');" class="btn btn-success" title="Active"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>&nbsp;<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Disable&post_id=<?php echo $row["id"]; ?>', 'Inactive User');" class="btn btn-warning" title="Inactive"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp;<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Delete&post_id=<?php echo $row["id"]; ?>', 'Delete User');" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
                              </td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    <?php } else { echo '<div id="rws-formfeedback">There is no team members added by you.</div>'; }?>

                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>


<div class="modal fade" id="exampleModal_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelstatus" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <form method="post" action="" enctype="multipart/form-data" name="applyform" id="applyform" onsubmit="return validatepopupform();">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelstatus">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="rws-errordisplay"></div>
	  
        <p><span class="messagetoshow">Are you sure want to change the status?</span></p>
        <input type="hidden" name="redirecturl" id="redirecturl" value=""/>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary updatestatus">Update Status</button>
      </div>
    </div>
	</form>
  </div>
</div>

<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->
<?php include("app/gtfooter.php"); ?>
<!-- RWS Footer Starts --> 