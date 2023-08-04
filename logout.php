<?php include("includes/config.php");
	/*
	include_once("includes/google-config.php");
	unset($_SESSION['token']);
	unset($_SESSION['google_data']); //Google session data unset
	$gClient->revokeToken();

	include_once("includes/facebook-config.php");
	$facebook->destroySession();
	session_start();
	unset($_SESSION['userdata']);

	include_once("includes/facebook-config.php");
	$facebook->destroySession();
	session_start();
	unset($_SESSION['userdata']);*/
	
	if($_SESSION["USER"]['Type']=="Jobseeker")
	{
		$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Successfully Logged Out of JobSEAkers.</div>';
		$_SESSION["LogoutRedirectURL"] = $baseurl.'jobseekers-login.php';
	}
	else if($_SESSION["EMP"]['Type']=="Employer")
	{
		$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Successfully Logged Out of Employer.</div>';
		$_SESSION["LogoutRedirectURL"] = $baseurl.'employer-login.php';
	}
	else 
	{
		$_SESSION["GTMsgtoUser"] = '<div id="rws-formsuccess">Successfully Logged Out of Agent.</div>';
		$_SESSION["LogoutRedirectURL"] = $baseurl.'agent-login.php';
	}

unset($_SESSION["USER"]);
unset($_SESSION["EMP"]);
//unset($_SESSION["views"]);

echo "<script>document.location.href='".$_SESSION["LogoutRedirectURL"]."'</script>";
unset($_SESSION["LogoutRedirectURL"]);
unset($_SESSION["views"]);
?>