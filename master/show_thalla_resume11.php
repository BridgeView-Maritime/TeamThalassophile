<?php include('../includes/config.php');  $gtpage = "Jobseeker"; $gtjspdf = "Yes";
//checkuserlogin(); 
$id=$_POST['id'];
?>


<style>
    @media  (min-width: 992px){
.col-md-8 {
    width: 68.96666667% !important;
}  }
</style>
<!-- RWS Header Starts -->

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






<!-- RWS Header Starts -->  
    <!--    <div class="rws-userpages">
            <div class="rws-userpagesinner">
                <div class="container"><h1>Review &amp; Generate CV</h1></div>
            </div>
        </div>

        <div class="rws-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?php echo $baseurl;?>">Home</a>
                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        <a href="javascript:void(0)">Review &amp; Generate CV</a>
                    </div>
                </div>
            </div>
        </div>    -->
<!-- RWS Dashboard Starts -->

	<div class="container">
    <div class="row">
    <!--	<div class="col-md-4">
        	<?php  // include("app/jobseekers-leftmenu.php"); ?>        	
        </div>   -->
        
        <?php
			// Get the jobseekers personal info
			$select_query 		= 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowut 				= $select_result->row;
			
			// Get the jobseekers availability info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_availability` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
			$select_result 		= $db->query($select_query);
			$rowavlist 			= $select_result->rows;
			$avlisttotal 		= $select_result->num_rows;
	
	
			// Get the jobseekers employment history info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_employment` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowemplist 		= $select_result->rows;
			$emplisttotal 		= $select_result->num_rows;
			
			// Get the education info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_education` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowedulist 		= $select_result->rows;
			$edulisttotal 		= $select_result->num_rows;
			
			// Get the certificate info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_certificates` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowcerlist 		= $select_result->rows;
			$cerlisttotal 		= $select_result->num_rows;

            // Get the COC certificate info
			$select_query 		= 'SELECT * FROM `ss_addcoc` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowcoclist 		= $select_result->rows;
			$coctotal 		    = $select_result->num_rows;

            // Get the offshore certificate info
			$select_query 		= 'SELECT * FROM `addoffshore` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowofflist 		= $select_result->rows;
			$offtotal 		    = $select_result->num_rows;

            // Get the Other certificate info
			$select_query 		= 'SELECT * FROM `addothers` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowotherlist 		= $select_result->rows;
			$othertotal 		    = $select_result->num_rows;

            // Get the STCW certificate info
			$select_query 		= 'SELECT * FROM `addstcw` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowstcwlist 		= $select_result->rows;
			$stcwtotal 		    = $select_result->num_rows;

           // Get the passport info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_passport` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowpasslist 		= $select_result->rows;
			$passporttotal 		= $select_result->num_rows;

          // Get the cdc info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_cdc` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowcdclist 		= $select_result->rows;
			$cdctotal 		   = $select_result->num_rows;

         // Get the visa info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_visa` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rowvisalist 		= $select_result->rows;
			$visatotal 		    = $select_result->num_rows;

        // Get the NOK info
			$select_query 		= 'SELECT * FROM `nokdetails` WHERE js_id = "'.$id.'"';
			$select_result 		= $db->query($select_query);
			$rownoklist 		= $select_result->rows;
			$noktotal 		    = $select_result->num_rows;
			
			$gtpdfnametosave	= 'resume-for-'.$rowut['firstname'].'-'.$rowut['lastname'].'-'.date("d-m-Y-H-i-s").'.pdf';
			
			
			
		?>
        
        <div class="col-md-8">
        	<div class="rws-module">
                <div class="mtitle">Review Your CV </div>
                <div class="rws-mcontent">
                    <div class="rws-cvdatashow" id="rws-cvdatashow">
                    	
                    	<div class="rws-cvheaderdata">
                        	<div class="row">
                            	<div class="col-sm-3">
                                	<?php if(!empty($rowut['profile_pic'])) { echo '<img src="'.$baseurl.$rowut['profile_pic'].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
                                </div>
                                <div class="col-sm-9">
                               	<p class="nomargin"><em> Fullname :</em><?php echo $rowut['fullname'];?></p>
                                <p class="rwsproheadline nomargin"><em> Mobile :</em><?php echo $rowut['mobile'];?></p>
                              <p class="rwslocation nomargin"><i class="fas fa-map-marker-alt"></i><em> Location :</em> <?php echo $rowut['location'];?>, <?php echo $rowut['country'];?></p>
                              <p class="rwscontactinfo nomargin"><em> Email :</em><?php echo $rowut['email'];?> 
                                </div>
                            </div>
                        </div>
                        <!-- Header Ends -->
                        
                        <?php if(!empty($rowut['additional_skills'])) { ?>
                        <div class="rws-generalcvinfo">
                        	<h5>Additional Skills</h5>
                            <?php echo $rowut['additional_skills']; ?>
                        </div>
                        <?php } ?>
                        
                        <?php if(!empty($rowut['client_work_with'])) { ?>
                        <div class="rws-generalcvinfo">
                        	<h5>Client you worked with</h5>
                            <?php echo $rowut['client_work_with']; ?>
                        </div>
                        <?php } ?>
                        
                        <?php if(!empty($rowut['short_bio'])) { ?>
                        <div class="rws-generalcvinfo">
                        	<h5>Carrer Summary</h5>
                            <?php echo $rowut['short_bio']; ?>
                        </div>
                        <?php } ?>
                        
                        <!-- Availability -->
                        <?php if($avlisttotal>0) { ?>
                        <div class="rws-generalcvinfo">
                        	<h5>Availability</h5>
                            <?php foreach($rowavlist as $key_av=>$val_av)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-6">
                                    	<em>From:</em> <?php echo toshowdateformated($val_av["start_date"]); ?>
                                    </div>
                                    <div class="col-sm-6">
                                    	<em>To:</em> <?php echo toshowdateformated($val_av["end_date"]); ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>	


                
                        <!-- Availability --> 
                        
                        <!-- Employment -->
                        <?php if($emplisttotal>0) { ?>
               <!--         <div class="rws-generalcvinfo">
                        	<h5>Employment History</h5>
                            
                            <div class="rws-listrow rws-listheader">
                                <div class="row">
                                	<div class="col-sm-2">
                                    	Occupation
                                    </div>
                                    <div class="col-sm-2">
                                    	Company
                                    </div>
                                    <div class="col-sm-2">
                                    	Location
                                    </div>
                                    <div class="col-sm-2">
                                    	From
                                    </div>
                                    <div class="col-sm-2">
                                    	To
                                    </div>
                                    <div class="col-sm-2">
                                    	Working Here
                                    </div>
                                </div>
                            </div>
                            
                            <?php foreach($rowemplist as $key_emp=>$val_emp)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-2">
                                    	<?php echo $val_emp["occupation"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php echo $val_emp["company"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php echo $val_emp["location"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php echo $val_emp["start_month"]; ?> <?php echo $val_emp["start_year"]; ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php if(!empty($val_emp["end_year"])) { echo $val_emp["end_month"]; ?> <?php echo $val_emp["end_year"]; } else { echo "-"; } ?>
                                    </div>
                                    <div class="col-sm-2">
                                    	<?php if(!empty($val_emp["currently_work_hear"])) { echo $val_emp["currently_work_hear"]; } else {echo "-"; } ?>
                                    </div>
                                </div>
                            </div>
                            
                        
                            <?php
							$_SESSION['myForm']=array();
							
					
                            $select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE js_id = "'.$id.'"';
							$select_result = $db->query($select_query);
							$empitems = $select_result->rows;
							$emptotal = $select_result->num_rows;
							
							if($emptotal>0)
							{
								foreach($empitems as $key => $rowemp) { 
									$_SESSION['myForm']['ship_name'][] 			= $rowemp["ship_name"];
									$_SESSION['myForm']['ship_type'][] 			= $rowemp["ship_type"];
									$_SESSION['myForm']['dp_system'][] 			= $rowemp["dp_system"];
									$_SESSION['myForm']['grt'][] 				= $rowemp["grt"];
									$_SESSION['myForm']['kw'][] 				= $rowemp["kw"];
									$_SESSION['myForm']['position'][] 			= $rowemp["position"];
									$_SESSION['myForm']['sign_on'][] 			= toshowdateformated($rowemp["sign_on"]);
									$_SESSION['myForm']['sign_off'][] 			= toshowdateformated($rowemp["sign_off"]);
                                    $_SESSION['myForm']['total_days'][] 			= $rowemp["total_days"];
								}
							}

                            
							
							if($emptotal>0) {
							$ier=0;
							foreach($_SESSION['myForm']["ship_name"] as $key_emp=>$val_emp) 
							{
							?>
							
							<div class="rws-module">
							<div class="rws-mcontent">
								<div class="rws-fields row">    
									<div class="col-sm-4"> 
										<p class="nomargin"><em>Ship Name</em></p> 
										<?php echo $_SESSION['myForm']["ship_name"][$ier];?>
									</div>                    
									<div class="col-sm-4">
										<p class="nomargin"><em>Ship Type</em></p>
										 <?php echo $array_shiptype[$_SESSION['myForm']["ship_type"][$ier]]; ?>
									</div>
                                    <div class="col-sm-4">
										<p class="nomargin"><em>DP System</em></p>
										<?php echo $array_dpsystem[$_SESSION['myForm']["dp_system"][$ier]]; ?>
									</div>
								</div>
							
								
								<div class="rws-fields row">    
									<div class="col-sm-4">
										 <p class="nomargin"><em>Work Position</em></p>
										<?php echo $array_shipworkposition[$_SESSION['myForm']["position"][$ier]]; ?>
									</div>                    
									<div class="col-sm-4">
										<p class="nomargin"><em>GRT</em></p>
										<?php echo $_SESSION['myForm']['grt'][$ier]; ?>
									</div>
                                    <div class="col-sm-4">
										<p class="nomargin"><em>KV</em></p>
										<?php echo $_SESSION['myForm']['kw'][$ier]; ?>
									</div>        
								</div>
								
								
								<div class="rws-fields row" style="padding:0;">
										<div class="col-sm-4">
											<p class="nomargin"><em>Sign On</em></p>
                                            <?php echo $_SESSION['myForm']['sign_on'][$ier]; ?>
										</div>
										<div class="col-sm-4">
                                        	<p class="nomargin"><em>Sign Off</em></p>
											<?php echo $_SESSION['myForm']['sign_off'][$ier]; ?>
										</div>
									</div>
								                
                                </div>
                            </div>                                 
                            <?php $ier++; } }  ?>
                            
                           
							
                            <?php } ?>
                        </div>
                        <?php } ?>	   -->
                        <!-- Employment -->
    
 <!---------start---------new code for table Sea Services--------------->
    
      <?php 
      $_SESSION['myForm']=array();
							
      //	$select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE `emp_id`="'.$val_emp["id"].'" AND js_id = "'.$_SESSION["USER"]['ID'].'"';
          $select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE js_id = "'.$id.'"';
          $select_result = $db->query($select_query);
          $empitems = $select_result->rows;
          $emptotal = $select_result->num_rows;
          
          if($emptotal>0)
          {
              foreach($empitems as $key => $rowemp) { 
                  $_SESSION['myForm']['company'][]			    = $rowemp["company"];
                  $_SESSION['myForm']['ship_name'][] 			= $rowemp["ship_name"];
                  $_SESSION['myForm']['ship_type'][] 			= $rowemp["ship_type"];
                  $_SESSION['myForm']['dp_system'][] 			= $rowemp["dp_system"];
                  $_SESSION['myForm']['grt'][] 				    = $rowemp["grt"];
                  $_SESSION['myForm']['kw'][] 				    = $rowemp["kw"];
                  $_SESSION['myForm']['position'][] 			= $rowemp["position"];
                  $_SESSION['myForm']['sign_on'][] 			    = toshowdateformated($rowemp["sign_on"]);
                  $_SESSION['myForm']['sign_off'][] 			= toshowdateformated($rowemp["sign_off"]);
                  $_SESSION['myForm']['total_days'][] 			= $rowemp["total_days"];
              }
          }
      
      if($emptotal>0) {
          ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Sea Services Details</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>
      <td style='padding:5px;font-size:15px'>Company</td>   
       <td style='padding:5px;font-size:15px'>Ship Name</td>  
       <td style='padding:5px;font-size:15px'>Ship Type</td>  
       <td style='padding:5px;font-size:15px'>Sign On</td>  
       <td style='padding:5px;font-size:15px'>Sign Off</td>  
       <td style='padding:5px;font-size:15px'>Total Days</td>  

       </tr>    
                <?php   // foreach($rowedulist as $key_edu=>$val_edu)  { 
                $ier=0;
                foreach($_SESSION['myForm']["ship_name"] as $key_emp=>$val_emp) 
                { 
                                        
                ?>
       <tr>
           
       <td style='padding: 5px;font-size:15px'><?php echo $_SESSION['myForm']['company'][$ier];?></td>  
      
       <td style='padding: 5px;font-size:15px'><?php echo $_SESSION['myForm']["ship_name"][$ier];?></td>

   <!--    <td style='padding: 5px;font-size:15px'> <?php echo $array_shiptype[$_SESSION['myForm']["ship_type"][$ier]]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $array_dpsystem[$_SESSION['myForm']["dp_system"][$ier]]; ?></td>  -->

       <td style='padding: 5px;font-size:15px'> <?php echo $_SESSION['myForm']['ship_type'][$ier]; ?></td>

       <td style='padding: 5px;font-size:15px'> <?php echo $_SESSION['myForm']['sign_on'][$ier]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $_SESSION['myForm']['sign_off'][$ier]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $_SESSION['myForm']['total_days'][$ier]; ?></td>


       </tr>
       <?php $ier++; } }  ?>
       

   </table>               
</div>         
   <?php // } ?>	        
             
             
<!-------end-----------new code for table--------------->
                           
                        
    
     <!---------start---------new code for table Educational--------------->
      <!-- Educational Qualification -->
      <?php if($edulisttotal>0) { ?>

     <div class="rws-generalcvinfo">
        <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
            
            
            <h4>Educational Details</h4>           
            <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

            <td style='padding:5px;font-size:15px'>University</td>  
            <td style='padding:5px;font-size:15px'>Degree</td>  
            <td style='padding:5px;font-size:15px'>Start Year</td>  
            <td style='padding:5px;font-size:15px'>End Year</td>  

            </tr>    
            <?php foreach($rowedulist as $key_edu=>$val_edu)  { ?>
            <tr>

            <td style='padding: 5px;font-size:15px'><?php echo $val_edu["school"]; ?></td>

            <td style='padding: 5px;font-size:15px'><?php echo $val_edu["degree"]; ?></td>

            <td style='padding: 5px;font-size:15px'><?php echo $val_edu["start_year"]; ?></td>

            <td style='padding: 5px;font-size:15px'><?php echo $val_edu["end_year"]; ?></td>

            </tr>
            <?php } ?>     
            
 
        </table>               
    </div>              
        <?php } ?>	        
                  
                  
     <!-------end-----------new code for table--------------->
                  
     <!---------start---------new code for table Certificates COC--------------->
      
      <?php if($coctotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Certificates COC</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Certificate</td>  
       <td style='padding:5px;font-size:15px'>Certificate No</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowcoclist as $key_cer=>$val_cer)  { ?>
       <tr>

<!--   <td style='padding: 5px;font-size:15px'><?php echo $array_all_certificate[$val_cer["cocname"]]; ?></td>  -->

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_cer["cocname"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_cer["cocnumber"]; ?></td>
      
       <td style='padding: 5px;font-size:15px'>	<?php echo $val_cer["cocissue"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_cer["cocexp"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->

<!---------start---------new code for table Certificates OFFSHORE--------------->
      
<?php if($offtotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Certificates Offshore</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Certificate</td>  
       <td style='padding:5px;font-size:15px'>Certificate No</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowofflist as $key_cer=>$val_off)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_off["certificate"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_off["number"]; ?></td>
      
       <td style='padding: 5px;font-size:15px'>	<?php echo $val_off["issuedate"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_off["expdate"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->


<!---------start---------new code for table Certificates OTHER--------------->
      
<?php if($othertotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Certificates Other</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Certificate</td>  
       <td style='padding:5px;font-size:15px'>Certificate No</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowotherlist as $key_cer=>$val_other)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_other["certificate"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_other["number"]; ?></td>
      
       <td style='padding: 5px;font-size:15px'>	<?php echo $val_other["issuedate"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_other["expdate"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->

<!---------start---------new code for table Certificates OTHER--------------->
      
<?php if($stcwtotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Certificates STCW</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Certificate</td>  
       <td style='padding:5px;font-size:15px'>Certificate No</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowstcwlist as $key_cer=>$val_stcw)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_stcw["certificate"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_stcw["number"]; ?></td>
      
       <td style='padding: 5px;font-size:15px'>	<?php echo $val_stcw["issuedate"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_stcw["expdate"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->
             
    <!---------start---------new code for table Passport--------------->
    
      <?php if($passporttotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Passport Details</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Country</td>  
       <td style='padding:5px;font-size:15px'>Passport No</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowpasslist as $key_pass=>$val_pass)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'><?php echo $val_pass["country"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_pass["passport_number"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_pass["issue_date"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_pass["expire_date"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->                     
                    
   <!---------start---------new code for table CDC--------------->
    
   <?php if($cdctotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>CDC Details</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Country</td>  
       <td style='padding:5px;font-size:15px'>CDC No</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowcdclist as $key_cdc=>$val_cdc)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_cdc["country"]; ?></td>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_cdc["cdc_no"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_cdc["issue_date2"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_cdc["expire_date2"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->                     
                        
                       
 <!---------start---------new code for table visa--------------->
    
 <?php if($visatotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>Visa Details</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>Country</td>  
       <td style='padding:5px;font-size:15px'>	Visa Type</td>  
       <td style='padding:5px;font-size:15px'>Issue Date</td>  
       <td style='padding:5px;font-size:15px'>Expiry Date</td>  

       </tr>    
       <?php foreach($rowvisalist as $key_visa=>$val_visa)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_visa["country"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_visa["visa_type"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_visa["issue_date1"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_visa["expire_date1"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->     


                     
 <!---------start---------new code for table nok details--------------->
    
 <?php if($noktotal>0) { ?>

<div class="rws-generalcvinfo">
   <table border='1' cellspacing='0' style='text-align-last: center;background:white;color:black;font:normal 18px sans-serif;margin-left:10px;width: 90%;'>    
       
       
       <h4>NOK Details</h4>           
       <tr style='padding: 5px;font-size:15px;background-color: #0079ab;color: white;'>

       <td style='padding:5px;font-size:15px'>NOK Name</td>  
       <td style='padding:5px;font-size:15px'>Relation</td>  
       <td style='padding:5px;font-size:15px'>Contact</td>  
       <td style='padding:5px;font-size:15px'>Email</td>  
       <td style='padding:5px;font-size:15px'>Address</td>  


       </tr>    
       <?php foreach($rownoklist as $key_visa=>$val_nok)  { ?>
       <tr>

       <td style='padding: 5px;font-size:15px'>	<?php echo $val_nok["nokname"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_nok["nokrel"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_nok["nokcontact"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_nok["nok_emailid"]; ?></td>

       <td style='padding: 5px;font-size:15px'><?php echo $val_nok["nokaddress"]; ?></td>

       </tr>
       <?php } ?>     
       

   </table>               
</div>              
   <?php } ?>	        
             
             
<!-------end-----------new code for table--------------->     
                      
                                                             
                    </div>
                    
                    <!-- Data Div Ends -->
                 <!-- <p><a href="jobseekers-generate-cv-pdf.php" target="_blank">Generate PDF</a></p>   -->
                    <!--<button id="generatecv" onClick="document.location.href='jobseekers-generate-cv-pdf.php'" >Generate PDF</button>-->
                    
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->


<!-- RWS Footer Starts --> 