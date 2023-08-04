<?php include("includes/config.php");  $gtpage = "Jobseeker";




//----- start approval for modal load ----   //

if(isset($_SESSION['views']))
{
    $_SESSION['views'] = $_SESSION['views']+1;

}

else
{

  $_SESSION['views']=1;

}

//----- end approval for modal load ------ //




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


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>




<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Hello <?php echo $_SESSION["USER"]['Firstname']; ?></h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>" style="color:white;">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Jobseeker - Dashboard</a>
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
    		
			$query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category, t3.job_type, t3.vessel, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id WHERE t1.js_id=".$_SESSION["USER"]['ID']." ORDER BY apply_date DESC LIMIT 0, 5";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>


        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Recent Applied Jobs</div> <br>


        <!--        <div class="container" style="margin-left: 25%;">
                    <label class="radio-inline">
                        <input type="radio" name="optradio"  onclick="javascript:window.location.href='jobseekers-edit-profile.php';"><b>MARINE</b>
                    </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="radio-inline">
                        <input type="radio" name="optradio" onclick="javascript:window.location.href='jobseekers-rigs_profile.php';"> <b>RIGS/DRILLING RIGS</b>
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="radio-inline">
                        <input type="radio" name="optradio" onclick="javascript:window.location.href='jobseekers-onshore_profile.php';"> <b>ONSHORE</b>
                    </label>
                </div>    -->



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
                              <!--    <td><?php echo $showcategory; ?></td>
                              <td><?php echo $array_job_type[$row["job_type"]]; ?></td>  -->
                               <td><?php echo $row["category"]; ?></td>
                               <td><?php echo $row["vessel"]; ?></td>
                                <td><?php echo $row["emp_company"]; ?></td>
                                <td class="<?php echo $class;?>"><?php echo $statustext; ?></td>
                                <td><?php echo toshowdatetime($row["apply_date"]); ?></td>
                                <!--<td><a href="jobseekers-education-add.php?post_id=<?php echo $row["id"]; ?>">Edit</a></td>-->
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                	<div class="rws-viewall"></div>
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

<!-- RWS Footer Starts --> 


<?php


    $query1 = 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$_SESSION["USER"]['ID'].'"';
    $query1_result = $db->query($query1);
    $cv_result = $query1_result->row;

    
    if(isset($_POST["rwsformsubmit"]))
    {

        if (empty($_POST['end_date']) ) 	{	$errors[]="Please fill out the firstname field.";		}	

        $start_date = $_POST['start_date'];
        $end_date 	= $_POST['end_date'];


        $update_query = "UPDATE `ss_jobseekers` SET availability_1_from = '$start_date',availability_1_to = '$end_date' WHERE `id`=".$_SESSION["USER"]['ID'];

        $update_result = $db->query($update_query);	

    }

?>


<div class="modal fade" id="avail_date" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="" method="post">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Update your Availability Date</h3> <br>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       
        <b style=font-size:15;color:#202022;>Current Availability &nbsp;  Date From :<?php echo $cv_result['availability_1_from'];   ?> </b>  &nbsp;   
        <b style=font-size:15;color:#202022;>Date To   :  <?php echo $cv_result['availability_1_to'];   ?> </b>

      </div>
      <div class="modal-body text-center">
    <h4><b>Availability Date From : </b>  </h4> <input type="date" name="start_date" id="start_date" placeholder="Availability Date From">
    <h4><b>Availability Date To   : </b>  <h4><input type="date" name="end_date" id="end_date" placeholder="Availability Date To">
        
        
      </div>
        <div class="modal-footer"> 
     <!--   <a href="javascript:void(0);" name="rwsformsubmit" id="rwsformsubmit" class="btn btn-primary">Save changes</a>     --> 
            <input type="submit"  name="rwsformsubmit" id="rwsformsubmit" class="btn btn-primary" value="Save changes" >   
      </div>
    </div>
  </div>
</form>
</div>


<script>

// for load modal availability date

    $(window).on('load', function() {

        var page=<?php echo $_SESSION['views']; ?>;  
               
        if(page==1){

            $('#avail_date').modal('show');
        
        }else{
          
             $('#avail_date').hide();
        }

       
    });


</script>

