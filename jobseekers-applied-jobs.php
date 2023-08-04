<?php include("includes/config.php");  $gtpage = "Jobseeker";
checkuserlogin(); 
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
		<div class="container"><h1>Manage Applied Jobs</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Manage Applied Jobs</a>
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
    		
			$query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category,t3.company_name, t3.job_type, t3.vessel, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id WHERE t1.js_id=".$_SESSION["USER"]['ID']." ORDER BY apply_date DESC LIMIT 0, 200";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Applied Jobs</div>
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
                                <th>Vessel Type</th>
                                <th>Company</th> 
                                <th>Status</th>  
                                <th>Apply Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 
						if($row["section"]=="Shore") { $showcategory = $array_category_shore[$row["category"]]; } else { $showcategory = $array_category_offshore[$row["category"]]; }
						
						if($row["status"]==1) { $class="rwspending"; $statustext='Pending'; }
						if($row["status"]==2) { $class="rwsshort"; $statustext='Shortlist'; }
						if($row["status"]==3) { $class="rwsreject"; $statustext='Reject'; }
						if($row["status"]==4) { $class="rwshire"; $statustext='Hire'; }						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><a href="<?php echo $baseurl; ?>job-details.php?jobid=<?php echo $row["job_id"]; ?>" title=""><?php echo $row["jobtitle"]; ?></a></td>
                                <td><?php echo $row["category"]; ?></td>
                                <td><?php echo $row["vessel"]; ?></td>
                                <td><?php echo $row["company_name"]; ?></td>
                                <td class="<?php echo $class;?>"><?php echo $statustext; ?></td>
                                <td><?php echo toshowdatetime($row["apply_date"]); ?></td>
                                <!--<td><a href="jobseekers-education-add.php?post_id=<?php echo $row["id"]; ?>">Edit</a></td>-->
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