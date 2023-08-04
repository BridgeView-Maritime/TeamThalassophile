<?php include('header.php'); $gtpage = 'package-list'; $rwseditor=1; $gtdateopt="on"; checkadminroles('package');
$_SESSION['myForm']="";

if(isset($_GET["fid"]))
{
	$select_query = 'SELECT t1.*, t3.name as service_name FROM ss_services_package as t1 INNER JOIN ss_services as t3 ON t1.service_id=t3.service_id WHERE t1.services_package_id = "'.$_GET["fid"].'"';
	$select_result = $db->query($select_query);
	$row = $select_result->row;
	
	$package_id 				= addslashes($row["package_id"]);
	$package_price 				= addslashes($row["package_price"]);	
	$title 						= addslashes($row["package_subtitle"]);	
	$duration 					= addslashes($row["duration"]);
	$total_hours 				= addslashes($row["total_hours"]);	
	$hourly_cost 				= addslashes($row["hourly_cost"]);
	$discounted_hourly_cost 	= addslashes($row["discounted_hourly_cost"]);	
	$description 				= addslashes($row["description"]);
	$status 					= addslashes($row["status"]);	
	$package_mrp 				= addslashes($row["package_mrp"]);	
	
	$total_seat 				= addslashes($row["total_seat"]);	
	$from 						= addslashes($row["from"]);
	$to 						= addslashes($row["to"]);	
	$stoppage 					= addslashes($row["stoppage"]);
	$start_time 				= addslashes($row["start_time"]);	
	$end_time 					= addslashes($row["end_time"]);	
	$featured 					= addslashes($row["featured"]);	
	
	$pickup_point				= addslashes($row["pickup_point"]);	
	$drop_point					= addslashes($row["drop_point"]);
	
	$service_id 				= $row["service_id"];	
	
	$update_query = "INSERT INTO `ss_services_package` SET `package_id` = '$package_id', `service_id` = '$service_id', `package_price` = '$package_price', `duration`='$duration', `total_hours`='$total_hours', `hourly_cost`='$hourly_cost', `discounted_hourly_cost`='$discounted_hourly_cost', `package_subtitle`='$title', `description`='$description', `status`='$status', `package_mrp`='$package_mrp', `total_seat`='$total_seat', `from`='$from', `to`='$to', `stoppage`='$stoppage', `start_time`='$start_time', `end_time`='$end_time', `featured`='$featured', `pickup_point`='$pickup_point', `drop_point`='$drop_point', `date_added`='$gtcurrenttime'";
	$update_result = $db->query($update_query);
	
	$fid = $db->getLastId();
	
	echo "<script>document.location.href='package-add.php?fid=".$fid."'</script>";	


	
}
else
{	
	
}

?>