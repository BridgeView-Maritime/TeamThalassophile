<?php

 include("includes/config.php");  $gtpage = "Jobseeker";
checkuserlogin(); 
 
 $queryjobs = "SELECT * FROM `ss_employer_jobs`  WHERE status='1' AND id='".$_GET['jobid']."' ";
 $result = $db->query($queryjobs);
 $rowlist = $result->rows;

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




<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true">&nbsp;&nbsp;new job</i></span>
                
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
        
        	<div class="rws-module">


<div class="page-ads box" style="background-color:#bb9d9d3d;padding:30px;";>         
            <div class="divider">
              
        <?php    foreach($rowlist as $key => $row) {  ?>
                <h3 style="color:#0079ab;">Hello ... <?php echo ucwords($_SESSION["USER"]['Firstname']); ?>  ,<br> Are You Want To Applied Job For Post Of </h3>
                    <h2 style="color:#0079ab;"><?php echo $row['jobtitle'];?>..</h2><br>
                    <h4  style="color:#0079ab;">Category : <?php echo $row['category'] ;?></h4>
                    <h4  style="color:#0079ab;"> Company Name : CONFIDENTIAL</h4>
                    <h4  style="color:#0079ab;">Salary : <?php echo $row['salary'] ;?></h4>
                    <h4  style="color:#0079ab;">Experience : <?php echo $row['experience'] ;?></h4>
                    <h4  style="color:#0079ab;">Vessel Type : <?php echo $row['vessel'] ;?></h4>
                    
                    <h4  style="color:#0079ab;">Area of Operation : <?php  echo $row['area_of_operation'];?></h4>
                    <h4  style="color:#0079ab;">Posted Date : <?php  echo $row['add_date'];?></h4>
                    <h4  style="color:#0079ab;">Description : <?php  echo $row['description'];?></h4>
                    
                    <input type="button" class="btn btn-common apply1" 
                    job_id="<?php echo $row['id'];?>" 
                    emp_id="<?php echo $row['emp_id'];?>" 
                    js_id ="<?php echo  $_SESSION["USER"]['ID']; ?>"
                    name="apply1" value="Apply" style="float:right;margin-top:-40px;background-color: #1aa4dd;">
                   
                
               
                    <?php } ?>
               
       
                </div>
    </div>
     





</div>
            <!-- Box Ends -->
            
          
            
        </div>
        
    </div>
    
</div>
</div>



<!-- ./wrapper -->

   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>





<script>
  
$(".apply1").click(function(){
    
   var job_id=$(this).attr('job_id');
   var emp_id=$(this).attr('emp_id');
   var js_id=$(this).attr('js_id');
   
  // alert(js_id);
   
var action = "Applyjob";
  $.ajax({
   method :"POST",
   url : "applyjob_query.php",
   data : {
    job_id:job_id,emp_id:emp_id,js_id:js_id,action:action
   },
   success : function(result){
    //alert(result);
   swal(result);
 //setInterval(function(){ window.location.reload();}, 1000);
 setInterval(function(){ window.location.href="jobseekers-applied-jobs.php";}, 1000);
   }

  });
});  
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
