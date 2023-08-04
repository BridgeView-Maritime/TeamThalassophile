<?php include("includes/config.php"); ?>

<!-- RWS Header Starts -->

<?php include("app/gtheader.php"); ?>

<!-- RWS Header Starts -->  

<div class="rws-userpages">
	<div class="rws-userpagesinner">
		<div class="container"><h1>Employer Account Validation</h1></div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Employer Account Validation</a>
            </div>
        </div>
    </div>
</div>        

<!-- RWS Dashboard Starts -->

<div class="rws-maincontentinner">
	<div class="container">

    <?php 

	$gt_msgerror= "";

	$_GET["vid"] = str_replace('rEN','=',$_GET["vid"]);

	$vid = base64_decode($_GET["vid"]);

	$validateid = str_replace('SS-','', $vid);

	$query_val = "SELECT * FROM `ss_employer` WHERE `id` =".$validateid;

	$result = $db->query($query_val);

	$total_val = $result->num_rows;	

	if($total_val > 0)

	{

		$row = $result->row;

		if($row["validate"] ==1)

		{

			$error_message = '<div id="rws-formsuccess">Your account has already been validated. Please log in!</div>';	

		}

		else

		{	

			$qvalup = "UPDATE `ss_employer` SET `validate` = '1' WHERE `id` =".$validateid;

			$result_valup = $db->query($qvalup);

			$error_message = '<div id="rws-formsuccess"><p>Hello User,<br /><br />			

			Your '.$sitename.' account has been successfully validated.

			<br />

			<br />

			<strong>'.$sitename.' Admin</strong>			

			</div>';	

		}

		$showform = 1;

		

	}

	else

	{

		$error_message = '<div id="gt-formfeedback">Your email varification code is wrong. Please use the correct link that is in email.</div>';		

		$showform = 0;

	}

	?>

    

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">        
                <div class="rws-maincontentinn">
                    <div class="rws-module">
                        <h3 class="mtitle">Email Verification</h3>
                        <div class="rws-mcontent">
                            <?php echo $error_message; ?>
                        </div>                        
                    </div>
                 </div>
            </div>
        </div>
        
        
    </div>
</div>

<!-- RWS Dashboard Starts -->        

<!-- RWS Footer Starts -->

<?php include("app/gtfooter.php"); ?>

<!-- RWS Footer Starts --> 