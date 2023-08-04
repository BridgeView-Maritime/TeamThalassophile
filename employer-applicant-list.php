<style>
	table tr th{
		text-align:center;
	}
	table {
		text-align:center;
	}
</style>



<?php include("includes/config.php");  $gtpage = "employer-applicant-list";
checkemplogin(); 
checkemploginrole("Admin,Standard");


if(isset($_GET['Action']))
{
	$action 	= $_GET['Action'];
	$post_id	= $_GET['post_id'];
	
	switch($action)
	{
		case 'Delete':	
			$sql="DELETE FROM `ss_jobseekers_jobapplied` WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been deleted successfully.</div>';	
			
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;
				
		break;
		
		case 'Shortlist':				
			$sql="UPDATE `ss_jobseekers_jobapplied` SET `status`='2', `assigned_date`='$gtcurrenttime' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been enabled successfully.</div>';	
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;	
		break;
		
		case 'Hire':				
			$sql="UPDATE `ss_jobseekers_jobapplied` SET `status`='4', `assigned_date`='$gtcurrenttime' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been disabled successfully.</div>';	
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;	
		break;
		
		case 'Reject':				
			$sql="UPDATE `ss_jobseekers_jobapplied` SET `status`='3', `assigned_date`='$gtcurrenttime' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been disabled successfully.</div>';	
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;	
		break;
	}
	
	
}

// ORDER BY 
			$orderfield = $_GET["field"];
			$orderby = $_GET["order"];
			
			if($orderfield !="") {
				$orderby2 = " ORDER BY $orderfield $orderby ";	
			}
			else
			{	
				$orderby2 = ' ORDER BY add_date DESC ';
			}
		 
		 	$urlconditions = "";
			$conditon = "";
			
		 				
    		if(!empty($_GET["job_id"]))
			{
				$job_id = $_GET["job_id"];
				$conditon .= " AND t1.job_id='$job_id'";				
				$urlconditions .= "&job_id=".$_GET["job_id"];
				
				$pagetitle = "Manage Job Applicants for ".togetfieldvalue("jobtitle", "ss_employer_jobs", " `id`=".$_GET["job_id"]);
				
			}
			else
			{
				$pagetitle = "Manage Job Applicants";
			}
			
?>


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
        	<?php include("app/employer-leftmenu.php"); ?>        	
        </div>
        
         <?php		 
		 	
		 
    		$query="SELECT t1.*, t2.fullname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category, t3.job_type, t3.vessel, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id WHERE t1.emp_id=".$_SESSION["EMP"]['ID']." $conditon ";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
			
			$per_page = 10;
				
			$max_pages = ceil($foundnum / $per_page);	
		
			$pagenum = trim($_GET['PageNo']);	
		
			$max_pages = ceil($foundnum / $per_page);	
		
			$pagenum = trim($_GET['PageNo']);
		
			if(is_numeric($pagenum))				
			{				
				if($pagenum >= $max_pages) { $pageshow = $max_pages; }				
				elseif($pagenum < $max_pages && $pagenum > 0) { $pageshow = $pagenum; } 				
				elseif($pagenum <= 0) { $pageshow = '1'; }				
				else { $pageshow = '1';	 }				
			}				
			else				
			{				
				$pageshow = '1';				
			}
		
			if($pageshow==0) { $begin = $pageshow; } else { $begin = $pageshow - 1; }				
			$start = $begin * $per_page;				
			if(!$start)				
			$start=0;
		
			/*echo $query." ORDER BY $orderfield $orderby LIMIT $start, $per_page";
		
			echo "<br>";
		
			echo $query." ORDER BY add_date DESC LIMIT $start, $per_page";*/
		
			if($orderfield !="") { $final_query = $query." ORDER BY $orderfield $orderby LIMIT $start, $per_page"; }
		
			else { $final_query = $query." ORDER BY apply_date DESC LIMIT $start, $per_page"; }
			
			$result_query = $db->query($final_query);
			
			if($orderfield!="") 
			{ 				
				$urltoshow = $baseurl."employer-applicant-list.php?page=emp&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.$urlconditions;				
				$urltopage = $baseurl."employer-applicant-list.php?page=emp".$urlconditions; 				
			}				
			else 				
			{				
				$urltoshow = $baseurl."employer-applicant-list.php?page=emp&PageNo=".$pagenum.$urlconditions; 				
				$urltopage = $baseurl."employer-applicant-list.php?page=emp".$urlconditions; 				
			}
			$_SESSION["RedirectPageURL"] = $urltoshow;
			if($orderby != "" && $orderby == "ASC")
			{
				$id = '<a href="'.$urltopage.'&field=id&order=DESC" title="Descending Order.">ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_id = '<a href="'.$urltopage.'&field=id&order=DESC" title="Descending Order.">Jobseeker ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_name = '<a href="'.$urltopage.'&field=fullname&order=DESC" title="Descending Order.">Name <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_email = '<a href="'.$urltopage.'&field=email&order=DESC" title="Descending Order.">Email <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_jobtitle = '<a href="'.$urltopage.'&field=jobtitle&order=DESC" title="Descending Order.">Rankname<i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$present_rank = '<a href="'.$urltopage.'&field=jobtitle&order=ASC" title="Ascending Order.">Applied Rank <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_category = '<a href="'.$urltopage.'&field=section&order=DESC" title="Descending Order.">Category <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_vessel = '<a href="'.$urltopage.'&field=job_type&order=DESC" title="Descending Order.">Vessel Type <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_applydate = '<a href="'.$urltopage.'&field=apply_date&order=DESC" title="Descending Order.">Apply Date<i class="fa fa-sort" aria-hidden="true"></i></a>';		
				$show_status = '<a href="'.$urltopage.'&field=status&order=DESC" title="Descending Order.">Status <i class="fa fa-sort" aria-hidden="true"></i></a>';	
									
			}
			else
			{
				$id = '<a href="'.$urltopage.'&field=id&order=DESC" title="Descending Order.">ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_id = '<a href="'.$urltopage.'&field=id&order=ASC" title="Ascending Order.">Jobseeker ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_name = '<a href="'.$urltopage.'&field=fullname&order=ASC" title="Ascending Order.">Name <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_email = '<a href="'.$urltopage.'&field=email&order=ASC" title="Ascending Order.">Email <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_jobtitle = '<a href="'.$urltopage.'&field=jobtitle&order=ASC" title="Ascending Order.">Rankname<i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$present_rank = '<a href="'.$urltopage.'&field=jobtitle&order=ASC" title="Ascending Order.">Applied Rank <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_category = '<a href="'.$urltopage.'&field=section&order=ASC" title="Ascending Order.">Category <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_vessel = '<a href="'.$urltopage.'&field=job_type&order=ASC" title="Ascending Order.">Vessel Type <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_applydate = '<a href="'.$urltopage.'&field=apply_date&order=ASC" title="Ascending Order.">Apply Date<i class="fa fa-sort" aria-hidden="true"></i></a>';		
				$show_status = '<a href="'.$urltopage.'&field=status&order=ASC" title="Ascending Order.">Status <i class="fa fa-sort" aria-hidden="true"></i></a>';		
						
			}
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Applicant List </div>
                <div class="rws-mcontentlist">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	<?php if($foundnum>0) { ?>
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
							    <th align="left" valign="top"><?php echo $id; ?></th> 
                                <th align="left" valign="top"><?php echo $show_id; ?></th> 
                                <th align="left" valign="top"><?php echo $show_name; ?></th>
                                <th align="left" valign="top"><?php echo $show_jobtitle; ?></th>
						<!--	<th align="left" valign="top"><?php echo $present_rank; ?></th>   -->
                                <th align="left" valign="top"><?php echo $show_category; ?></th>
                                <th align="left" valign="top"><?php echo $show_vessel; ?></th>
                                <th align="left" valign="top"><?php echo $show_applydate; ?></th> 
                                <th align="left" valign="top"><?php echo $show_status; ?></th> 
                          <!--      <th align="left" valign="top" width="95">Action</th>    -->
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $result_query->rows;
						$i=1; $j=1; foreach($rowlist as $key => $row) { 
						
						if($row["section"]=="Shore") { $showcategory = $array_category_shore[$row["category"]]; } else { $showcategory = $array_category_offshore[$row["category"]]; }				
						
						if($row["status"]==1) { $class="rwspending"; $statustext='Pending'; }
						if($row["status"]==2) { $class="rwsshort"; $statustext='Shortlist'; }
						if($row["status"]==3) { $class="rwsreject"; $statustext='Reject'; }
						if($row["status"]==4) { $class="rwshire"; $statustext='Hire'; }	
						
						?>
                        	<tr <?php echo $gtclasstr;?>>
							    <td  valign="top"><?php echo $i++; ?></td>
                            	<td  valign="top"><?php echo $row["id"]; ?></td>
                                <td  valign="top"><a href="<?php echo $baseurl;?>emp-jobseeker-details.php?post_id=<?php echo $row["js_id"]; ?>"><?php echo ucwords(strtolower($row["fullname"])); ?></a></td>
                                <td  valign="top"><?php echo $row["jobtitle"]; ?></td>
						<!--	<td align="left" valign="top"><?php echo $row["present_rank"]; ?></td>   -->
                                <td  valign="top"><?php echo $row["category"];?></td>
                                <td  valign="top"><?php echo  $row["vessel"]; ?></td>
                                <td  valign="top"><?php echo toshowdatetime($row["apply_date"]); ?></td>
                                <td  valign="top" class="<?php echo $class;?>"><?php echo $statustext; ?></td>
                               <!--     <td align="left" valign="top" class="rws-actionbtns">
                             <p><a href="<?php echo $baseurl;?>emp-jobseeker-details.php?post_id=<?php echo $row["js_id"]; ?>" class="btn btn-primary">Details</a></p>   
						 </td>     -->
						<!--		 <p><a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Shortlist&post_id=<?php echo $row["js_id"]; ?>', 'Shortlist Applicant');" class="btn btn-info">Pending</a></p>
								
                                <p><a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Shortlist&post_id=<?php echo $row["js_id"]; ?>', 'Shortlist Applicant');" class="btn btn-info">Shortlist</a></p>
                                <p><a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Hire&post_id=<?php echo $row["js_id"]; ?>', 'Hire Applicant');" class="btn btn-success">Hire</a></p>
                                <p><a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Reject&post_id=<?php echo $row["js_id"]; ?>', 'Reject Applicant');" class="btn btn-danger">Reject</a></p>    -->
                                
                                
                            
                          </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                	<div class="rws-statitics rws-pagination">
                    	<?php echo generate_pagination_new($urltoshow, $max_pages, $pagenum, $foundnum, $per_page, $pageshow, $start); ?>
                    </div>
                    <?php } else { echo '<div id="rws-formfeedback">There are no Job Applicants for posted Jobs.</div>'; }?>

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
<!-- RWS Footer Starts --> 