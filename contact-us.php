<?php include("includes/config.php");

 if(isset($_POST['submit']))
{       


        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $insert = "INSERT INTO `ss_contact` SET  firstname = '".$firstname."', email = '".$email."', subject = '".$subject."', message = '".$message."'"; 
 
         $update_result = $db->query($insert);

        if($update_result)
        {

            echo "<script>document.location.href='".$baseurl."contact-us.php'</script>";
        }else
        {
           echo "Not Inserted"; exit;
        }

   

}



$about = 1;

include("app/gtheader.php");

?>


<div class="rws-jobdetailsheader">
	<div class="rws-jdhinner">
        <div class="container">
            <h1>Contact Us</h1>
        </div>
    </div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <a href="javascript:void(0)"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span> Contact Us</a>
            </div>
        </div>
    </div>
</div>



<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

.captchaa{
                background-image: url(images/captchaaa.png) !important;
     }

.design{
  width: 80%;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width:100%;
  height:50%;
}

</style>

<script type="text/javascript">

function captch() {
    var x = document.getElementById("capt")
    x.value = Math.floor((Math.random() * 10000) + 1);
}
</script>


<?php

    $query="SELECT * FROM ss_contactus"; 
    $rs = $db->query($query);

    $rowlist = $rs->rows;
    $j=1; 

    foreach($rowlist as $key => $row) {
   
?>


<div class="rws-content">
<div class="container">
<div class="row">

    <div class="col-xs-4">

    <div class="rws-content">
    <div class="container">
        <p><?php echo $row["description"]; ?></p>
    </div>
    </div>

 <?php } ?> 

    </div>


    <div class="col-xs-8">

        <div class="design">

            <form action="" method="post">

            <h3 style="margin-left: 40%;">Fill Form</h3>


                <label>Full Name</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter Your Name..">

                <label>Email</label>
                <input type="text" id="email" name="email" placeholder="Enter Email ID..">

                <label>Subject</label>
                <input type="text" id="subject" name="subject" placeholder="Enter Subject..">

                <label>Message</label>
                <textarea id="message" name="message" placeholder="Write something.." style="height:100px"></textarea>

                    <div class="rws-fields">
                        <label>Captcha Code</label>
                        <div class="row">
                            <div class="col-xs-2">

                                <?php
                                 $rand=substr(rand(),0,4); //only show 4 numbers
                                ?>

                            <input type="text" class="captchaa" id="capt" value="<?=$rand?>"  name="capt" readonly="readonly" > 
                                            
                            </div>
                                         
                            <div class="col-xs-1">
                                <span>
                                 <i class="fa fa-refresh fa-spin"  title="Reload Captcha" onclick="captch()" style="font-size:40px;color:green">  </i> 
                                </span>
                            </div>

                            <div class="col-xs-9">
                             <input type="text" class="input-default" placeholder="Enter Captcha Code" name="capt_code" id="captcha_code" maxlength="6" />
                            </div>
                    </div>
                    </div>

                    <input type="submit" name="submit" id="submit"  value="Submit" class="btn btn-primary" />
                    </form>
        </div>
    </div>

</div>
</div> 
</div>
<button class="btn" style="border-radius:70px;color:black;"><a type="submit" id="pay"  href="plane.php">Razorpay paymentgateway</a></button>
<script type="text/javascript">

//Javascript Captcha validation

function validation()
{


if(document.form1.capt_code.value=="")
{
document.getElementById("error").innerHTML="Enter Captcha!";
document.form1.capt_code.focus();
return false;
}


if(document.form1.capt.value!=document.form1.capt_code.value)
{
document.getElementById("error").innerHTML="Captcha Not Matched!";
document.form1.capt_code.focus();
return false;
}
return true;
}
</script>

<script type="text/javascript">

//Javascript Referesh Random String

function captch() {
    var x = document.getElementById("capt")
    x.value = Math.floor((Math.random() * 10000) + 1);
}
</script>








<?php include("app/gtfooter.php"); ?>