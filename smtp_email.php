
<?php

//********for smtp php mailer email **********/

// error_reporting(1);
include('includes/config.php');


    $mail_subject="This is testing emil from smtp";
    $mail_fromname="THALA Admin";
    $mail_fromemail="admin@teamthalassophile.com";
    $mail_to="swarajdarne.srj@gmail.com";
    $mail_cc="";
    $mail_bcc="";
    $mail_message="dgfbhb";
    $mail_attachment="";

    // echo $mail_subject;

    // testfunc($mail_subject);

    sendMail($mail_fromname,$mail_fromemail,$mail_subject,$mail_to,$mail_cc,$mail_bcc,$mail_message,$mail_attachment);

//******* smtp php mailer end ************/
?>

