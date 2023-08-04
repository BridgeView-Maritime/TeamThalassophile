<?php

 include("includes/config.php");  $gtpage = "Jobseeker";
checkuserlogin(); 

  $emailid = $_SESSION["USER"]['Email'];

   $js_id = $_SESSION["USER"]['ID'];	


$gc="select * from ss_employer_jobs where id='".$_GET['jobid']."' ";     

$check = $db->query($gc);

$grow = $check->row;

$grank=$grow['jobtitle'];
$whom=$grow['person_email'];
$employ_id=$grow['emp_id'];

//for email
$cms_jobid=$grow['id'];
$bcompany=$grow['company_name'];
$bvessel=$grow['vessel'];
$bcontract=$grow['contract'];

 if(IsSet($_POST['apply1'])){
     
    $job_id = $_GET['jobid'];
    $emp_id = $employ_id;
    $js_id =  $js_id;
    $apply_date = date('Y-m-d H:i:s'); 
    $status=1;

    $iquery="insert into ss_jobseekers_jobapplied set job_id='".$job_id."',emp_id='".$emp_id."',js_id='".$js_id."',apply_date='".$apply_date."',status='".$status."'";
 
 ///   $rs=$db->query($iquery);

 //echo $iquery;exit();
   
    $find1="SELECT * FROM ss_jobseekers_jobapplied where job_id='".$job_id."' and  js_id='".$js_id."' ";
      
    $find = $db->query($find1);

    $foundnum = $find->num_rows;
   
    if($foundnum == 0 ){

        $rs=$db->query($iquery);

        if($rs) {

    
    $candidate="SELECT * FROM ss_jobseekers where email='".$emailid."' order by id desc limit 1 ";
    $canres1 = $db->query($candidate);
    $canres = $canres1->row;



    $ssubject ="New candidate applied on Teamthalassophile - jobid : Thalla".$cms_jobid." ";
    $table = "

    <p style='margin-left:10px;font-size: 15px;'>New candidate applied on jobid : Thalla".$cms_jobid."</p>

    <p style='margin-left:10px;font-size: 15px;'>Vacancy Details</p>

    <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 50%;'>    


    <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

        <td style='padding:5px;font-size:15px'>Company Name</td>  
        <td style='padding:5px;font-size:15px'>Rank Name</td>  
        <td style='padding:5px;font-size:15px'>Vessel Type</td>  
        <td style='padding:5px;font-size:15px'>Contract</td>  

    </tr>

    <tr>

        <td style='padding: 5px;font-size:15px'>".$bcompany."</td>

        <td style='padding: 5px;font-size:15px'>".$grank."</td>

        <td style='padding: 5px;font-size:15px'>".$bvessel."</td>

        <td style='padding: 5px;font-size:15px'>".$bcontract."Months"."</td>

    </tr>


    </table>



    <br><br>


    <p style='margin-left:10px;font-size: 15px;'>Applied Candidate Details</p>

    <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 50%;'>   


    <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

    <td style='padding:5px;font-size:15px'>Candidate Name</td>  
    <td style='padding:5px;font-size:15px'>Rank Name</td>  
    <td style='padding:5px;font-size:15px'>Candidate Email</td>  
    <td style='padding:5px;font-size:15px'>Mobile</td>  

    </tr>

    <tr>

        <td style='padding: 5px;font-size:15px'>".ucwords(strtolower($canres['fullname']))."</td>

        <td style='padding: 5px;font-size:15px'>".$canres['rankname']."</td>

        <td style='padding: 5px;font-size:15px'>".strtolower($canres['email'])."</td>

        <td style='padding: 5px;font-size:15px'>".$canres['phoneno']."<br>".$canres['mobile']."</td>

    </tr>               

    </table>
    

    ";


    $htmlContent=$table;

    // Sender 
    $from = 'admin@teamthalassophile.com'; 
    $fromName = 'Team Thalassophile Admin'; 

    //To
  //  $tto= 'admin@bridgeviewmaritime.com';

   //    $tto= 'itsupport@bridgeviewmaritime.com';

       $tto= 'tanujat44@gmail.com';

    // Attachment file 
  
    // $file = "upload/".$canres['photo']; 


    // Header for sender info 
    $headers = "From: $fromName"." <".$from.">"; 

    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  

    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

    // $headers .= "\nCc: admin@bridgeviewmaritime.com"; 

    // $headers .= "\nCc: itsupport@bridgeviewmaritime.com"; 

    //  $headers .= "\nCc: tanujat44@gmail.com"; 

  //  $headers .= "\nBcc: vivekbmplcms@gmail.com";

    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  

    // Preparing attachment 
 /*   if(!empty($file) > 0){ 
        if(is_file($file)){ 
            $message .= "--{$mime_boundary}\n"; 
            $fp =    @fopen($file,"rb"); 
            $data =  @fread($fp,filesize($file)); 

            @fclose($fp); 
            $data = chunk_split(base64_encode($data)); 
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
            "Content-Description: ".basename($file)."\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
        } 
    }    */
 
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $from; 

  //  if(!empty($canres['fullname']) && !empty($canres['emailid'])  && !empty($canres['rankname']) )  {
    // Send email 
        mail($tto, $ssubject, $message, $headers, $returnpath);
 //   }

     

   // echo "Apply Successufully";

   echo"<script>window.alert('Apply Successufully');window.location.href='jobseekers-applied-jobs.php';</script>";
      

   }else{

    echo "Sorry Cannot apply right now";    

   }



    }


 }




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

            <form  method="post" action="" enctype="multipart/form-data">

<div class="page-ads box" style="background-color:#bb9d9d3d;padding:30px;";>         
            <div class="divider">
              
        <?php  //  foreach($grow as $key => $row) {  ?>
                <h3 style="color:#0079ab;">Hello ... <?php echo ucwords($_SESSION["USER"]['Firstname']); ?>  ,<br> Are You Want To Applied Job For Post Of </h3>
                    <h2 style="color:#0079ab;"><?php echo $grow['jobtitle'];?>..</h2><br>
                    <h4  style="color:#0079ab;">Category : <?php echo $grow['category'] ;?></h4>
                    <h4  style="color:#0079ab;"> Company Name : CONFIDENTIAL</h4>
                    <h4  style="color:#0079ab;">Salary : <?php echo $grow['salary'] ;?></h4>
                    <h4  style="color:#0079ab;">Experience : <?php echo $grow['experience'] ;?></h4>
                    <h4  style="color:#0079ab;">Vessel Type : <?php echo $grow['vessel'] ;?></h4>
                    
                    <h4  style="color:#0079ab;">Area of Operation : <?php  echo $grow['area_of_operation'];?></h4>
                    <h4  style="color:#0079ab;">Posted Date : <?php  echo $grow['add_date'];?></h4>
                    <h4  style="color:#0079ab;">Description : <?php  echo $grow['description'];?></h4>
                    
                    <input type="submit" class="btn btn-common apply1"  
                    job_id="<?php echo $grow['id'];?>" 
                    emp_id="<?php echo $grow['emp_id'];?>" 
                    js_id ="<?php echo  $_SESSION["USER"]['ID']; ?>"
                
                    name="apply1" value="Apply" style="float:right;margin-top:-40px;background-color: #1aa4dd;">
                   
                    
               
                    <?php //} ?>
               
       
                </div>
    </div>
     


    </form>


</div>
            <!-- Box Ends -->
            
          
            
        </div>
        
    </div>
    
</div>
</div>



<!-- ./wrapper -->

   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



<!--


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

 

-->