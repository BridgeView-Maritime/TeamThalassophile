<?php include("includes/config.php"); 
$about = 1;
include("app/gtheader.php");
?>
<div class="rws-jobdetailsheader">
	<div class="rws-jdhinner">
        <div class="container">
            <h1>Terms &amp; Conditions</h1>
        </div>
    </div>
</div>


<?php

    $query="SELECT * FROM ss_terms"; 
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
                <a href="javascript:void(0)"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span> Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</div>

<div class="rws-content">
	<div class="container">
        <h3><b>Terms & Condition</b></h3>
        <p><?php //echo $row["description"];
         ?></p>
    </div>
</div>

 <?php } ?> 

<?php include("app/gtfooter.php"); ?>