<?php   
 //session_start();
 include("includes/config.php"); 
//include 'include/db_conn.php';

//include 'include/getlogin.php';

 //checkemplogin(); 
 //checkemploginrole("Admin,Standard");


$action = $_POST['action'];
//-----------------for active job code--------------//
if($action == "Active"){

   $post_id = $_POST['post_id'];
   
//$query=mysqli_query($conn,"UPDATE `ss_employer_jobs` SET `status`='1' WHERE `id`='$post_id' ");

$query="UPDATE `ss_employer_jobs` SET `status`='1' WHERE `id`='$post_id' ";
$rs = $db->query($query);
//echo $query;exit();

if($rs){
	echo "record active succssfully";

}else{
	echo "something went wrong";
}

}

//-----------------for inactive job code--------------//
if($action == "Inactive"){

    $post_id = $_POST['post_id'];
    
 $query="UPDATE `ss_employer_jobs` SET `status`='0' WHERE `id`='$post_id' ";
 $rs = $db->query($query);
 //echo $query;exit();
 
 if($rs){
     echo "record inactive succssfully";
 
 }else{
     echo "something went wrong";
 }
 
 }


//-----------------apply job code--------------//
 /*   if($action == "Applyjob"){

    $jod_id = $_POST['jod_id'];
    $emp_id = $_POST['emp_id'];
    $js_id = $_POST['js_id'];
    $apply_date = $_POST['apply_date'];
    $status=1;
    
    $app="insert into ss_jobseekers_jobapplied set job_id='".$job_id."',emp_id='".$emp_id."',js_id='".$js_id."',apply_date='".$apply_date."',status='".$status."'";
    if(mysqli_query($conn,$app)){
        echo"<script>window.alert('Apply Successufully');window.location.href='applyjobs.php';</script>";
    }else{
        echo"<script>window.alert('Sorry Cannot apply right now');</script>";                    
    }
    
 


 }
 
*/


   
   
   ?>
