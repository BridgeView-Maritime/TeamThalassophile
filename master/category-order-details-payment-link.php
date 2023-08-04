<?php include('../includes/config.php'); checkadminlogin();

if(isset($_GET["fid"]))
{
	$select_query = "SELECT t1.*, t2.firstname, t2.lastname, t2.email FROM ss_consumer_order as t1 INNER JOIN ss_users as t2 ON t1.user_id=t2.user_id WHERE t1.order_id=".$_GET["fid"]."";
	
	$select_result = $db->query($select_query);
	$row = $select_result->row;

	if($row['order_status']==1)
	{
		$userstatusmsg = '<strong style="color:#00a65a;">Successful</strong>';
	}
	else
	{
		$userstatusmsg = '<strong style="color:#FF0000;">Pending</strong>';
	}
	
	
	$emailcode = '<tr>
						<td width="25%">Booking Reference ID</td>
						<td>'.$row['order_reference_number'].' - Status: '.$userstatusmsg.'</td>
					  </tr><tr>
						<td width="25%">Name</td>
						<td>'.$row['customer_name'].'</td>
					  </tr>
					  <tr>
						<td>Email ID</td>
						<td>'.$row['mobile'].'</td>
					  </tr>
					  <tr>
						<td>Mobile</td>
						<td>'.$row['email'].'</td>
					  </tr>
					  <tr>
						<td>Journey Date</td>
						<td>'.$row['journey_date'].'</td>
					  </tr>
					  <tr>
						<td>Route</td>
						<td>'.$row['from'].' To '.$row['to'].'</td>
					  </tr>
					  <tr>
						<td>Departure Time</td>
						<td> '.$row['start_time'].'</td>
					  </tr>
					  <tr>
						<td>Arrival Time</td>
						<td> '.$row['end_time'].'</td>
					  </tr>
					  <tr>
						<td>Pickup Location</td>
						<td>'.$row['pickup_point'].'</td>
					  </tr>
					  <tr>
						<td>Drop Location</td>
						<td>'.$row['drop_point'].'</td>
					  </tr>
					  <tr>
						<td>Total Seat</td>
						<td>'.$row['quantity'].'</td>
					  </tr>
					  <tr>
						<td>Price per Seat</td>
						<td>Rs. '.$row['from'].'</td>
					  </tr>
					  <tr>
						<td>Total Price</td>
						<td>Rs. '.$row['quantity']*$row['package_price'].'</td>
					  </tr>';
	
	$orn = base64_encode('OC-'.$row['order_id'].',');
	
	$urltosend = $baseurl."paynowpayment.php?orn=".$orn;
	
	$textmsg2 = 'Please pay to complete your booking from '.$row['from'].' to '.$row['to'].' on '.$row['journey_date'].' '.$urltosend.', Contact +917669352416';
	
	$usermobile2 = $row['mobile'];

	sendsms($usermobile2,$textmsg2);
	
	$subject = "Pay Now - Your Booking with $sitename has been pending!";
	
	$body = $emailheader.'
  <tr>
	<td style="padding:10px;margin:0;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
	Dear '.$row['customer_name'].', your order has been in pending status.<br/><br/>
	Kindly use the below link to get is paid:<br/><br/>	
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
	
	$_SESSION["gtThanksMSGbooking"] = '<div id="gt-formsuccess">Payment link sent for PNR No. <strong>'.$row['order_reference_number'].'</strong></div>';

	echo "<script>document.location.href='".$baseurl."master/category-order-pending-list.php'</script>";	
	
}

?>