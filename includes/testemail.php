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


function smtp_mailer($to,$subject, $msg){
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
	$mail->SetFrom("admin@teamthalassophile.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	 if(!$mail->Send()){
	 	echo $mail->ErrorInfo;
	 }else{
	 	return 'Sent';
	 }
}

$html='Msg';
echo smtp_mailer('patilvrishabh3797@gmail.com','Test Subject',$html);


?>