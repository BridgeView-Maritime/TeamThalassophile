<?php 
// if the 'term' variable is not sent with the request, exit
if ($_GET['sectionid'] != "" )
{
// connect to the database server and select the appropriate database for use
include('../includes/config.php');
$sectionid = $_GET['sectionid'];
if($sectionid=="Offshore")
{
	$htmlsend = todisplaycheckboxcategory($array_category_offshore, 'category[]', $firstoption, "", $onchange="");
}
else
{
	$htmlsend = todisplaycheckboxcategory($array_category_shore, 'category[]', $firstoption, "", $onchange="");
}

$data["proceed"] = "1";
$data["categoryhtml"] = $htmlsend;

echo json_encode($data);
}