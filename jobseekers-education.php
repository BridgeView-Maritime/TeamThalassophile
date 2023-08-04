<?php include("includes/config.php");  $gtpage = "Jobseeker";
checkuserlogin(); 
?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts --> 
<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Manage Educational History</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Manage Educational History</a>
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
    		$query="SELECT * FROM ss_jobseekers_education WHERE js_id=".$_SESSION["USER"]['ID']." ORDER BY add_date DESC LIMIT 0, 200";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Educational History <span class="rws-addnewitem"><a href="jobseekers-education-add.php">Add New</a></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	<?php if($foundnum>0) { ?>
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>School</th>
                                <th>Degree</th>
                                <th>Start Year</th>
                                <th>End Year</th>  
                                <th>#</th>
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
                                <td><a href="jobseekers-education-add.php?post_id=<?php echo $row["id"]; ?>">Edit</a></td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    <?php } else { echo '<div id="rws-formfeedback">There is no education history added by you.</div>'; }?>

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