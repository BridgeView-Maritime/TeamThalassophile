<?php include("includes/config.php"); $rwspagevar = "registerjobseeker";

$_SESSION['myForm']="";
$gt_msgerror= "";

include("app/gtheader.php"); 
?>
<div class="rws-maincontentinner">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
            	<div class="rws-maincontentinn">
                	<div class="rws-module">
                		<h1 class="mtitle">Thank you!</h1>
                        <div class="rws-mcontent">  
                            <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                            <p>Hello User, thank you for registering to our newsletter.</p>
                        </div>
                    </div>
                    <!-- Module Ends -->
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php include("app/gtfooter.php"); ?>