<?php include('header.php'); $gtpage = 'services-list'; $rwseditor=0; $gtdateopt="on";   checkadminroles('admin_users');

$_SESSION['myForm']="";

/*print("<pre>");
print_r($_SESSION["Cart"]);
print("</pre>");*/

if(isset($_POST["rws-submit"]))
{
	global $gt_exploits, $gt_profanity, $gt_spamwords;
	
	foreach ($_POST as $key => $val) {
		$_POST["$key"] = cleandatafromspam($val);
		if (preg_match($gt_exploits, $val)) {
			exit("<p>Exploits/malicious scripting attributes aren't allowed.</p>");
		} elseif (preg_match($gt_profanity, $val) || preg_match($gt_spamwords, $val)) {
			exit("<p>That kind of language is not allowed through our form.</p>");
		}
	}

	$_SESSION['myForm'] = $_POST;

	$errors = array(); //Initialize error array 
	
	$email 				= $_POST["rwsusername"];
	$firstname			= $_POST["firstname"];
	$mobile				= $_POST["mobile"];
	$verificationcode 	= rand(100000,999999);
	$password 			= md5($verificationcode);
	$sendpass 			= $verificationcode;
	
	$address			= $_POST["address"];
	$city				= $_POST["city"];
	$state				= $_POST["state"];
	$pincode			= $_POST["pincode"];
	$country			= $_POST["country"];
	
	$termsofuse			= $_POST["termsofuse"];
	
	$order_status 		= $_POST["order_status"];
	
	if(isUnique("mobile", $_POST['mobile'], "ss_users"))
	{
		/* Insert Code to Database */
		$query_insert = "INSERT INTO `ss_users` SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', mobile = '$mobile', email = '$email', password = '$password', photograph = '$photograph', gender = '$gender', dateofbirth = '$dateofbirth', address = '$address', location = '$location', area = '$area', city = '$city', state = '$state', pincode = '$pincode', country = '$country', termsofuse = '$termsofuse', user_type = 'C', status = '1', validate = '0', add_date = '$gtcurrenttime'";

		$update_result = $db->query($query_insert);

		$userid = $db->getLastId();
		
	}
	else
	{
		$select_query = 'SELECT * FROM `ss_users` WHERE mobile = "'.$_POST["mobile"].'"';
		$select_result = $db->query($select_query);
		$row = $select_result->row;
		
		$userid = $row["user_id"];
	}
	
	$payment_method = $_POST["payment_method"];

	foreach($_SESSION["Cart"] as $key=>$val) {
		

		$services_id 				= $val["service_id"];
		$packages_id 				= $val["package_id"];
		$services_package_id 		= $val["services_package_id"];
		$totalhours 				= $val["total_hours"];
		$service_name 				= $val["service_name"];
		$package_name 				= $val["package_name"];
		$package_price 				= $val["package_price"];

		$from 						= $val["from"];
		$to 						= $val["to"];
		$journey_date 				= $val["journey_date"];
		$start_time 				= $val["start_time"];
		$end_time 					= $val["end_time"];
		$pickup_point 				= $val["pickup_point"];
		$drop_point 				= $val["drop_point"];
		$package_mrp 				= $val["package_mrp"];
		$package_price 				= $val["package_price"];
		$quantity					= $val["quantity"];
		
		$ordersubtotal 				= $quantity*$package_price;

		$startdate 					= date('Y-m-d');
		$enddate 					= date('Y-m-d', strtotime("+$duration day"));
		
		$query_insert = "INSERT INTO `ss_consumer_order` SET user_id = '".$userid."', totalamount = '$ordersubtotal', service_id = '$services_id', packages_id = '$services_package_id', startdate = '$startdate', enddate = '$enddate', dateoforder = '$gtcurrenttime', service_name = '$service_name', package_name = '$package_name', discountcost = '$discountcost', service_provider_name = '$service_provider_name', order_status = '$order_status', package_price = '$package_price',  services_package_id='$services_package_id', `from`='$from', `to`='$to', journey_date='$journey_date', start_time='$start_time', end_time='$end_time', pickup_point='$pickup_point', drop_point='$drop_point', package_mrp='$package_mrp', quantity='$quantity', payment_from='Paytm', ticket_by='Admin', payment_method='$order_status', customer_name='".$firstname."', email='".$email."', mobile='".$mobile."'";

		$update_result = $db->query($query_insert);

		$insertedid = $db->getLastId();
		
		$insertedid2 .= $insertedid.',';

		$order_reference_number = 'MDV'.date('Ymd').$insertedid;

		$query_update = "UPDATE `ss_consumer_order` SET order_reference_number = '$order_reference_number' WHERE order_id=".$insertedid;

		$update_result = $db->query($query_update);

		/* Email Code */
		
		if($order_status==1)
		{
			$userstatusmsg = '<strong style="color:#00a65a;">Successful</strong>';
		}
		else
		{
			$userstatusmsg = '<strong style="color:#FF0000;">Pending</strong>';
		}
		
		$emailcode = '<tr>
						<td width="25%">Booking Reference ID</td>
						<td>'.$order_reference_number.' - Status: '.$userstatusmsg.'</td>
					  </tr><tr>
						<td width="25%">Name</td>
						<td>'.$firstname.'</td>
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
						<td>Arrival Time</td>
						<td> '.$end_time.'</td>
					  </tr>
					  <tr>
						<td>Pickup Location</td>
						<td>'.$pickup_point.'</td>
					  </tr>
					  <tr>
						<td>Drop Location</td>
						<td>'.$drop_point.'</td>
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
			
			if($order_status==1)
			{
				/* Send Message to Admin Code Starts */
				
				$seatleft_messageadmin = togetleftseat($services_id, $journey_date);
				$seatleft2 .= $from.' To '.$to.' Seat(s) Left '.$seatleft_messageadmin.' Date '.$journey_date.', ';
				
				$textmsg3 = 'Dear Admin, '.$seatleft2;
				
				sendsms('9312447399',$textmsg3);
				
				/* Send Message to Admin Code Ends */
									 
				$textmsg2 = 'Ticket Booked '.$from.'-'.$to.' Travel Date '.togetdatemonthonly($journey_date).' Time '.togettimeformat($start_time).' PNR '.$order_reference_number.' Total Seat '.$quantity.' Pickup '.$pickup_point.' Contact +917669352416';
			
				  $usermobile2 = $mobile;
				  sendsms($usermobile2,$textmsg2);
				  
				  $subject = "Booking Notification - Your Booking with $sitename has been successful!";
				  
				  $body = $emailheader.'
				  <tr>
					<td style="padding:10px;margin:0;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
					Dear '.$firstname.', your booking has been placed successfully.<br/><br/>
					Summery of your booking is below:
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
			else
			{
				$orn = base64_encode('OC-'.$insertedid2);
	
				$urltosend = $baseurl."paynowpayment.php?orn=".$orn;
				
				if($order_status=="paytm")
				{				
					$textmsg2 = 'Hello '.$firstname.' Your ticket not booked yet, Please pay Rs. '.$quantity*$package_price.' to '.$config["paytm_number"].' PayTM No. against you Booking ID '.$order_reference_number.' and then call us at +91'.str_replace(' ','',$config["mobilenumber1"]).'.';
					
					$textmsgemail = 'Your ticket not booked yet, Please pay Rs. '.$quantity*$package_price.' to '.$config["paytm_number"].' PayTM No. against you PNR No. '.$order_reference_number.' and then call us at +91'.str_replace(' ','',$config["mobilenumber1"]).'.';
				}
				else
				{
					$textmsg2 = 'Please pay to complete your booking '.$urltosend.', Contact +917669352416';
					$textmsgemail = "";
				}
				
				$usermobile2 = $mobile;
			
				sendsms($usermobile2,$textmsg2);
				
				$subject = "Pay Now - Your Booking with $sitename has been pending!";
				
				$body = $emailheader.'
			  <tr>
				<td style="padding:10px;margin:0;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
				Dear '.$firstname.', your order has been in pending status.<br/><br/>
				'.$textmsgemail.'<br/><br/>
				
				Or you may use the following link to pay us via using credit card, debit card and net banking.<br/><br/>	
				'.$urltosend.'
				<br/><br/>	
				Summery of your order is below:
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
	
	unset($_SESSION["Cart"]);
	
	unset($_SESSION['myForm']);
	
	if($order_status==1)
	{	
		$_SESSION["gtThanksMSGbooking"] = '<div id="gt-formsuccess">Booking has been completed successfully, you may check in Successful Order.</div>';	
	}
	else
	{
		$_SESSION["gtThanksMSGbooking"] = '<div id="gt-formsuccess">Booking has done in pending status, Once the user will pay it will show in Successful Order.</div>';	
	}
	
	echo "<script>document.location.href='".$baseurl."master/search-ticket.php'</script>";	
	
}

	
	$reg_title = 'Book Ticket From Admin';
	$reg_subtitle = ' Book Ticket From Admin';
	$reg_breadcrumb = 'Book Ticket From Admin';
	$reg_button = 'Book Now';
	if($_SESSION['myForm']['status']=="")
	{
		$_SESSION['myForm']['status'] = '1';
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
                        <li><a href="<?php echo $baseurl; ?>master/admin-user-list.php"><i class="fa fa-leaf"></i> Admin User List </a></li>
                        <li class="active"><?php echo $reg_breadcrumb; ?></li>
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

                    

                    	<div class="col-md-6 col-md-offset-3">

                        	<div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title">Ticket Details</h3><button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='search-ticket-session-delete.php'" style="float:right;"> Remove Cart </button>

                                </div><!-- /.box-header -->

                                <!-- form start -->
                                <div class="box-body">
                                	<div class="form-group">
                                        <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['myForm']['firstname']; ?>" placeholder="*Name" required class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="*Mobile" required class="form-control"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="rwsusername" id="rwsusername" value="<?php echo $_SESSION['myForm']['rwsusername']; ?>" placeholder="*Email ID" required class="form-control"  />
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="address" id="address" value="<?php echo $_SESSION['myForm']['address']; ?>" placeholder="*Address" required class="form-control"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="city" id="city" value="<?php echo $_SESSION['myForm']['city']; ?>" placeholder="*City" required class="form-control"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="state" id="state" value="<?php echo $_SESSION['myForm']['state']; ?>" placeholder="*State" required class="form-control"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="pincode" id="pincode" value="<?php echo $_SESSION['myForm']['pincode']; ?>" placeholder="*Pincode" required class="form-control"  />
                                    </div>
                                    
                                     <div class="form-group">
                                        <input type="radio" name="order_status" id="order_status_1" value="0" required="required" /> Pending &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_2" value="1" required="required" /> Successful &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="order_status" id="order_status_3" value="paytm" required="required" /> Paytm
                                    </div>
                                    
                                </div>
                                <!-- /.box-body -->    
                            </div>

                        </div>
                        
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-md-offset-3">

                                <div class="box box-warning">

                                    <div class="box-footer" style="text-align:center">

                                          <button class="btn btn-primary" type="submit" name="rws-submit"> <?php echo $reg_button; ?> </button>                                          

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