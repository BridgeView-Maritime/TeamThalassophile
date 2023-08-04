<?php 

session_start();
//error_reporting('E_WARNING & ~E_NOTICE');
error_reporting(0);

include("database.php");
// get the driver and include the class file
if(DB_DRIVER=='mysqli'){
	include("db/drivermysqli.php");
}

 $db = new database("sg2nlmysql41plsk.secureserver.net:3306", "teamthalassophil", "Ausea#123","teamthalassophil");
// $db =mysqli_connect("sg2nlmysql41plsk.secureserver.net:3306", "teamthalassophil", "Ausea#123","teamthalassophil");

// if ($db->connect_error) {
// 	die("Connection failed: " . $db->connect_error);
//  }
//    echo "Connected successfully";


// mysql char set
//mysql_set_charset('utf8');
date_default_timezone_set('Asia/Calcutta');
$basedir = '';
$baseurl = 'http://localhost/ausea_new/';

/* SPAM Check Code */
$gt_exploits = "/(content-type|bcc:|cc:|document.cookie|onclick|onload|javascript|alert)/i";
$gt_profanity = "/(beastial|bestial|blowjob|clit|cum|cunilingus|cunillingus|cunnilingus|cunt|ejaculate|fag|felatio|fellatio|fuck|fuk|fuks|gangbang|gangbanged|gangbangs|hotsex|jism|jiz|orgasim|orgasims|orgasm|orgasms|phonesex|phuk|phuq|porn|pussies|pussy|spunk|xxx)/i";
$gt_spamwords = "/(viagra|phentermine|tramadol|adipex|advai|alprazolam|ambien|ambian|amoxicillin|antivert|blackjack|backgammon|texas|holdem|poker|carisoprodol|ciara|ciprofloxacin|debt|dating|porn)/i";
$bots = "/(Indy|Blaiz|Java|libwww-perl|Python|OutfoxBot|User-Agent|PycURL|AlphaServer)/i";

if (preg_match($bots, $_SERVER['HTTP_USER_AGENT'])) {
	exit("<p>Known spam bots are not allowed.</p>");
}
/* SPAM Check Code */

include("functions.php");
include("infoarray.php");

/* Admin Panel Config Starts*/
	$sitename = 'TeamThalassophile';
	$admin_toemail = 'admin@teamthalassophile.com';
	$admin_toname = 'TeamThalassophile';
	$admin_fromemail = 'admin@teamthalassophile.com';
	$admin_fromname = 'TeamThalassophile - Admin';
	$admin_emaildemo_1 = 'admin@teamthalassophile.com';
	$admin_emaildemo_2 = 'admin@teamthalassophile.com';
	$admin_emaildemo_3 = 'admin@teamthalassophile.com';
	
	$copyrightmsg = '<a href="'.$baseurl.'" title="TeamThalassophile">&copy; TeamThalassophile</a>';
/* Admin Panel Config Ends*/

$emailheader = '<div style="padding:30px; text-align:center; width:800px; max-width:800px; min-width:600px; background:#e0e4e5;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF; width:600px;" align="center";>
  <tr>
    <td style="padding-bottom:10px; border-bottom:1px solid #ddd; height:100px; font-size:40px; background:url('.$baseurl.'images/LogoText1.png) no-repeat center top;">JobSEAkers</td>
  </tr>';

$emailfooter = '<tr>
    <td style="padding-bottom:10px; padding-top:10px; border-top:1px solid #ddd; height:29px;"><a href="'.$baseurl.'" title="JobSEAkers">&copy; JobSEAkers</a></td>
  </tr>
</table>

</div>';


$keyId = 'rzp_live_OBc90ox85m2AWO';
$keySecret = 'a1wkY3a86h4TZmVpFy9cUdvn';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
 error_reporting(E_ALL);
ini_set('display_errors', 1);

?>