

<?php

//$to = $email;
$to = "tanujat44@gmail.com";
        
     //   $subject = "Hello ".$fullname.", Your Account has been created successfully on ".$sitename;

       
    $ssubject ="New candidate applied on jobid : Thalla".$cms_jobid." ";

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

        <td style='padding: 5px;font-size:15px'>".$bcontract."</td>

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

        <td style='padding: 5px;font-size:15px'>".strtolower($canres['emailid'])."</td>

        <td style='padding: 5px;font-size:15px'>".$canres['phoneno']."<br>".$canres['mobile']."</td>

    </tr>               

    </table>
    

    ";


    $htmlContent=$table;

             // Sender 
    $from = 'admin@teamthalassophile.com'; 
    $fromName = 'Team Thalassophile Admin'; 


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
    $mailtest =     mail($tto, $ssubject, $message, $headers, $returnpath);
  //  }

   
 



        if($mailtest){
            echo "mailsent";
        }
        else
        {
            echo " not mailsent";
        }

?>