<?php 

include('header.php');

include("includes/config.php"); 



if(isset($_POST["rwsformsubmit"]))
{
				
				$cv_category       	= $_POST["cv_category"];
				$fullname			= $_POST["fullname"];
				$email 				= $_POST["rwsusername"];
				$password 			= md5($_POST["rwspassword"]);				
				$dateofbirth		= $_POST["dateofbirth"];											
				$rank_cat			= $_POST["rank_cat"];
				$prank			    = $_POST["prank"];
				$arank			    = $_POST["arank"];
			

        $resume =time().$_FILES['resume']['name'];

        $temp=  $_FILES['resume']['tmp_name'];

		$cvname = "../usercvdata/$resume";

        move_uploaded_file($temp, "../usercvdata/$resume") ;


	
				/* Insert Code to Database */
				$query_insert = "INSERT INTO `ss_jobseekers` SET  cv_category ='$cv_category',fullname ='$fullname',  email = '$email', password = '$password', dateofbirth ='$dateofbirth', resume = '$cvname', rank_cat = '$rank_cat', rankname = '$prank',applied_rank='$arank', profile_display = 'Yes', profile_access = 'Yes', contact_access = 'Yes', contact_directly = 'Yes', view_certificates = 'Yes', view_certificates_need_approval = 'Yes', status = '1', validate = '0', mstatus = '0', add_date = '$gtcurrenttime'";

                 //echo $query_insert;exit;

		//		$query=mysqli_query($db,$query_insert);

			
	
				$update_result = $db->query($query_insert);

	
				$userid = $db->getLastId();


				$validateid = base64_encode("SS-".$userid);

              if($update_result)  {
                   echo "Register successfully";

              }else{
                  echo "Something Went Wrong";
              }

    }
				
	






?>


<!--   Email ID already exists to our database. Please use another email id for registration.   -->


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>



<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo $baseurl;?>images/favicon.png">
        <title>Team Thalassophile !</title>        
        <link href="<?php echo $baseurl;?>css/global.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo $baseurl;?>css/style.css" rel="stylesheet">
        <link href="<?php echo $baseurl;?>css/responsiveness.css" rel="stylesheet">  


<style>
 /*   .captchaa{
     			background-image: url(images/captchaaa.png) !important;
     }

    .list{
			height: 250px !important; 
    		overflow-y: auto !important;
    		width:100% !important;
		}


	.nice-select { width:100% !important; }
*/
</style>

</head>
<body>
<!--

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Add Crew CV</a>
            </div>
        </div>
    </div>
</div>  
    -->

<div class="rws-maincontentinner" style="padding: 10px ! important;">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
            	<div class="rws-maincontentinn">
                	<div class="rws-module">
                		<h1 class="mtitle">Add Crew CV </h1>
                        <div class="rws-mcontent">  
                            <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                            <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
                             
								<div class="rws-fields">
									<label> Select CV Category</label>   
								<select name="cv_category"  id="cv_category" class="selectheight">	
									<option value="">--Select CV Category--</option>													
									<option value="Marine">For Marine Jobs</option>
									<option value="Shore">For Shore Jobs</option>
									<option value="Oil and Gas">For Oil and Gas Jobs</option>						
								</select>
	                            </div>                   
							
																										
							    <div class="rws-fields">
                                	<label>Enter Your Full Name</label>
                                    <input type="text" name="fullname" id="fullname" value="<?php echo $_SESSION['myForm']['fullname']; ?>" placeholder="*Your Fullname" required />
                                </div>
                               
                                <div class="rws-fields">
                                	<label>Email ID</label>
                                    <input type="email" name="rwsusername" id="rwsusername" value="<?php echo $_SESSION['myForm']['rwsusername']; ?>" placeholder="*Email ID" required />
                                </div>
                                <div class="rws-fields">
                                	<label>Password</label>
                                    <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required />
                                </div>
                               
								<div class="rws-fields">
                                	<label>DOB</label>
                                    <input type="date" name="dateofbirth" id="dateofbirth" value="<?php echo $_SESSION['myForm']['dateofbirth']; ?>" placeholder="*DOB"  />
                                </div>
                                

                    <!--            <div class="rws-fields">
                                	  <label>Select Country</label><br/>

          							  <?php
		               
              		                    $country="select * from ss_countries  where country!='' GROUP BY country order by country ASC";

                                        $result = $db->query($country);
	                                    $rowlist = $result->rows;
              		                 ?>

              						<select name="country">
    								<option selected >-- Select Country --</option>
    								
    								<?php
        								 foreach($rowlist as $key => $row)
	                                      {
            								echo "<option  value='". $row['country'] ."'>" .$row['country'] ."</option>"; 
        								}	
    								?>  
  
  									</select>

                    
                                </div> <br>   -->
        <!----start----------------------------------------tanuja code------------------------>
        						

                         <div class="rws-fields">
                        	<label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
                            <input type="file" name="resume" id="resume" accept="application/msword,application/pdf" />
                            <?php if(!empty($_SESSION['myForm']['resume'])) { echo '<p><a href="'.$baseurl.$_SESSION['myForm']['resume'].'" title="View" target="_blank">Download Resume</a></p>';} ?>
                        </div>   

                         
                       <div class="rws-fields">
                             	<label> Rank Categories</label>   
							<select name="rank_cat"  id="rank_cat" class="selectheight">	
							    <option value="">--Select Category--</option>													
								<option>MARINE</option>
								<option value="Rigs">RIGS/DRILLING RIGS</option>
								<option>OFFSHORE</option>		
								<option>SHORE</option>				
							</select>                      
                          

						  <div class="rws-fields">
							  <label class="rws-flabel"><span>*</span>Present Rank</label>    <br> 
								
								<select name="prank" id="prank">   
												
									<option value="">--Select Present Rank--</option>
																	
								</select> 
						  </div>     

						  <div class="rws-fields">
							  <label class="rws-flabel"><span>*</span>Applied Rank</label>    <br> 
								
								<select name="arank" id="arank">   
												
									<option value="">--Select Applied Rank--</option>
																	
								</select> 
						  </div>     
		                        
                          




                                             
                                <div class="rws-fields text-center">
                                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Register" class="rwsbutton width_100" />
                                </div>   
                                
                             
                            </form>
                        </div>
                    </div>
                    <!-- Module Ends -->
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- ./wrapper -->





<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>

  $.widget.bridge('uibutton', $.ui.button);

</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/raphael/raphael.min.js"></script>

<script src="bower_components/morris.js/morris.min.js"></script>

<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="bower_components/moment/min/moment.min.js"></script>

<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/pages/dashboard.js"></script>

<script src="dist/js/demo.js"></script>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

</body>
</html>


<script>

$("#rank_cat").change(function(){

    var cat=$(this).val();

//	alert(cat);

    var action="rankrequest";

    $.ajax({

        method : "POST",

        data : {cat:cat,action:action},

        url  : "../jobseeker_register_ajax.php",

        success:function(result){

 //        alert(result);

           $("#prank").html(result);

		   $("#arank").html(result);

        }

    });

 });

</script>