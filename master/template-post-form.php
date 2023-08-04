<?php include('../includes/config.php');
/*print("<pre>");
print_r($_POST);
print("</pre>");*/
if(!empty($_POST["status"]))
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
	$product_category			= $_POST["product_category"];	
	$post_id 					= $_POST["post_id"];
	$service_id 				= $_POST["parent_id"];	
	
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
		
		
		if(trim($post_id) =="")
		{
		
			
			$rand2 = mt_rand(100000,999999);
			$uploadfolder = '../images/templates';
			
			for($k=1;$k<=3;$k++)
			{
				$img_name_rand[$k] = $array_rand[$rand_keys[0]]."_".$rand2."_".$array_rand[$rand_keys[1]]."_".$rand1."_".$k.".jpg";
				
				if(!empty($_FILES['image_'.$k]['name']))
				{
					$fileThumbnail = $_FILES['image_'.$k]['tmp_name'];
					$arrayimage[$k] = $_FILES['image_'.$k]['name'];
					$add_thumbnail=$uploadfolder."/".$k."_".$rand2."_".$arrayimage[$k];
					if (is_uploaded_file($fileThumbnail))
					{
						move_uploaded_file ($fileThumbnail, $add_thumbnail);
					}
					
					$imageuploadname[$k] = $k."_".$rand2."_".$arrayimage[$k];			
			
				}
				else
				{
					$imageuploadname[$k]="";
				}
			}
		
		}
		else
		{		
			
			$rand2 = mt_rand(100000,999999);
			$uploadfolder = '../images/templates';
			
			for($k=1;$k<=3;$k++)
			{
				
				if(!empty($_FILES['image_'.$k]['name']))
				{
					$fileThumbnail = $_FILES['image_'.$k]['tmp_name'];
					$arrayimage[$k] = $_FILES['image_'.$k]['name'];
					$add_thumbnail=$uploadfolder."/".$k."_".$rand2."_".$arrayimage[$k];
					if (is_uploaded_file($fileThumbnail))
					{
						move_uploaded_file ($fileThumbnail, $add_thumbnail);
					}
					
					$imageuploadname[$k] = $k."_".$rand2."_".$arrayimage[$k];			
			
				}
				else
				{
					$imageuploadname[$k]=$_POST['oldimage_'.$k];
				}
			}		
		}

		if(trim($post_id)!="")
		{
			$update_query = "UPDATE `ss_services_images` SET `service_id` = '$service_id', `image` = '".$imageuploadname[1]."', `status`='$status' WHERE `services_img_id`= '$post_id'";

			$update_result = $db->query($update_query);		
			
			$_SESSION["gtThanksMSG"]='<div id="gt-formsuccess">Template has been updated successfully.!</div>';
			echo "<script>document.location.href='services-img-add.php?fid=".$post_id."'</script>";	
		}
		else
		{
			foreach($product_category as $key=>$service_id)
			{
				$update_query = "INSERT INTO `ss_services_images` SET `service_id` = '$service_id', `image` = '".$imageuploadname[1]."', `status`='$status', `date_added`='$gtcurrenttime'";
				$update_result = $db->query($update_query);
			}
			
			$_SESSION["gtThanksMSG"]='<div id="gt-formsuccess">Template has been added successfully.!</div>';
			
			echo "<script>document.location.href='services-img-add.php'</script>";

		}
		
		//echo $update_query;
		
		unset($_SESSION['myForm']);
	}
}
?>