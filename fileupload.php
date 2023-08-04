<?php
include("includes/config.php");
if(isset($_POST["rwsformsubmit"]))
{
    //$filename = basename($_FILES['resume']['name']);
   // $target_path = 'usercvdata/'.time().$filename;  
   // $target_path = 'usercvdata/';  
    //echo $target_path;
    $resume =time().$_FILES['resume']['name'];

    $temp=  $_FILES['resume']['tmp_name'];

    move_uploaded_file($temp, "usercvdata/$resume") ;
  /*  {
    
		echo "File uploaded successfully!";  
	} else{  
     	echo "Sorry, file not uploaded, please try again!";  
        echo $filename;  echo $target_path;
	}   */
}
  
  

  /*
  $move = "usercvdata/";
  echo $_FILES["file"]['name']."<br>";
  echo $_FILES["file"]['tmp_name']."<br>";
  echo $_FILES["file"]['size']."<br>";
  echo $_FILES['file']['error']."<br>";
  if(move_uploaded_file($_FILES['file']['name'], $move)){  
    echo "File uploaded successfully!";  
} else{  
    echo "Sorry, file not uploaded, please try again!";  
}  
*/



?>

<!DOCTYPE html>
<html>
   <head>
   </head>
<body>
   <form action="" method="POST" enctype="multipart/form-data">
    <!--  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
      <input type="file"name="file">
      <input type="submit">    -->
      <div class="rws-fields">
      <label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
<input type="file" name="resume" id="resume" accept="application/msword,application/pdf" />

 </div>  

 <div class="col-sm-4 offset-md-4">    
         <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />    
 </div>

   </form>
</body>
<html>

<!--  <div class="rws-fields">
<label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
<input type="file" name="resume" id="resume" accept="application/msword,application/pdf" />

 </div>  

 <div class="col-sm-4 offset-md-4">    
         <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />    
 </div>   -->