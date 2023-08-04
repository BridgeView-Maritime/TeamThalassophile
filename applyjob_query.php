<?php   
include("includes/config.php"); 
checkuserlogin();

$action = $_POST['action'];

if($action == "Applyjob"){
  
   
    $job_id = $_POST['job_id'];
    $emp_id = $_POST['emp_id'];
    $js_id = $_POST['js_id'];	
    $apply_date = date('Y-m-d H:i:s'); 
    $status=1;
    
$query="insert into ss_jobseekers_jobapplied set job_id='".$job_id."',emp_id='".$emp_id."',js_id='".$js_id."',apply_date='".$apply_date."',status='".$status."'";
$rs = $db->query($query);

if($rs){
   echo "Apply Successufully";
   
}else{
  
    echo "Sorry Cannot apply right now";                   
    }
   
}



 

?>