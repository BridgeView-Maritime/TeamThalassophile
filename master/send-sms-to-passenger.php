<?php include('header.php'); $gtpage = 'export-order'; $rwseditor=0; $gtdateopt="on";  checkadminroles('reports');

$_SESSION['myForm']="";

if(isset($_GET["rws-submitsend"]))
{
	$start_date 		= $_GET["start_date"];
	$end_date 			= $_GET["end_date"];
	$parent_id 			= $_GET["parent_id"];
	
	$order_status 		= $_GET["order_status"];
	$bus_no 			= $_GET["bus_no"];
	$driver_contact 	= $_GET["driver_contact"];
	
	if(!empty($start_date))
	{	
		if($_GET["start_date"]!="") { $nquery .= " AND journey_date='$start_date' "; }	
		if($_GET["parent_id"]!="") { $nquery .= " AND service_id='$parent_id' "; }	
		
		if($_GET["order_status"]!="") { $nquery .= " AND order_status='$order_status' "; }	
		
		$query="SELECT order_id, order_reference_number, customer_name, email, mobile, `from`, `to`, journey_date, start_time, end_time, pickup_point, drop_point, package_price, quantity, totalamount, order_status FROM `ss_consumer_order` WHERE order_id > 0 ".$nquery."  group by order_id ORDER BY dateoforder ASC";
	
		$rs = $db->query($query);
		$foundnum = $rs->num_rows;
		
		if($foundnum>0) 
		{
			$rowlist = $rs->rows;
			$j=1; 
			foreach($rowlist as $key => $row) 
			{ 
			  
			  $order_reference_number 		= $row["order_reference_number"];
			  $customer_name 				= $row["customer_name"];
			  $email 						= $row["email"];
			  $mobile 						= $row["mobile"];
			  
			  $from 						= $row["from"];
			  $to 							= $row["to"];
			  $journey_date 				= $row["journey_date"];
			  $start_time 					= $row["start_time"];			  
			  $pickup_point 				= $row["pickup_point"];
			  
			  $package_price 				= $row["package_price"];
			  $quantity 					= $row["quantity"];
			  $totalamount 					= $row["totalamount"];
			  
			  $showthanksmsg .='<p>'.$order_reference_number.' - '.$customer_name.'</p>';
			  
			  $textmsg2 = 'Ticket Details '.$from.'-'.$to.' Travel Date '.togetdatemonthonly($journey_date).' Time '.togettimeformat($start_time).' PNR '.$order_reference_number.' Total Seat '.$quantity.' Pickup '.$pickup_point.' Bus No. - '.$bus_no.' Contact '.$driver_contact;
			//echo "<br/><br/>";
			  $usermobile2 = $mobile;

			  sendsms($usermobile2,$textmsg2);
			  
			  $subject = $sitename." Booking Details - PNR No. ".$order_reference_number;
			  
			  $emailcode = '<tr>
								<td width="25%">PNR</td>
								<td>'.$order_reference_number.'</td>
							  </tr><tr>
								<td width="25%">Name</td>
								<td>'.$customer_name.'</td>
							  </tr>
							  <tr>
								<td>Email ID</td>
								<td>'.$email.'</td>
							  </tr>
							  <tr>
								<td>Mobile</td>
								<td>'.$mobile.'</td>
							  </tr>
							  <tr>
								<td>Journey Date</td>
								<td>'.$journey_date.'</td>
							  </tr>
							  <tr>
								<td>Route</td>
								<td>'.$from.' To '.$to.'</td>
							  </tr>
							  <tr>
								<td>Departure Time</td>
								<td> '.$start_time.'</td>
							  </tr>							  
							  <tr>
								<td>Pickup Location</td>
								<td>'.$pickup_point.'</td>
							  </tr>							  
							  <tr>
								<td>Total Seat</td>
								<td>'.$quantity.'</td>
							  </tr>
							  <tr>
								<td>Price per Seat</td>
								<td>Rs. '.$package_price.'</td>
							  </tr>
							  <tr>
								<td>Total Price</td>
								<td>Rs. '.$quantity*$package_price.'</td>
							  </tr>';
			  
			  $body = $emailheader.'
			  <tr>
				<td style="padding:10px;margin:0;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
				Dear '.$customer_name.', your ticket details with bus number and driver contact number is as follows.
				<br/><br/>	
				<strong>Bus No:</strong> '.$bus_no.'<br/><br/>
				
				<strong>Driver Contact No:</strong> '.$driver_contact.'
				<br/><br/>	
				<table width="100%" border="0" cellspacing="5" cellpadding="5">
		  <tr>
		  
		  '.$emailcode.'
		  
		  </tr>
		</table>
			
				</td>
			  </tr>
			  '.$emailfooter;
		
				sendmail($email,$subject,$admin_fromemail,$admin_fromname,$body,$path,$resumefilename);
			
			}
		}
		//echo "<br/><br/>";
		$_SESSION["gtThanksMSGbooking"]='<div id="gt-formsuccess"><strong style="font-size:18px;"><p>Tickets has been sent to following passengers.</strong></br><span style="color:#3c8dbc ;"><strong>Journey Date:</strong>&nbsp;&nbsp;<em>'.$_GET["start_date"].'</em> </span> &nbsp;&nbsp;&nbsp;&nbsp; <span style="color:#f39c12;"><strong>Route:</strong>&nbsp;&nbsp;<em>'.$_GET["path"].'</em></span></p>'.$showthanksmsg.'</div>';
		
		echo "<script>document.location.href='".$baseurl."master/send-sms-to-passenger.php'</script>";	
		
		exit;
				
	}
}

	$reg_title = 'Send Ticket Details to Passenger';
	$reg_subtitle = 'Send Ticket Details to Passenger Page';
	$reg_breadcrumb = 'Send Ticket Details to Passenger';
	$reg_button = 'Show Passenger List';
	
	if(!isset($_GET["order_status"]))
	{
		$_GET["order_status"] =1;
	}

?>



        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->

            <?php include('sidebar.php'); ?>



            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        <?php echo $reg_title; ?>
                        <small><?php echo $reg_subtitle; ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $reg_breadcrumb; ?></li>
                    </ol>
                </section>



                <!-- Main content -->
                <section class="content">
                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="" method="get" enctype="multipart/form-data">

                	<div class="row">

                        <div class="col-md-12">
                        
                        <?php if(isset($_SESSION["gtThanksMSGbooking"])) { echo $_SESSION["gtThanksMSGbooking"]; unset($_SESSION["gtThanksMSGbooking"]); }?>

                        <?php 
						
						if(!empty($errors)) {

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

                                    <h3 class="box-title">Send Ticket Criteria</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Journey Date<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="start_date" placeholder="Journey Date" id="start_date" class="form-control rwsdatecal" value="<?php if(isset($_GET["start_date"])) { echo $_GET["start_date"]; } else { echo $gtcurrentdate;} ?>" autocomplete="off"></div>
                                        </div>
                                        
                                        <div class="form-group row" style="display:none;">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Order Status<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                            	<p><input type="radio" name="order_status" id="order_status_1" value="1" <?php if($_GET["order_status"]==1) { echo 'checked="checked"'; } ?> /> Successful &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_2" value="0" <?php if($_GET["order_status"]==0) { echo 'checked="checked"'; } ?> /> Pending &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_3" value="2" <?php if($_GET["order_status"]==2) { echo 'checked="checked"'; } ?>/> Cancelled &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_4" value="3" <?php if($_GET["order_status"]==3) { echo 'checked="checked"'; } ?>/> Failed</p>
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Route Name<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                                <div class="ui-widget">
                                                    <input type="text" name="path" value="<?php echo $_GET["path"]; ?>" size="100" class="ui-autocomplete-input form-control" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" placeholder="Type Bus Route Name">
                                                    <input type="hidden" name="parent_id" value="<?php echo $_GET["parent_id"]; ?>">    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Bus Number<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="bus_no" placeholder="*Bus Number" id="bus_no" class="form-control" value="<?php if(isset($_GET["bus_no"])) { echo $_GET["bus_no"]; } ?>" autocomplete="off" required="required"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Driver Contact Number<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="driver_contact" placeholder="*Driver Contact Number" id="driver_contact" class="form-control" value="<?php if(isset($_GET["driver_contact"])) { echo $_GET["driver_contact"]; } ?>" autocomplete="off" required="required"></div>
                                        </div>
                                        
                                         <div class="form-group row">
                                            <div class="col-md-2">                                        		
                                          			&nbsp;
                                    		 </div>
                                             <div class="col-md-10">                                        		
                                          		<button class="btn btn-primary" type="submit" name="rws-submit"> <?php echo $reg_button; ?> </button>
                                    		 </div>
                                     	</div>
                                        
                                    </div><!-- /.box-body -->                                    

                                

                            </div>

                        </div>

                        

                        </div>

                        <?php
						$nquery = "";
	
						$start_date = $_GET["start_date"];
						$end_date = $_GET["end_date"];
						$parent_id = $_GET["parent_id"];
						
						$order_status = $_GET["order_status"];
						
						if(!empty($start_date)) {
						
						if($_GET["start_date"]!="") { $nquery .= " AND journey_date='$start_date' "; }	
						if($_GET["start_date"] && $_POST["end_date"]!="") { $nquery .= " AND journey_date BETWEEN '$start_date' AND '$end_date' "; }
						if($_GET["parent_id"]!="") { $nquery .= " AND service_id='$parent_id' "; }	
						
						if($_GET["order_status"]!="") { $nquery .= " AND order_status='$order_status' "; }	
							
						$query="SELECT order_id, order_reference_number, customer_name, email, mobile, `from`, `to`, journey_date, start_time, end_time, pickup_point, drop_point, package_price, quantity, totalamount, order_status FROM `ss_consumer_order` WHERE order_id > 0 ".$nquery."  group by order_id ORDER BY dateoforder ASC";
						
						$rs = $db->query($query);
						$foundnum = $rs->num_rows;
						
						if($order_status==0) { $showstatus = '<span style="color:#00c0ef;"><strong>Order Status:</strong>&nbsp;&nbsp;<em>Pending</em> </span>'; }
						if($order_status==1) { $showstatus = '<span style="color:#00a65a;"><strong>Order Status:</strong>&nbsp;&nbsp;<em>Successful</em> </span>'; }
						if($order_status==2) { $showstatus = '<span style="color:#f56954;"><strong>Order Status:</strong>&nbsp;&nbsp;<em>Cancelled</em> </span>'; }
						if($order_status==3) { $showstatus = '<span style="color:#f56954;"><strong>Order Status:</strong>&nbsp;&nbsp;<em>Failed</em> </span>'; }
						
						?>

                        <div class="row">

                            <div class="col-md-12">
                            	

                                <div class="box box-warning">
                                <?php if($foundnum>0) { ?>
                                
                               <p style="display:block; overflow:hidden; padding:10px; text-align:right; "><button class="btn btn-primary" type="submit" name="rws-submitsend" style="font-size:18px;"> Send Details to Passenger </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="printDiv();" class="btn btn-warning"  style="font-size:18px;"><i class="fa fa-print" aria-hidden="true"></i> Print</a></p>
                               
              <?php } ?>                  	
                                    
                                    <?php if($foundnum>0) { ?>
									
                                    <div id="rwsprintdivcontent">
                                    
                                   <div class="box-header">
									
                                    <h3 class="box-title" style="overflow:hidden;">
                                    <span style="color:#000 ;"><strong>Date:</strong>&nbsp;&nbsp;<em><?php echo $_GET["start_date"];?></em> </span>
                                    &nbsp;&nbsp;&nbsp;<span style="color:#000;"><strong>Route:</strong>&nbsp;&nbsp;<em><?php echo $_GET["path"];?></em> </span><br /><br />
                                    <span style="color:#000;"><strong>Bus No:</strong>&nbsp;&nbsp;<em><?php echo $_GET["bus_no"];?></em> </span>
                                    &nbsp;&nbsp;&nbsp;<span style="color:#000;"><strong>Driver No:</strong>&nbsp;&nbsp;<em><?php echo $_GET["driver_contact"];?></em> </span>
                                    </h3> 
                                	</div><!-- /.box-header -->
                                    
                                    
									
                                    <table id="example1" class="table table-bordered table-striped" style="width:100%; border:1px solid #666; border-collapse:collapse;">
                                        <thead>
                                            <tr>
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">PNR</th>
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">Name</th>
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">Mobile</th>                                                  
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">From</th> 
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">To</th>
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">Seat(s)</th>
                                                <th align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;">Amount</th>                   
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php  

										$rowlist = $rs->rows;
										$j=1; foreach($rowlist as $key => $row) { 

											if($row["order_status"]=='0') 
											{ 
												$status = '<span style="color:#525e66; font-weight:bold;">Pending</span>'; 
												$status_cls = 'style="border:1px solid #8fc6df; background: #cee4ff;"'; 
											} 
											elseif($row["order_status"]=='2') 
											{ 
												$status = '<span style="color:#665252; font-weight:bold;">Cancelled</span>'; 
												$status_cls = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 
											} 
											elseif($row["order_status"]=='3') 
											{ 
												$status = '<span style="color:#665252; font-weight:bold;">Failed</span>'; 
												$status_cls = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 
											} 
											else 
											{
												$status = '<span style="color:#556652; font-weight:bold;">Successful</span>'; 
												$status_cls = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
											}

										 ?>

                                            <tr>
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["order_reference_number"]; ?></td>
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["customer_name"]; ?></td>
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["mobile"]; ?></td>
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["from"]; ?></td>
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["to"]; ?></td>
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["quantity"]; ?></td>                                                 
                                                <td align="left" valign="top" style="padding:5px; border-bottom:1px solid #666;"><?php echo $row["totalamount"]; ?> Rs</td>
                                            </tr> 
                                         <?php  $j++; } ?>  
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="left" valign="top">PNR</th>
                                                <th align="left" valign="top">Name</th>
                                                <th align="left" valign="top">Mobile</th>                                                  
                                                <th align="left" valign="top">From</th> 
                                                <th align="left" valign="top">To</th>
                                                <th align="left" valign="top">Seat(s)</th>
                                                <th align="left" valign="top">Amount</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    </div>
                                    
                                    
                                    
                                    
                                    <?php } else { echo '<div id="gt-formfeedback" style="font-size:18px; text-align:center;">There is no booking found under your search criteria.</div>'; } ?> 

                                    
                                </div>

                            </div>

                        </div>
                        
                        <?php } ?>

                        </form>

                    

                    

                          	

              </section><!-- /.content -->

              

              <footer>

              		<?php include('footer-copyright.php'); ?>

              </footer>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>