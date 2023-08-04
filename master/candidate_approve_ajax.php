
<?php //include('header.php'); 

include('../includes/config.php');


$action=$_POST['action'];
$cdate=date("Y-m-d H:i:s");

$today=date('Y-m-d');

$yesterday=date('Y-m-d',strtotime('-1 Days'));

 

    $jsquery="SELECT * FROM ss_jobseekers where add_date like '%" . $date . "%' ";

    $jsquery="SELECT * FROM ss_jobseekers where add_date like '%" . $date . "%' ";


    $jsquery="select * from ss_jobseekers where DATE(add_date) between DATE' ".$fdate."' AND DATE '".$ldate."' ";
//----jobseeker active-------------//
if($action=="candidate_activ"){

    $userid=$_POST['userid'];	

    $query="update ss_jobseekers set admin_approval='1',validate='1' where id='".$userid."' ";
    $rs = $db->query($query);	
  
 if($rs){
  
   $result = $db->query("select * from ss_jobseekers where id='".$userid."' ");
    $rowlist = $result->rows;    
    foreach($rowlist as $key => $row) {    
   $pswd = md5($row['password']);
   
   $emailid=strtolower($row['email']);  
   
   // $password=$canres['password'];
    $to =$emailid;
  // $to = "itsupport@bridgeviewmaritime.com";
 //  $to = "tanujat44@gmail.com";



    $subject = "Account Activated! (www.teamthalassophile.com)";

    $message="<table style='color:black;width:100%;padding:30px 30px;'>";

    $message .="<tr><td style='font:normal 20px sans-serif;'><br>Dear Candidate,</td>";

    $message .="<tr><td style='font:normal 20px sans-serif;'><br>Your account has been activated.</td>";

    $message .="<tr><td style='font:normal 20px sans-serif;'><br>You may login and complete your information in your CV.</td>";

    $message .="<tr><td style='font:normal 20px sans-serif;'><br>
   <a  style='background-color: blue;padding: 10px;border-radius: 50px; color: white; text-decoration: none; font-weight: 600;' 
   href='//www.teamthalassophile.com/jobseekers-login.php'>Click For Login</a></td>";
   
    $message .="<tr><td style='font:normal 20px sans-serif;'><br>After filling  your information , you can apply for jobs from job vacancies displayed on www.teamthalassophile.com</td>";

    $message .="<tr><td style='font:normal 20px sans-serif;'><br><br>***Best Regards***</td>";

    $message .="<tr><td style='font:normal 20px sans-serif;'><br>(For : www.teamthalassophile.com)</td>";

    $message.="</table>";

    $message.="<br>";
    
    $message.="<div style='padding:30px;font-size:20px;padding-top: 0;'>".$bmpladdress."</div>";

    $headers = "MIME-Version: 1.0" . "\r\n";

    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: <admin@teamthalassophile.com>' . "\r\n";

    $headers .= 'Bcc: itsupport@bridgeviewmaritime.com' . "\r\n";

   //  mail($to,$subject,$message,$headers); 

    // smtp_mailer($to,$subject,$message); //gmail smtp

    $mail_subject= $subject;
    $mail_fromname="THALA Admin";
    $mail_fromemail="admin@teamthalassophile.com";
    $mail_to= $to;
    $mail_cc="";
    $mail_bcc="itsupport@bridgeviewmaritime.com";
    $mail_message= $message;
    $mail_attachment="";

    
    sendMail($mail_fromname,$mail_fromemail,$mail_subject,$mail_to,$mail_cc,$mail_bcc,$mail_message,$mail_attachment);


   }
   echo "Selected Account is Approved Successfully "; 
   }
   else{
	echo "Something Went Wrong";
   }  

}

//----jobseeker deactive-------------//
else if($action=="candidate_deactive"){

    $userid=$_POST['userid'];	

    $query1="update ss_jobseekers set admin_approval='1',status='0' where id='".$userid."' ";
    $rs1 = $db->query($query1);	
  
 if($rs1){
	echo "updated Successfully..";
   }
   else{
	echo "Something Went Wrong";
   }  

}

//----jobseeker active-------------//
else if($action=="activenow"){

   $userid=$_POST['userid'];	

   $query1="update ss_jobseekers set admin_approval='1',status='1' where id='".$userid."' ";
   $rs1 = $db->query($query1);	
 
if($rs1){
  echo "Activated Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  

}

//----jobseeker activeall-------------//
else if($action=="activeall"){

   $post_ids = $_POST['post_id'];
   // print_r ($post_ids);
   // exit;
   // print($post_ids);

   foreach($post_ids as $id)

   {
      // echo $id;
      $query3="update ss_jobseekers set admin_approval='1',validate='1' where id='".$id."' ";
      $rs3 = $db->query($query3);	
      // echo $id;
      $result = $db->query("select * from ss_jobseekers where id='".$id."' ");
      $rowlist = $result->rows;    
      foreach($rowlist as $key => $row) {    
      $pswd = md5($row['password']);
      
      $emailid=strtolower($row['email']);  
      
      // $password=$canres['password'];
      $to =$emailid;
      // echo $emailid;
      // exit;
      // $to = "itsupport@bridgeviewmaritime.com";
      //  $to = "tanujat44@gmail.com";



      $subject = "Account Activated! (www.teamthalassophile.com)";

      $message="<table style='color:black;width:100%;padding:30px 30px;'>";

      $message .="<tr><td style='font:normal 20px sans-serif;'><br>Dear Candidate,</td>";

      $message .="<tr><td style='font:normal 20px sans-serif;'><br>Your account has been activated.</td>";

      $message .="<tr><td style='font:normal 20px sans-serif;'><br>You may login and complete your information in your CV.</td>";

      $message .="<tr><td style='font:normal 20px sans-serif;'><br>
      <a  style='background-color: blue;padding: 10px;border-radius: 50px; color: white; text-decoration: none; font-weight: 600;' 
      href='//www.teamthalassophile.com/jobseekers-login.php'>Click For Login</a></td>";
      
      $message .="<tr><td style='font:normal 20px sans-serif;'><br>After filling  your information , you can apply for jobs from job vacancies displayed on www.teamthalassophile.com</td>";

      $message .="<tr><td style='font:normal 20px sans-serif;'><br><br>***Best Regards***</td>";

      $message .="<tr><td style='font:normal 20px sans-serif;'><br>(For : www.teamthalassophile.com)</td>";

      $message.="</table>";

      $message.="<br>";
      
      $message.="<div style='padding:30px;font-size:20px;padding-top: 0;'>".$bmpladdress."</div>";

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      $headers .= 'From: <admin@teamthalassophile.com>' . "\r\n";

      $headers .= 'Bcc: itsupport@bridgeviewmaritime.com' . "\r\n";

      //  mail($to,$subject,$message,$headers); 

      // smtp_mailer($to,$subject,$message); //gmail smtp

      $mail_subject= $subject;
      $mail_fromname="THALA Admin";
      $mail_fromemail="admin@teamthalassophile.com";
      $mail_to= $to;
      $mail_cc="";
      $mail_bcc="itsupport@bridgeviewmaritime.com";
      $mail_message= $message;
      $mail_attachment="";
  
      
      sendMail($mail_fromname,$mail_fromemail,$mail_subject,$mail_to,$mail_cc,$mail_bcc,$mail_message,$mail_attachment);

   }
   
}
echo "Selected Account is Approved Successfully "; 
 
if($rs3){
  echo "Activated Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  

}

//--------for activate emp--------//
else if($action=="empactiveall"){


   $post_ids = $_POST['post_id'];

   foreach($post_ids as $id)

   {

      $query4="update ss_employer set status='1' where id='".$id."' ";
      $rs4 = $db->query($query4);	

   }
 
if($rs4){
  echo "Activated Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  

}

//--------for deactivate emp--------//
else if($action=="deactiveall"){


   $post_ids = $_POST['post_id'];

   foreach($post_ids as $id)

   {

      $query5="update ss_employer set status='0' where id='".$id."' ";
      $rs5 = $db->query($query5);	

   }
 
if($rs5){
  echo "Deactiveted Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  

}

//--------for activate agn--------//
else if($action=="agnactiveall"){

   $post_ids = $_POST['post_id'];

   foreach($post_ids as $id)

   {

      $query4="update ss_agent set approval='1' where id='".$id."' ";
      $rs4 = $db->query($query4);	

   }
 
if($rs4){
  echo "Activated Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  
  
}

//--------for deactivate agn--------//
else if($action=="agndeactiveall"){


   $post_ids = $_POST['post_id'];

   foreach($post_ids as $id)

   {

      $query5="update ss_agent set approval='0' where id='".$id."' ";
      // echo $query5;exit;
      $rs5 = $db->query($query5);	

   }
 
if($rs5){
  echo "Deactiveted Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  

}

//-----------------for active job code--------------//
  else if($action == "JobActive"){

    $post_id = $_POST['post_id'];
         
      //$query=mysqli_query($conn,"UPDATE `ss_employer_jobs` SET `status`='1' WHERE `id`='$post_id' ");

      $query6="UPDATE `ss_employer_jobs` SET `status`='1' WHERE `id`='$post_id' ";
      $rs6 = $db->query($query6);
      //echo $query;exit();

      if($rs6){
         echo "record active succssfully";

      }else{
         echo "something went wrong";
      }

      }

//-----------------for inactive job code--------------//
  else if($action == "JobInactive"){

  $post_id = $_POST['post_id'];
    
   $query7="UPDATE `ss_employer_jobs` SET `status`='0' WHERE `id`='$post_id' ";
   $rs7 = $db->query($query7);
  
  // $rs7 = $db->query($query7);
   //echo $query;exit();
  
 if($rs7){
      echo "record inactive succssfully";
   
   }else{
      echo "something went wrong";
   }   
      
   }

   if($action=="rankrequest"){

      $cat=$_POST['cat'];

     if($cat=='SHORE') {


      $query1="SELECT * FROM `shore_rank`  ";
      $result1 = $db->query($query1);
      $rowlist = $result1->rows;
  
      $output="";

      foreach($rowlist as $key => $row)
      {
          $output .="<option value='".$row['rankname']."'>".$row['rankname']."</option>";
      }

      echo $output;

     }

     else{

      $query="SELECT * FROM `ss_allrank` WHERE category='".$cat."' ";
      $result = $db->query($query);
      $rowlist = $result->rows;
  
      $output="";

      foreach($rowlist as $key => $row)
      {
          $output .="<option value='".$row['rankname']."'>".$row['rankname']."</option>";
      }


      echo $output;

     }

  }
  
//--------for activate agn--------//
else if($action=="deactivate_job_agent"){
   $job_ids = $_POST['jobid'];
   
   $job_exploded = explode(",", $job_ids);   

   foreach($job_exploded as $id)

   {

      $find = "update `ss_agent_vacancy` set status  = '0' where id='".$id."' ";


      $rs = $db->query($find);

      $foundnum = $rs->num_rows;

   }
 
if($rs){
   
  echo "Activated Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  
  
}

//--------for activate agn--------//
else if($action=="assignagent"){
   $agn_ids = $_POST['agnid'];
   
   $agn_exploded = explode(",", $agn_ids);
   $job_ids = $_POST['job_id'];
   $emp_ids = $_POST['emp_id'];
   
   foreach($agn_exploded as $id)

   {

      $find = "SELECT * from ss_agent_vacancy where agn_id='".$id."' AND job_id='".$job_ids."'";


      $rs = $db->query($find);

      $foundnum = $rs->num_rows;
      // echo $foundnum;
      
      // exit;

      if($foundnum == 0){
         $query4="INSERT into ss_agent_vacancy set agn_id='".$id."', job_id='".$job_ids."' ,emp_id = '".$emp_ids."', assigned_date = '".date('Y-m-d H:i:s')."', status='1' ";
         $rs4 = $db->query($query4);
      }else{
         $query4="Update ss_agent_vacancy set status='1', assigned_date = '".date('Y-m-d H:i:s')."' where agn_id='".$id."' AND job_id='".$job_ids."' ";
         $rs4 = $db->query($query4);
      }
// echo $query4; exit;
   }
 
if($rs4){
  echo "Activated Successfully..";
  }
  else{
  echo "Something Went Wrong";
  }  
  
}

?>