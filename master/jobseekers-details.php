<?php include('header.php'); $gtpage = 'jobseekers-list'; $rwseditor=1;

$_SESSION['myForm']="";

$js_id = $_GET["fid"];



// Get the jobseekers personal info
			$select_query 		= 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$js_id.'"';
			$select_result 		= $db->query($select_query);
			$rowut 				= $select_result->row;
			
			// Get the jobseekers availability info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_availability` WHERE js_id = "'.$js_id.'"';
			$select_result 		= $db->query($select_query);
			$rowavlist 			= $select_result->rows;
			$avlisttotal 		= $select_result->num_rows;
	
	
			// Get the jobseekers employment history info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_employment` WHERE js_id = "'.$js_id.'"';
			$select_result 		= $db->query($select_query);
			$rowemplist 		= $select_result->rows;
			$emplisttotal 		= $select_result->num_rows;
			
			// Get the education info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_education` WHERE js_id = "'.$js_id.'"';
			$select_result 		= $db->query($select_query);
			$rowedulist 		= $select_result->rows;
			$edulisttotal 		= $select_result->num_rows;
			
			// Get the certificate info
			$select_query 		= 'SELECT * FROM `ss_jobseekers_certificates` WHERE js_id = "'.$js_id.'"';
			$select_result 		= $db->query($select_query);
			$rowcerlist 		= $select_result->rows;
			$cerlisttotal 		= $select_result->num_rows;
			
			
?>



        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->

            <?php include('sidebar.php'); ?>



            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        Jobseeker Details

                        <small><?php echo $reg_subtitle; ?></small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li><a href="<?php echo $baseurl; ?>master/jobseekers-list.php"><i class="fa fa-leaf"></i> Jobseekers List </a></li>

                        <li class="active">Jobseeker Details</li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="" method="post" enctype="multipart/form-data">

                	<div class="row">

                        <div class="col-md-12">

                        <?php if(!empty($errors)) {

                            echo '<div id="gt-formfeedback"><b><font size="4">WHOOPS! Please review the following issues:</font></b><ul>';

                                foreach ($errors as $msg) { //prints each error

                                echo "<li>$msg</li>";

                                } // end of foreach

                                echo '</ul></div>'; }

                                

                                if($msg_result !="") { echo $msg_result; }

                        ?>

                        </div>

                    </div>

					<div class="row">

                    

                    	<div class="col-md-12">

                        	<div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title">Jobseeker Details</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->

                                	<?php if(trim($row['id']) !="") { ?>

                                    	<input name="post_id" type="hidden" value="<?php echo $row['id']; ?>" />

                                        <input name="oldimage_1" type="hidden" value="<?php echo $_SESSION['myForm']['college_photo']; ?>" />

                        				<input name="uploadfolder" type="hidden" value="<?php echo $_SESSION['myForm']['imgurl']; ?>" />

                                    <?php } ?>

                                    <div class="box-body">

                                        
                                    <div class="rws-cvdatashow" id="rws-cvdatashow">
                    	
                    	<div class="rws-cvheaderdata">
                        	<div class="row">
                            	<div class="col-sm-3">
                                	<img src="<?php echo $baseurl.$rowut['profile_pic']; ?>" alt="<?php echo $rowut['firstname'].' '.$rowut['lastname'];?>" class="rws-profileimg" />

                                </div>
                                <div class="col-sm-9">
                                	<p class="nomargin"><?php echo $rowut['firstname'].' '.$rowut['lastname'];?></p>
                                    <p class="rwsproheadline nomargin"><?php echo $rowut['professional_headline'];?></p>
                                    <p class="rwslocation nomargin"><i class="fas fa-map-marker-alt"></i> <?php echo $rowut['location'];?>, <?php echo $rowut['country'];?></p>
                                    <p class="rwscontactinfo nomargin"><i class="far fa-envelope"></i> <?php echo $rowut['email'];?> &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-mobile-alt"></i> <?php echo $rowut['mobile'];?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Header Ends -->
                        
                        <?php if(!empty($rowut['additional_skills'])) { ?>
                        <div class="rws-generalcvinfo">
                        	<h6>Additional Skills</h6>
                            <?php echo $rowut['additional_skills']; ?>
                        </div>
                        <?php } ?>
                        
                        <?php if(!empty($rowut['client_work_with'])) { ?>
                        <div class="rws-generalcvinfo">
                        	<h6>Client you worked with</h6>
                            <?php echo $rowut['client_work_with']; ?>
                        </div>
                        <?php } ?>
                        
                        <?php if(!empty($rowut['short_bio'])) { ?>
                        <div class="rws-generalcvinfo">
                        	<h6>Short Bio</h6>
                            <?php echo $rowut['short_bio']; ?>
                        </div>
                        <?php } ?>
                        
                        <!-- Availability -->
                        <?php if($avlisttotal>0) { ?>
                        <div class="rws-generalcvinfo">
                        	<h6>Availability</h6>
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
                        <div class="rws-generalcvinfo">
                        	<h6>Employment History</h6>
                            
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
                            
                            <!-- Offshore emp history if available -->
                            <?php
							$_SESSION['myForm']=array();
							
							$select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE `emp_id`="'.$val_emp["id"].'" AND js_id = "'.$_SESSION["USER"]['ID'].'"';
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
									$_SESSION['myForm']['sign_on'][] 			= $rowemp["sign_on"];
									$_SESSION['myForm']['sign_off'][] 			= $rowemp["sign_off"];
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
								<!-- Row Ends -->
								
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
								<!-- Row Ends --> 
								
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
								<!-- Row Ends -->                    
                                </div>
                            </div>                                 
                            <?php $ier++; } }  ?>
                            
                            <!-- Offshore emp history if available -->
							
                            <?php } ?>
                        </div>
                        <?php } ?>	
                        <!-- Employment -->
                        
                        <!-- Educational Qualification -->
                        <?php if($edulisttotal>0) { ?>
                        <div class="rws-generalcvinfo">
                        	<h6>Educational Details</h6>
                            <div class="rws-listrow rws-listheader">
                                <div class="row">
                                	<div class="col-sm-3">
                                    	School
                                    </div>
                                    <div class="col-sm-3">
                                    	Degree
                                    </div>
                                    <div class="col-sm-3">
                                    	Start Year
                                    </div>
                                    <div class="col-sm-3">
                                    	End Year
                                    </div>                                    
                                </div>
                            </div>
                            
                            <?php foreach($rowedulist as $key_edu=>$val_edu)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-3">
                                    	<?php echo $val_edu["school"]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo $val_edu["degree"]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo $val_edu["start_year"]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo $val_edu["end_year"]; ?>
                                    </div>                                    
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>	
                        <!-- Educational Qualification --> 
                        
                        <!-- Certificates -->
                        <?php if($cerlisttotal>0) { ?>
                        <div class="rws-generalcvinfo">
                        	<h6>Certificates</h6>
                            <div class="rws-listrow rws-listheader">
                                <div class="row">
                                	<div class="col-sm-6">
                                    	Name
                                    </div>
                                    <div class="col-sm-3">
                                    	Expiry
                                    </div>
                                    <div class="col-sm-3">
                                    	Certificate copy
                                    </div>                                                                       
                                </div>
                            </div>
                            
                            <?php foreach($rowcerlist as $key_cer=>$val_cer)  { ?>
                            <div class="rws-listrow">
                                <div class="row">
                                	<div class="col-sm-6">
                                    	<?php echo $array_all_certificate[$val_cer["name"]]; ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php echo toshowdateformated($val_cer["expiry_date"]); ?>
                                    </div>
                                    <div class="col-sm-3">
                                    	<?php if(!empty($val_cer["authority"])) { echo '<p><a href="'.$baseurl.$val_cer["authority"].'" title="View" target="_blank">View Certificates</a></p>'; } else { echo "-"; } ?>
                                    </div>                                   
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>		
                        <!-- Availability --> 
                                

                    </div>                                    

                                        

                                    </div><!-- /.box-body -->                                    

                                

                            </div>

                        </div>

                        

                        </div>

                        

                        <div class="row">

                            <div class="col-md-12">

                                <div class="box box-warning">

                                    <div class="box-footer" style="text-align:center">

                                         <button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='jobseekers-list.php'"> Back </button>

                                     </div>

                                </div>

                            </div>

                        </div>

                        </form>

                    

                    

                          	

              </section><!-- /.content -->

              

              <footer>

              		<?php include('footer-copyright.php'); ?>

              </footer>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>