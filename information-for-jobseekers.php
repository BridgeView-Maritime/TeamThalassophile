<?php include("includes/config.php"); 
$about = 1;
include("app/gtheader.php");
?>
<div class="rws-jobdetailsheader">
    <div class="rws-jdhinner">
        <div class="container">
            <h1>Info for Jobseeker</h1>
        </div>
    </div>
</div>


<?php

    $query="SELECT * FROM ss_info_jobseeker"; 
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
                <a href="javascript:void(0)"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span> Info for Jobseeker's</a>
            </div>
        </div>
    </div>
</div>

<div class="rws-content">
    <div class="container">

        <p><?php echo $row["description"]; ?></p>
    </div>


 <?php } ?> 

 <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 150px;margin-left: 300px;">
  <a href="contact-us.php" style="color:white !important;">Contact Us</a>
</button>

</div> <br>



 



<?php include("app/gtfooter.php"); ?>