<?php include("includes/config.php"); 
$about = 1;
include("app/gtheader.php");
?>
<div class="rws-jobdetailsheader">
    <div class="rws-jdhinner">
        <div class="container">
            <h1>About Us</h1>
            
        </div>
    </div>
</div>
<div>
<button class="btn" style="border-radius:70px;color:black;"><a type="submit" id="pay"  href="plane.php">Razorpay paymentgateway</a></button>
</div>
<?php

    $query="SELECT * FROM ss_aboutus"; 
    $rs = $db->query($query);

    $rowlist = $rs->rows;
    $j=1; 

    foreach($rowlist as $key => $row) {
   
?>


<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
        
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                
                <a href="javascript:void(0)"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span> About Us</a>
            </div>
        </div>
    </div>
</div>
<div class="rws-content">
<div class="container">
<div class="row">
 <div class="container">
 <div class="col-lg-6">
  
 <button   class="btn" style="border-radius:70px;color:black;"><a type="submit" id="pay"  href="pay.php?plan_name=<?php echo  $data['plan_name']?>&&plan_price=<?php echo  $data['plan_price']?>&&jobes_no=<?php echo  $data['jobes_no']?>">Sign Up</a></button>
    <img src="images/ship5.jpg" alt="" style="height: 350px; width:600px">
 </div>
    <div class="col-lg-6"> 
        <p><?php echo $row["description"]; ?></p>
        
    </div>
    </div>
    </div>
</div>

 <?php } ?> 

<?php include("app/gtfooter.php"); ?>
