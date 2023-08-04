<?php include('../includes/config.php');
/*print("<pre>");
print_r($_POST);
print("</pre>");*/
if(!empty($_POST["parent_id"]))
{
	
	$_SESSION['myForm'] = $_POST;

	$package_id 				= addslashes($_POST["package_id"]);
	$package_price 				= addslashes($_POST["package_price"]);	
	$title 						= addslashes($_POST["title"]);	
	$duration 					= addslashes($_POST["duration"]);
	$total_hours 				= addslashes($_POST["total_hours"]);	
	$hourly_cost 				= addslashes($_POST["hourly_cost"]);
	$discounted_hourly_cost 	= addslashes($_POST["discounted_hourly_cost"]);	
	$description 				= addslashes($_POST["description"]);
	$status 					= addslashes($_POST["status"]);	
	
	$pickup_point 				= addslashes($_POST["pickup_point"]);
	$drop_point 				= addslashes($_POST["drop_point"]);	
	
	$product_category			= $_POST["product_category"];	
	$post_id 					= $_POST["post_id"];
	$service_id 				= $_POST["parent_id"];	
	$package_mrp 				= $_POST["package_mrp"];
	
	$total_seat 				= $_POST["total_seat"];
	$from 						= $_POST["from"];	
	$to							= $_POST["to"];	
	$stoppage 					= $_POST["stoppage"];
	$start_time 				= $_POST["start_time"];	
	$end_time 					= $_POST["end_time"];	
	
	$featured					= $_POST["featured"];	
	
	// Form Validation Code

	$errors = array(); //Initialize error array 
/*
	if (empty($_POST['title']) ) 					{	$errors[]="Package Subtitle field can't be blank!";			}
	if (empty($_POST['package_name']) ) 			{	$errors[]="Package Name field can't be blank!";				}
	if (empty($_POST['package_price']) ) 			{	$errors[]="Package Price field can't be blank!";			}
	if (empty($_POST['duration']) ) 				{	$errors[]="Duration field can't be blank!";					}
	if (empty($_POST['total_hours']) ) 				{	$errors[]="Total Hours field can't be blank!";				}
	if (empty($_POST['hourly_cost']) ) 				{	$errors[]="Hourly Cost field can't be blank!";				}
	if (empty($_POST['discounted_hourly_cost']) ) 	{	$errors[]="Discounted Hourly Cost field can't be blank!";	}*/

	if(empty($errors)) {		
		// UPLOAD FILE CODE STARTS 

		if(trim($post_id)!="")
		{
			$update_query = "UPDATE `ss_services_package` SET `package_id` = '$package_id', `service_id` = '$service_id', `package_price` = '$package_price', `duration`='$duration', `total_hours`='$total_hours', `hourly_cost`='$hourly_cost', `discounted_hourly_cost`='$discounted_hourly_cost', `package_subtitle`='$title', `description`='$description', `status`='$status', `package_mrp`='$package_mrp', `total_seat`='$total_seat', `from`='$from', `to`='$to', `stoppage`='$stoppage', `start_time`='$start_time', `end_time`='$end_time', `featured`='$featured', `pickup_point`='$pickup_point', `drop_point`='$drop_point' WHERE `services_package_id`= '$post_id'";

			$update_result = $db->query($update_query);		
			
			$_SESSION["gtThanksMSG"]='<div id="gt-formsuccess">Product has been updated successfully.!</div>';
			echo "<script>document.location.href='package-add.php?fid=".$post_id."'</script>";	
		}
		else
		{
			
			$update_query = "INSERT INTO `ss_services_package` SET `package_id` = '$package_id', `service_id` = '$service_id', `package_price` = '$package_price', `duration`='$duration', `total_hours`='$total_hours', `hourly_cost`='$hourly_cost', `discounted_hourly_cost`='$discounted_hourly_cost', `package_subtitle`='$title', `description`='$description', `status`='$status', `package_mrp`='$package_mrp', `total_seat`='$total_seat', `from`='$from', `to`='$to', `stoppage`='$stoppage', `start_time`='$start_time', `end_time`='$end_time', `featured`='$featured', `pickup_point`='$pickup_point', `drop_point`='$drop_point', `date_added`='$gtcurrenttime'";
			$update_result = $db->query($update_query);
			
			$_SESSION["gtThanksMSG"]='<div id="gt-formsuccess">Product has been added successfully.!</div>';
			
			echo "<script>document.location.href='package-add.php'</script>";

		}
		
		//echo $update_query;
		
		unset($_SESSION['myForm']);
	}
}
?>