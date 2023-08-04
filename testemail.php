<?php


// include("includes/config.php"); 

// $rwspagevar = "registerjobseeker"; tocheckloginstate();
// include_once 'securimage/securimage.php';
// $securimage = new Securimage();

//   $to="patilvrishabh12pv@gmail.com";
//   $admin_fromemail="admin@teamthalassophile.com";
//   $admin_fromname="Thala Admin";
//   $baseurl = 'https://www.teamthalassophile.com/';

//   $subject="Test Subject";

//   $emailheader = '<div style="padding:30px; text-align:center; width:800px; max-width:800px; min-width:600px; background:#e0e4e5;">
// 	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF; width:600px;" align="center";>
//   <tr>
//     <td style="padding-bottom:10px; border-bottom:1px solid #ddd; height:100px; font-size:40px; background:url('.$baseurl.'images/LogoText1.png) no-repeat center top;">JobSEAkers</td>
//   </tr>';

//   $emailfooter = '<tr>
//     <td style="padding-bottom:10px; padding-top:10px; border-top:1px solid #ddd; height:29px;"><a href="'.$baseurl.'" title="JobSEAkers">&copy; JobSEAkers</a></td>
//   </tr>
// </table>

// </div>';

// $body =$emailheader."".$emailfooter;


   
  
//  $mail= sendmail($to,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);

// echo "<pre>";
// print_r($mail);
// echo "</pre>";


// //  if($mail){
// // 	echo "Email Sent";
// //  }else{
// // 	echo "Email not sent";
// //  }


include('smtp/PHPMailerAutoload.php');


//smtp_mailer('komaltahasildar27@gmail.com','test','hi from shipthala');

function smtp_mailer($to,$subject,$msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "bridgeviewmaritime1@gmail.com";
	$mail->Password = "jmtvmfynbluudwja";
	$mail->SetFrom("bridgeviewmaritime1@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));

	//$mail->Send();
	  if(!$mail->Send()){
	  	echo $mail->ErrorInfo;
	 }else{
	  	return 'Sent';
	 }
}

$fullname="Test Test";
$sitename="TeamThalassophile";
$activeurl="https://www.teamthalassophile.com/jobseekers-validate.php?vid=U1MtNDE2";
$sendpass="Test@123";

$subject = "Hello ".$fullname.", Your Account has been created successfully on ".$sitename;

$message ='
			
<p style="padding:10px;margin:0;color:#66757f;font-size:14px;font-weight:300;text-align:left">

Hello '.$fullname.',<br><br>

Thank you for registering to '.$sitename.'. <br> Your password is : <b>'.$sendpass.'</b><br><br>

Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br><br>

	Best Regards <br>
	TeamThalassophile <br><br><br>

</p>
  
  ';

//$html='Msg';

smtp_mailer('patilvrishabh12pv@gmail.com',$subject,$message);

?>