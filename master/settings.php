<?php include('header.php'); $gtpage = 'system'; $listjs = 1;   ?><?php 
$query="SELECT * FROM ss_config";
$result = $db->query($query);
$totalrows = $result->num_rows;
$rowlist = $result->rows;

foreach($rowlist as $key=>$row)
{
	$prow[$row['optionname']]=stripslashes($row['optionvalue']);
}
?>

    <div class="container">
    
    <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
    
    <div class="box box-primary" style="padding:0 20px;">
    <div class="box-header">
        <h3 class="box-title" style="padding-left:0;">Global Settings</h3>
    </div><!-- /.box-header -->
<?php if(isset($_SESSION["gtThanksMSGbooking"])) { echo $_SESSION["gtThanksMSGbooking"]; unset($_SESSION["gtThanksMSGbooking"]); }?>
<form action="settings-submit.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="example1" class="table table-bordered table-striped">
    <tr>
      <td width="40%">Name</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">Value</td>
    </tr>
    <tr>
      <td height="30"> Logo </td>
      <td>&nbsp;</td>
      <td><input name="storelogo" type="file" id="storelogo" /> 
      Please upload only jpg file <img src="../images/<?php echo $prow['storelogo'];?>" /></td>
    </tr>
    <tr>
      <td height="30"> Name </td>
      <td>&nbsp;</td>
      <td><input name="sitetitle" type="text" id="sitetitle" value="<?php echo $prow['sitetitle'];?>" class="form-control" /></td>
    </tr>
    <tr>
      <td height="30">Admin Email </td>
      <td>&nbsp;</td>
      <td><input name="adminemail" type="text" id="adminemail"  value="<?php echo $prow['adminemail'];?>" class="form-control"   /></td>
    </tr>
    <tr>
      <td height="30">Owner Name </td>
      <td>&nbsp;</td>
      <td><input name="storeownername" type="text" id="storeownername"  value="<?php echo $prow['storeownername'];?>" class="form-control"  /></td>
    </tr>
    <tr>
      <td height="30">Whats up number</td>
      <td>&nbsp;</td>
      <td><input name="whatsupnumber" type="text" id="whatsupnumber" value="<?php echo $prow['whatsupnumber'];?>"  class="form-control"  /></td>
    </tr>   
    <tr>
      <td height="30">Telephone (Top Right Section)</td>
      <td>&nbsp;</td>
      <td><input name="telephone" type="text" id="telephone" value="<?php echo $prow['telephone'];?>"  class="form-control"  /></td>
    </tr>
    <tr>
      <td height="30">Mobile Number 1</td>
      <td>&nbsp;</td>
      <td><input name="mobilenumber1" type="text" id="mobilenumber1" value="<?php echo $prow['mobilenumber1'];?>"  class="form-control"  /></td>
    </tr>
    <tr>
      <td height="30">Mobile Number 2</td>
      <td>&nbsp;</td>
      <td><input name="mobilenumber2" type="text" id="mobilenumber2" value="<?php echo $prow['mobilenumber2'];?>"  class="form-control" ></td>
    </tr>
    <tr>
      <td height="30">Home Banner Text 1</td>
      <td>&nbsp;</td>
      <td><input name="home_banner_text_1" type="text" id="home_banner_text_1" value="<?php echo $prow['home_banner_text_1'];?>"  class="form-control" ></td>
    </tr>
    <tr>
      <td height="30">Home Banner Text 2</td>
      <td>&nbsp;</td>
      <td><textarea name="home_banner_text_2" id="home_banner_text_2" class="form-control" ><?php echo $prow['home_banner_text_2'];?></textarea></td>
    </tr>
    <tr>
      <td height="30">About Us Text</td>
      <td>&nbsp;</td>
      <td><textarea name="aboutustext" id="aboutustext" class="form-control" ><?php echo $prow['aboutustext'];?></textarea></td>
    </tr>
    <tr>
      <td height="30">Contact Address </td>
      <td>&nbsp;</td>
      <td><textarea name="contactaddress" id="contactaddress" class="form-control" ><?php echo $prow['contactaddress'];?></textarea></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30"><strong>SEO Details</strong> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30">Store Title / Home page Title </td>
      <td>&nbsp;</td>
      <td><input name="homepagetitle" type="text" id="homepagetitle"  value="<?php echo $prow['homepagetitle'];?>" class="form-control"  /></td>
    </tr>
    <tr>
      <td height="30">Meta Tag Description </td>
      <td>&nbsp;</td>
      <td><textarea name="homemetadesc" id="homemetadesc"  class="form-control" ><?php echo $prow['homemetadesc'];?></textarea></td>
    </tr>
    <tr>
      <td height="30">Meta Keywords </td>
      <td>&nbsp;</td>
      <td><input name="homemetakeywords" type="text" id="homemetakeywords" value="<?php echo $prow['homemetakeywords'];?>"  class="form-control"  />
        use commo , for multiple keywords </td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30"><strong>Email Details</strong> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30">To Email </td>
      <td>&nbsp;</td>
      <td><input name="toemail" type="text" id="toemail"  value="<?php echo $prow['toemail'];?>"  class="form-control" /></td>
    </tr>
    <tr>
      <td height="30">To Email Name </td>
      <td>&nbsp;</td>
      <td><input name="toemailname" type="text" id="toemailname"  value="<?php echo $prow['toemailname'];?>"  class="form-control" /></td>
    </tr>
    <tr>
      <td height="30">From Email </td>
      <td>&nbsp;</td>
      <td><input name="fromemail" type="text" id="fromemail" value="<?php echo $prow['fromemail'];?>"  class="form-control"  /></td>
    </tr>
    <tr>
      <td height="30">From Email Name </td>
      <td>&nbsp;</td>
      <td><input name="fromemailname" type="text" id="fromemailname" value="<?php echo $prow['fromemailname'];?>"  class="form-control"  /></td>
    </tr>    
    <tr>
      <td height="30">&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</div>
<footer>

<?php include('footer-copyright.php'); ?>

              </footer>
</div>
</div>
</div>

      

<?php include('footer.php'); ?>