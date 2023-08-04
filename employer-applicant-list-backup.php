<?php include("includes/config.php");  $gtpage = "Employer-Job-List";
checkemplogin(); 
checkemploginrole("Admin,Standard");
?>

<!-- RWS Header Starts -->
<?php include("app/gtheader.php"); ?>
<!-- RWS Header Starts --> 
<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Manage Job Applicants</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Manage Job Applicants</a>
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
		 $conditon = "";
		 
		 if(!empty($_GET["job_id"]))
		 {
			 $job_id = $_GET["job_id"];
			 $conditon .= " AND t1.job_id='$job_id'";
		 }
		 
    	$query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category, t3.job_type, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id WHERE t1.emp_id=".$_SESSION["EMP"]['ID']." $conditon ORDER BY apply_date DESC LIMIT 0, 200";
	
		$rs = $db->query($query);
		$foundnum = $rs->num_rows;
		
		
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Applicant List</div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	<?php if($foundnum>0) { ?>
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Jobtitle</th>
                                <th>Category</th>
                                <th>Job Type</th>                                 
                                <th>Apply Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 
																		
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["firstname"].' '.$row["lastname"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["mobile"]; ?></td>
                                <td><?php echo $row["jobtitle"]; ?></td>
                                <td><?php echo $showcategory; ?></td>
                                <td><?php echo $array_job_type[$row["job_type"]]; ?></td>                                
                                <td><?php echo $row["apply_date"]; ?></td>
                                <td><a href="jobseekers-education-add.php?post_id=<?php echo $row["id"]; ?>" class="btn btn-">Edit</a></td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    <?php } else { echo '<div id="rws-formfeedback">There is no job applied by you.</div>'; }?>

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