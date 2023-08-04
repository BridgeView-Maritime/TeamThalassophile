<?php include("../includes/config.php");

$services_package_id 	= $_GET["package_id"];
$journey_date 			= $_GET["journey_date"];
$return_date 			= $_GET["return_date"];
$quantity 				= $_GET["quantity"];

$todaydate = date('Y-m-d');

if(empty($return_date))
{
	$return_date = '2019-05-20';
}

$date1=date_create($todaydate);
$date2=date_create($return_date);
$diff=date_diff($date1,$date2);
$difference = $diff->format("%R%a");

$query="SELECT * FROM ss_services_package WHERE services_package_id='".$services_package_id."' AND status='1'";

$rs = $db->query($query);
$foundnum = $rs->num_rows;
if($foundnum>0)
{
	$rowc = $rs->row;
	
	$seatleft = togetleftseat($rowc["service_id"], $journey_date);
			
	if($seatleft>=$quantity) 
	{ 
		
	} 
	else 
	{
		$_SESSION["GtThanksMSG"] = '<div id="rws-formfeedback">Sorry, the seat(s) are now full for the Route '.$rowc["from"].' to '.$rowc["to"].' on '.$journey_date.' For your selected bus. Please search with new criteria.</div>';
		echo "<script>document.location.href='".$baseurl."'</script>";	
		exit;	
	}
	
	
	$services_package_id = $rowc["services_package_id"];
	
	$_SESSION["Cart"][$services_package_id]['services_package_id']		=$rowc["services_package_id"];
	$_SESSION["Cart"][$services_package_id]['from']						=$rowc["from"];
	$_SESSION["Cart"][$services_package_id]['to']						=$rowc["to"];
	$_SESSION["Cart"][$services_package_id]['journey_date']				=$journey_date;
	$_SESSION["Cart"][$services_package_id]['start_time']				=$rowc["start_time"];
	$_SESSION["Cart"][$services_package_id]['end_time']					=$rowc["end_time"];
	$_SESSION["Cart"][$services_package_id]['pickup_point']				=$rowc["pickup_point"];
	$_SESSION["Cart"][$services_package_id]['drop_point']				=$rowc["drop_point"];
	$_SESSION["Cart"][$services_package_id]['package_mrp']				=$rowc["package_mrp"];
	$_SESSION["Cart"][$services_package_id]['package_price']			=$rowc["package_price"];
	$_SESSION["Cart"][$services_package_id]['service_id']				=$rowc["service_id"];
	$_SESSION["Cart"][$services_package_id]['quantity']					=$quantity;
	
	echo "<script>document.location.href='".$baseurl."master/search-book-order.php'</script>";
	
}
else
{
	echo "<script>document.location.href='".$baseurl."master/search-ticket.php'</script>";
}

?>