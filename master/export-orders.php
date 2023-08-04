<?php include('header.php'); $gtpage = 'export-order'; $rwseditor=0; $gtdateopt="on";  checkadminroles('reports');

$_SESSION['myForm']="";

	$reg_title = 'Generate Booking Report';
	$reg_subtitle = 'Generate Booking Report Page';
	$reg_breadcrumb = 'Generate Booking Report';
	$reg_button = 'Generate';
	
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

                                    <h3 class="box-title">Generate Booking Report Criteria</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Journey Date<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="start_date" placeholder="Journey Date" id="start_date" class="form-control gtdatedropdown" value="<?php echo $_GET["start_date"]; ?>" autocomplete="off"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Order Status<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                            	<p><input type="radio" name="order_status" id="order_status_1" value="1" <?php if($_GET["order_status"]==1) { echo 'checked="checked"'; } ?> /> Successful &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_2" value="0" <?php if($_GET["order_status"]==0) { echo 'checked="checked"'; } ?> /> Pending &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_3" value="2" <?php if($_GET["order_status"]==2) { echo 'checked="checked"'; } ?>/> Cancelled &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_4" value="3" <?php if($_GET["order_status"]==3) { echo 'checked="checked"'; } ?>/> Failed</p>
                                            
                                            </div>
                                        </div>
                                        
                                        <!--<div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Journey End Date<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="end_date" placeholder="End Date" id="end_date" class="form-control gtdatedropdown" value="" autocomplete="off"></div>
                                        </div>-->
                                        
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
                                	<p style="display:block; overflow:hidden; padding:10px; text-align:right; "><a href="export-orders-csv.php?start_date=<?php echo $_GET["start_date"]; ?>&order_status=<?php echo $_GET["order_status"]; ?>&path=<?php echo $_GET["path"]; ?>&parent_id=<?php echo $_GET["parent_id"]; ?>" target="_blank" class="btn btn-info" style="font-size:18px;"><i class="fa fa-download"></i> Export</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="printDiv();" class="btn btn-warning"  style="font-size:18px;"><i class="fa fa-print" aria-hidden="true"></i> Print</a></p>
              <?php } ?>                  	
                                    
                                    <?php if($foundnum>0) { ?>
                                    
                                    <div id="rwsprintdivcontent">
                                    
                                   <div class="box-header">
									
                                    <h3 class="box-title">Report -> 
                                    <span style="color:#3c8dbc ;"><strong>Journey Date:</strong>&nbsp;&nbsp;<em><?php echo $_GET["start_date"];?></em> </span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php echo $showstatus; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="color:#f39c12;"><strong>Route:</strong>&nbsp;&nbsp;<em><?php echo $_GET["path"];?></em> </span>
                                    </h3>

                                	</div><!-- /.box-header -->
									
                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>
                                                <th>PNR</th>
                                                <th>Customer Name</th>
                                                <th>Mobile</th>                                                  
                                                <th>Route</th> 
                                                <th>Pickup Location</th>
                                                <th>Start Time</th>
                                                <th>Journey Date</th>
                                                <th>Amount Paid(in Rs.)</th>                                                                        
                                                <th>Status</th>                                                
                                                <th>Order Date</th>                                                
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
                                                <td><?php echo $row["order_reference_number"]; ?></td>
                                                <td><?php echo $row["customer_name"]; ?></td>
                                                <td><?php echo $row["mobile"]; ?></td>
                                                <td><?php echo '<strong>'.$row["from"].'</strong> TO <strong>'.$row["to"].'</strong>'; ?></td>
                                                <td><?php echo $row["pickup_point"]; ?></td> 
                                                <td><?php echo togettimeformat($row["start_time"]); ?></td>
                                                <td><?php echo togetdatemonthonly($row["journey_date"]); ?></td>  
                                                <td><?php echo $row["totalamount"]; ?></td>                                                
                                                <td <?php echo $status_cls; ?>><?php echo $status; ?></td>
                                                <td><?php echo toshowdatewithtime($row["dateoforder"]); ?></td>                                                
                                            </tr> 
                                         <?php  $j++; } ?>  
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>PNR</th>
                                                <th>Customer Name</th>
                                                <th>Mobile</th>                                                  
                                                <th>Route</th> 
                                                <th>Pickup Location</th>
                                                <th>Start Time</th>
                                                <th>Journey Date</th>
                                                <th>Amount Paid(in Rs.)</th>                                                                        
                                                <th>Status</th>                                                
                                                <th>Order Date</th>
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