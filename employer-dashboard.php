
<style>
	table tr th{
		text-align:center;
	}
	table {
		text-align:center;
	}
</style>


<?php include("includes/config.php");  $gtpage = "Jobseeker"; 
checkemplogin(); 
checkemploginrole("Admin,Standard");
?>

<!-- RWS Header Starts -->

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





<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Hello <?php echo $_SESSION["EMP"]['Firstname']; ?></h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Employer Dashboard</a>
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
    		
			// Qeery to count applicants
			$queryjoin .= " LEFT JOIN (SELECT job_id, COUNT(*) AS totalapplicants FROM ss_jobseekers_jobapplied GROUP BY job_id ) AS t2 ON t1.id = t2.job_id ";
			
    		$query="SELECT t1.*, IFNULL(t2.totalapplicants,0) as totalapplicants FROM ss_employer_jobs as t1 $queryjoin WHERE emp_id=".$_SESSION["EMP"]['ID']." ORDER BY add_date DESC LIMIT 0, 5";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Recent Posted Jobs <span class="rws-addnewitem"><a href="employer-post-marine-job.php" >Post a Job</a></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	<?php if($foundnum>0) { ?>
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Rank</th>
                                <th>Category</th>
                                <th>Vessel type</th>
                                <th>Posted in</th>
                           <!--     <th>End Date</th>   -->
                                <th>Total Applicants</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 				
						
						if($row["section"]=="Shore") { $editlink = "employer-post-shore-jobs.php"; $catarray = $array_category_shore; } else { $editlink = "employer-post-offshore-jobs.php";  $catarray = $array_category_offshore;}
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><a href="<?php echo $baseurl;?>job-details.php?jobid=<?php echo $row["id"]; ?>"><?php echo $row["jobtitle"]; ?></a></td>
                             <!--   <td><?php // echo $catarray[$row["category"]]; ?></td>   -->
                                <td><?php echo $row["category"]; ?></td>
                         <!--    <td><?php echo $array_job_type[$row["job_type"]]; ?></td>    -->
                                <td><?php echo $row["vessel"]; ?></td>
                                <td><?php echo $row["jobarea"]; ?></td>
                          <!--      <td><?php echo $row["end_date"]; ?></td>   -->
                                <td><a href="<?php echo $baseurl; ?>employer-applicant-list.php?job_id=<?php echo $row["id"]; ?>">Applicants [<?php echo $row["totalapplicants"]; ?>]</a></td>                                
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                	<div class="rws-morelinks"><a href="<?php echo $baseurl; ?>employer-job-list.php" title="">View All Posted Jobs</a></div>
                    <?php } else { echo '<div id="rws-formfeedback">There is no job posted by you.</div>'; } ?>

                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->

<!-- RWS Footer Starts --> 