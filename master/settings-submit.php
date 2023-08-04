<?php include('header.php'); $gtpage = 'system'; $listjs = 1;   ?><?php
if($_POST)
{
	$data = $_POST;
	//print_r($data);
	$db->query("DELETE FROM ss_config WHERE type='config'");
	// process image 
	// insert logo image
		$fileThumbnail = $_FILES['storelogo']['tmp_name'];
		if (is_uploaded_file($fileThumbnail))
		{
			$rand2 = mt_rand(1000,9999);
			$img_name_rand_2 = $rand2."_logo.jpg";
			$fileThumbnail_name = $_FILES['storelogo']['name'];
			$add_thumbnail="../images/$img_name_rand_2";
			move_uploaded_file ($fileThumbnail, $add_thumbnail);
			
			$sql = "INSERT INTO `ss_config` (`id`, `optionname`, `optionvalue`, `type`) VALUES (NULL, 'storelogo', '".$img_name_rand_2."', 'logo')";
			$db->query($sql);
		}
		
		/* Insert Paytm image */
		
		$fileThumbnail = $_FILES['paytmimage']['tmp_name'];
		if (is_uploaded_file($fileThumbnail))
		{
			$rand2 = mt_rand(10000,99999);
			$img_name_rand_2 = $rand2."_paytm.jpg";
			$fileThumbnail_name = $_FILES['paytmimage']['name'];
			$add_thumbnail="../images/$img_name_rand_2";
			move_uploaded_file ($fileThumbnail, $add_thumbnail);
			
			$sql = "INSERT INTO `ss_config` (`id`, `optionname`, `optionvalue`, `type`) VALUES (NULL, 'paytmimage', '".$img_name_rand_2."', 'paytm')";
			$db->query($sql);
		}
		
	// 
	foreach($data as $key=>$val)
	{
    	$db->query("INSERT INTO `ss_config` (`id`, `optionname`, `optionvalue`, `type`) VALUES (NULL, '".$key."', '".addslashes($val)."', 'config')");
	}
}
$_SESSION["gtThanksMSGbooking"] = '<div id="gt-formsuccess">Setting details has been updated successfully.</div>';	
	
echo "<script>document.location.href='".$baseurl."master/settings.php'</script>";	
?>