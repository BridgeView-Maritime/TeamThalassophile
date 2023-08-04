<style>
	table tr th{
		text-align:center;
	}
	table {
		text-align:center;
	}
	.pagination li:last-child a {
    width: 80;
	
	}

</style>

<?php include("includes/config.php");  $gtpage = "Employer-Job-List";
checkemplogin(); 
checkemploginrole("Admin,Standard");


if(isset($_GET['Action']))
{
	$action 	= $_GET['Action'];
	//$action = document.getElementById("myInput").value;
	$post_id	= $_GET['post_id'];
	
	switch($action)
	{
		case 'Delete':	
			$sql="DELETE FROM `ss_employer_jobs` WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been deleted successfully.</div>';	
			
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;
				
		break;
		
		case 'Enable':				
			$sql="UPDATE `ss_employer_jobs` SET `status`='1' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been enabled successfully.</div>';	
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;	
		break;
		
		case 'Disable':				
			$sql="UPDATE `ss_employer_jobs` SET `status`='0' WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been disabled successfully.</div>';	
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
		exit;	
		break;
		
		case 'Duplicate':				
			
			$sql="SELECT * FROM `ss_employer_jobs` WHERE `id`='$post_id' AND `emp_id`=".$_SESSION["EMP"]['ID'];
			$rs = $db->query($sql);
			
			$rowut = $rs->row;
			
			$jobtitle 					= addslashes($rowut["jobtitle"]);
			$category 					= addslashes($rowut["category"]);
			$job_type 					= addslashes($rowut["job_type"]);
			$vessel 					= addslashes($rowut["vessel"]);
			$location 					= addslashes($rowut["location"]);
			$country 					= addslashes($rowut["country"]);
			$description 				= addslashes($rowut["description"]);			
			
			$currency 					= addslashes($rowut["currency"]);
			$period 					= addslashes($rowut["period"]);
			$compensation_from 			= addslashes($rowut["compensation_from"]);
			$compensation_to 			= addslashes($rowut["compensation_to"]);
			$benefits 					= addslashes($rowut["benefits"]);
			$skills 					= addslashes($rowut["skills"]);
			
			$experience 				= addslashes($rowut["experience"]);
			$person_name 				= addslashes($rowut["person_name"]);
			$person_email 				= addslashes($rowut["person_email"]);
			$person_phone 				= addslashes($rowut["person_phone"]);
			$how_to_appy 				= addslashes($rowut["how_to_appy"]);
	
			$start_date 				= $rowut["start_date"];				
			$end_date 					= $rowut["end_date"];
			$ship_type 					= addslashes($rowut["ship_type"]);
			$swing_length				= addslashes($rowut["swing_length"]);
			
			$client 					= addslashes($rowut["client"]);
			$area_of_operation 			= addslashes($rowut["area_of_operation"]);
			$salary_terms 				= addslashes($rowut["salary_terms"]);
			$salary_terms_doc 			= addslashes($rowut["salary_terms_doc"]);
			
			$update_query = "INSERT INTO `ss_employer_jobs` SET emp_id = '".$_SESSION["EMP"]['ID']."', section = '".$rowut["section"]."', jobtitle = '$jobtitle', category = '$category', job_type = '$job_type', location = '$location', country = '$country', description = '$description', currency = '$currency', period = '$period', compensation_from = '$compensation_from', compensation_to = '$compensation_to', benefits = '$benefits', skills = '$skills', experience = '$experience', person_name = '$person_name', person_email = '$person_email', person_phone = '$person_phone', how_to_appy = '$how_to_appy', start_date = '$start_date', end_date = '$end_date', ship_type = '$ship_type', swing_length = '$swing_length', client = '$client', area_of_operation = '$area_of_operation', salary_terms = '$salary_terms', salary_terms_doc = '".$imageuploadname[1]."', status = '0', sort_order = '0', add_date = '$gtcurrenttime'";
			$update_result = $db->query($update_query);	
			
			$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Record has been duplicated successfully.</div>';	
			echo "<script>document.location.href='".$_SESSION["RedirectPageURL"]."'</script>";
			
		exit;	
		break;
	}
	
	
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
 <!-- <div class="rws-userpagesinner">
		<div class="container"><h1>Posted Marine Jobs</h1></div>
	</div>    -->
</div>

<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Manage Posted Jobs</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Manage Posted Jobs</a>
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
			
		 	// Qeery to count applicants
			$queryjoin .= " LEFT JOIN (SELECT job_id, COUNT(*) AS totalapplicants FROM ss_jobseekers_jobapplied GROUP BY job_id ) AS t2 ON t1.id = t2.job_id ";
			
    		$query="SELECT t1.*, IFNULL(t2.totalapplicants,0) as totalapplicants FROM ss_employer_jobs as t1 $queryjoin WHERE emp_id=".$_SESSION["EMP"]['ID']." $conditon ";
	
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
		
			else { $final_query = $query." ORDER BY add_date DESC LIMIT $start, $per_page"; }
			
			$result_query = $db->query($final_query);
			
			if($orderfield!="") 
			{ 				
				$urltoshow = $baseurl."employer-job-list.php?page=emp&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.$urlconditions;				
				$urltopage = $baseurl."employer-job-list.php?page=emp".$urlconditions; 				
			}				
			else 				
			{				
				$urltoshow = $baseurl."employer-job-list.php?page=emp&PageNo=".$pagenum.$urlconditions; 				
				$urltopage = $baseurl."employer-job-list.php?page=emp".$urlconditions; 				
			}
			$_SESSION["RedirectPageURL"] = $urltoshow;
			if($orderby != "" && $orderby == "ASC")
			{
				$id = '<a href="'.$urltopage.'&field=id&order=DESC" title="Descending Order.">ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_id = '<a href="'.$urltopage.'&field=id&order=DESC" title="Descending Order.">Job ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_jobtitle = '<a href="'.$urltopage.'&field=jobtitle&order=DESC" title="Descending Order.">Jobtitle <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_category = '<a href="'.$urltopage.'&field=category&order=DESC" title="Descending Order.">Category <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_vessel = '<a href="'.$urltopage.'&field=job_type&order=DESC" title="Descending Order.">Vessel Type <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_postedin = '<a href="'.$urltopage.'&field=section&order=DESC" title="Descending Order.">Posted in <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_expiry = '<a href="'.$urltopage.'&field=end_date&order=DESC" title="Descending Order.">Expiry Date <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_applicants = '<a href="'.$urltopage.'&field=totalapplicants&order=DESC" title="Descending Order.">Total Applicants<i class="fa fa-sort" aria-hidden="true"></i></a>';		
				$show_status = '<a href="'.$urltopage.'&field=status&order=DESC" title="Descending Order.">Status <i class="fa fa-sort" aria-hidden="true"></i></a>';	
									
			}
			else
			{
				$id = '<a href="'.$urltopage.'&field=id&order=DESC" title="Descending Order.">ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_id = '<a href="'.$urltopage.'&field=id&order=ASC" title="Ascending Order.">Job ID <i class="fa fa-sort" aria-hidden="true"></i></a>';
				$show_jobtitle = '<a href="'.$urltopage.'&field=jobtitle&order=ASC" title="Ascending Order.">Jobtitle <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_category = '<a href="'.$urltopage.'&field=category&order=ASC" title="Ascending Order.">Category <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_vessel = '<a href="'.$urltopage.'&field=job_type&order=ASC" title="Ascending Order.">Vessel Type <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_postedin = '<a href="'.$urltopage.'&field=section&order=ASC" title="Ascending Order.">Posted in <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_expiry = '<a href="'.$urltopage.'&field=end_date&order=ASC" title="Ascending Order.">Expiry Date <i class="fa fa-sort" aria-hidden="true"></i></a>';	
				$show_applicants = '<a href="'.$urltopage.'&field=totalapplicants&order=ASC" title="Ascending Order.">Total Applicants<i class="fa fa-sort" aria-hidden="true"></i></a>';		
				$show_status = '<a href="'.$urltopage.'&field=status&order=ASC" title="Ascending Order.">Status <i class="fa fa-sort" aria-hidden="true"></i></a>';		
						
			}
	
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
            
		<!--    <div class="mtitle">Job List <span class="rws-addnewitem"><a href="javascript:void(0);" data-toggle="modal" data-target="#postjoblinks">Post a Job</a></span></div>   -->
                 
				<div class="mtitle">Job List <span class="rws-addnewitem"><a href="employer-post-marine-job.php" >Post a Job</a></span></div>
           			
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
                                <th align="left" valign="top"><?php echo $show_jobtitle; ?></th>
                                <th align="left" valign="top"><?php echo $show_category; ?></th>
                                <th align="left" valign="top"><?php echo $show_vessel; ?></th>
                                <th align="left" valign="top"><?php echo $show_postedin; ?></th>
                           <!--     <th align="left" valign="top"><?php echo $show_expiry; ?></th>     -->
                                <th align="left" valign="top"><?php echo $show_applicants; ?></th> 
                                <th align="left" valign="top"><?php echo $show_status; ?></th> 
                                <th align="left" valign="top" width="160">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $result_query->rows;
						$i=1;$j=1; foreach($rowlist as $key => $row) { 				
						
					//	if($row["section"]=="Shore") { $editlink = "employer-post-shore-jobs.php"; $catarray = $array_category_shore; } //else { $editlink = "employer-post-offshore-jobs.php";  $catarray = $array_category_offshore;}

						if($row["section"]=="Shore") { $editlink = "employer-post-shore-jobs.php"; $catarray = $array_category_shore; } else if($row["section"]=="offshore") { $editlink = "employer-post-offshore-jobs.php";  $catarray = $array_category_offshore;}
						else{ $editlink = "employer-post-marine-job.php";  $catarray = $array_category_offshore;}
						
						if($row["status"]==1) { $class="rwsactive"; $statustext='Active'; }
						if($row["status"]==0) { $class="rwsinactive"; $statustext='Inactive'; }
						
						?>
                        	<tr <?php echo $gtclasstr;?>>
							    <td  valign="top"><?php echo $i++; ?></td>
                            	<td  valign="top"><?php echo $row["id"]; ?></td>
                                <td  valign="top"><a href="<?php echo $baseurl;?>job-details.php?jobid=<?php echo $row["id"]; ?>"><?php echo $row["jobtitle"]; ?></a></td>
                                <td  valign="top"><?php echo $row["category"]; ?></td>
                            <!--    <td align="left" valign="top"><?php //echo $array_job_type[$row["vessel"]]; ?></td>   -->
								<td  valign="top"><?php echo $row["vessel"];  ?></td>
                                <td  valign="top"><?php echo $row["jobarea"]; ?></td>
                             <!--    <td align="left" valign="top"><?php echo $row["end_date"]; ?></td>  -->
                                <td  valign="top"><a href="<?php echo $baseurl; ?>employer-applicant-list.php?job_id=<?php echo $row["id"]; ?>">Applicants [<?php echo $row["totalapplicants"]; ?>]</a></td>
                                <td  valign="top" class="<?php echo $class;?>"><?php echo $statustext; ?></td>
                                <td  valign="top" class="rws-actionbtns">
                                
                                <p><a href="<?php echo $editlink;?>?post_id=<?php echo $row["id"]; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;

									
								<a href="javascript:void(0);" 
								post_id="<?php  echo $row["id"]; ?>" 
								onClick="" class="btn btn-success active" title="Active"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                
								<a href="javascript:void(0);" 
								post_id="<?php  echo $row["id"]; ?>" 
								onClick="" class="btn btn-warning inactive" title="Inactive"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp;
								
								
								
							<!--		<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Enable&post_id=<?php echo $row["id"]; ?>', 'Active Job');" class="btn btn-success active" title="Active"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                
								<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Disable&post_id=<?php echo $row["id"]; ?>', 'Inactive Job');" class="btn btn-warning inactive" title="Inactive"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp;

								
							<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Delete&post_id=<?php echo $row["id"]; ?>', 'Delete Job');" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
								<a href="javascript:void(0);" onClick="javascript:update_tick_status('<?php echo $urltoshow;?>&Action=Duplicate&post_id=<?php echo $row["id"]; ?>', 'Duplicate Job');" class="btn btn-info" title="Duplicate"><i class="fa fa-clone" aria-hidden="true"></i></a>&nbsp;  -->
								
								
                                
                                
                              </td>
                          </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                	<div class="rws-statitics rws-pagination" style="text-align:center;">
                    	<?php echo generate_pagination_new($urltoshow, $max_pages, $pagenum, $foundnum, $per_page, $pageshow, $start); ?>
                    </div>
                    <?php } else { echo '<div id="rws-formfeedback">There is no jobs posted by you.</div>'; }?>

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




<!-- ./wrapper -->





<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>

  $.widget.bridge('uibutton', $.ui.button);

</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/raphael/raphael.min.js"></script>

<script src="bower_components/morris.js/morris.min.js"></script>

<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="bower_components/moment/min/moment.min.js"></script>

<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/pages/dashboard.js"></script>

<script src="dist/js/demo.js"></script>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

$(".active").click(function(){
   
	var post_id=$(this).attr('post_id');
	alert('Are You Want to Active This Record');

	var action = "Active";
   $.ajax({
    method :"POST",
    url : "vacancy_update.php",
    data : {
		post_id:post_id,action:action
    },
    success : function(result){
     // alert(result);
   swal(result);
  setInterval(function(){ window.location.reload();}, 1000);
    }

   });
});  

$(".inactive").click(function(){
    
	var post_id=$(this).attr('post_id');
	alert('Are You Want to Inactive This Record');

	var action = "Inactive";
   $.ajax({
    method :"POST",
    url : "vacancy_update.php",
    data : {
		post_id:post_id,action:action
    },
    success : function(result){
      //alert(result);
   swal(result);
 setInterval(function(){ window.location.reload();}, 1000);
    }

   });
});  





</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

