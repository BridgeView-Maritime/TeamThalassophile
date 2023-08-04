
<?php 


$aemail="itsupport@bridgeviewmaritime.com";
   
//$aemail="neetu@bridgeviewmaritime.com";

$tto = $aemail;

$ssubject = "Testing Thalassophile Email";

$mmessage = "


<p style='text-align:justify;'>  Testing Email Verify   </p>



";



$hheaders = "MIME-Version: 1.0" . "\r\n";



$hheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";



//$hheaders .= 'From: BMPL Admin<admin@bridgeviewmaritime.com>' . "\r\n";

$hheaders .= 'From: Thalassophile Admin<admin@teamthalassophile.com>' . "\r\n";

$hheaders .='Cc: itsupport@bridgeviewmaritime.com'. "\r\n";

//$hheaders .='Cc: vivekbmplcms@gmail.com'. "\r\n";

//$hheaders .='Bcc: itsupport@bridgeviewmaritime.com'. "\r\n";



$ok=mail($tto,$ssubject,$mmessage,$hheaders);


echo $ok?"Email SENT":"Email Not Sent";

?>