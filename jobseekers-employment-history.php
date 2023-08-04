<?php include("includes/config.php");  $gtpage = "Jobseeker";
checkuserlogin(); 
?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts -->  
<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Manage Employment History</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Manage Employment History</a>
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
        
        <?php
    		$query="SELECT * FROM ss_jobseekers_employment WHERE js_id=".$_SESSION["USER"]['ID']." ORDER BY add_date DESC LIMIT 0, 200";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Employment History <span class="rws-addnewitem"><a href="jobseekers-employment-history-add.php">Add New</a></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
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
                                <th>#</th>
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
                                <td><a href="jobseekers-employment-history-add.php?post_id=<?php echo $row["id"]; ?>">Edit</a></td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    <?php } else { echo '<div id="rws-formfeedback">There is no employment history added by you.</div>'; }?>

                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->
<?php include("app/gtfooter.php"); ?>
<!-- RWS Footer Starts --> 