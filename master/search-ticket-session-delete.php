<?php include("../includes/config.php");

	unset($_SESSION["Cart"]);

	$_SESSION["gtThanksMSGbooking"] = '<div id="gt-formsuccess">Cart is empty now.</div>';

	echo "<script>document.location.href='".$baseurl."master/search-ticket.php'</script>";

?>