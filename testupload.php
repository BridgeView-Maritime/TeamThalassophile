<?php 
if(isset($_POST["rwsformsubmit"]))
{	    
	$file1 = TIME().$_FILES['image_1']['name'];
	$temp1=  $_FILES['image_1']['tmp_name'];
	move_uploaded_file($temp1,"test/$file1");		
		
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" style="max-width:900px; margin:40px auto;">

<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="25%">Image</td>
    <td><input type="file" name="image_1" id="image_1" accept="image/jpeg" /></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" /> </td>
  </tr>
</table>

</form>
