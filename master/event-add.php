<?php include('header.php'); $gtpage = 'event-list'; $rwseditor=1; $gtdateopt = "on";

$_SESSION['myForm']="";

if(isset($_POST["rws-submit"]))
{
	global $gt_exploits, $gt_profanity, $gt_spamwords;

	foreach ($_POST as $key => $val) {
		$_POST["$key"] = cleandatafromspam($val);	
		if (preg_match($gt_exploits, $val)) {
			exit("<p>Exploits/malicious scripting attributes aren't allowed.</p>");
		} elseif (preg_match($gt_profanity, $val) || preg_match($gt_spamwords, $val)) {
			exit("<p>That kind of language is not allowed through our form.</p>");
		}
	}	

	$_SESSION['myForm'] = $_POST;

	$title 						= addslashes($_POST["title"]);
	$start_date 				= tochangedateformat($_POST["start_date"],"DB");
	$start_time 				= addslashes($_POST["start_time"]);
	$end_date 					= tochangedateformat($_POST["end_date"],"DB");
	$end_time 					= addslashes($_POST["end_time"]);
	$address 					= addslashes($_POST["address"]);
	
	$city 						= addslashes($_POST["city"]);
	$postcode 					= addslashes($_POST["postcode"]);
	$state 						= addslashes($_POST["state"]);
	$country 					= addslashes($_POST["country"]);
	$description 				= addslashes($_POST["description"]);
	$status 					= addslashes($_POST["status"]);
	$recurring 					= addslashes($_POST["recurring"]);
	
	$featured 					= addslashes($_POST["featured"]);
	$post_id 					= addslashes($_POST["post_id"]);
	

	

	// Form Validation Code

	$errors = array(); //Initialize error array 

	if (empty($_POST['title']) ) 		{	$errors[]="Title field can't be blank!";	}

		

	// Allowed file types. add file extensions WITHOUT the dot.

	$allowtypes=array("jpg", "JPG", "JPEG", "jpeg", "gif", "GIF", "PNG", "png");

	$max_file_size="2048";

	// checks that we have a file

	if((!empty($_FILES["image_1"])) && ($_FILES['image_1']['error'] == 0)) {

	// basename -- Returns filename component of path

	$filename = basename($_FILES['image_1']['name']);

	$ext = substr($filename, strrpos($filename, '.') + 1);

	$filesize=$_FILES['image_1']['size'];

	$max_bytes=$max_file_size*1024;

	

	//Check if the file type uploaded is a valid file type. 

	if (!in_array($ext, $allowtypes)) {

		$errors[]="File <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .jpg, .JPG, .jpeg, .JPEG, .gif and .PNG.";	

	// check the size of each file

	} elseif($filesize > $max_bytes) {

		$errors[]= "Your file: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";

	}

	

	} // if !empty FILES

	

	

	

	if(empty($errors)) {		

		

		// UPLOAD FILE CODE STARTS 

		

		if(trim($post_id) =="")

		{

		

			$array_rand = array("rad", "dfd","met","axz", "yza", "tst", "tms", "lpg","art","mec","efc","mar","kar","lad","mah");

			$rand1 = mt_rand(100,999);

			$rand2 = mt_rand(100000,999999);

			$rand_keys = array_rand($array_rand, 2);			

			$year = date("Y");

			$month = date("m");

			$date = date("d");

			$yearfolder = "../images/events/".$year;

			$monthfolder = '../images/events/'.$year.'/'.$month;

			$datefolder = '../images/events/'.$year.'/'.$month.'/'.$date;

			if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('../images/index.html', $yearfolder.'/index.html'); }

			if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('../images/index.html', $monthfolder.'/index.html'); }

			if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('../images/index.html', $datefolder.'/index.html'); }			

			$uploadfolder = $datefolder;

			for($k=1;$k<=2;$k++)
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
			$imgurl = 'images/events/'.$year.'/'.$month.'/'.$date.'/';
		}
		else
		{	
			$array_rand = array("rad", "dfd","met","axz", "yza", "tst", "tms", "lpg","art","mec","efc","mar","kar","lad","mah");
			$rand1 = mt_rand(100,999);
			$rand2 = mt_rand(100000,999999);
			$rand_keys = array_rand($array_rand, 2);		

			$year = date("Y");
			$month = date("m");
			$date = date("d");		

			if(trim($_POST['uploadfolder'])=="")
			{
				$yearfolder = "../images/events/".$year;
				$monthfolder = '../images/events/'.$year.'/'.$month;
				$datefolder = '../images/events/'.$year.'/'.$month.'/'.$date;

				if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('../images/index.html', $yearfolder.'/index.html'); }
				if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('../images/index.html', $monthfolder.'/index.html'); }
				if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('../images/index.html', $datefolder.'/index.html'); }				

				$uploadfolder = $datefolder;
				$imgurl = 'images/events/'.$year.'/'.$month.'/'.$date.'/';
			}
			else
			{		
				$uploadfolder = '../'.$_POST['uploadfolder'];
				$imgurl = trim($_POST['uploadfolder']);	
			}		
			for($k=1;$k<=2;$k++)
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
					$imageuploadname[$k]=$_POST['oldimage_'.$k];
				}
			}
		}

		// UPLOAD FILE CODE STARTS 		

		if(trim($post_id)!="")
		{
			$update_query = "UPDATE `ss_event_courses` SET `title` = '$title', `event_img` = '".$imageuploadname[1]."', `imgurl` = '$imgurl', `start_date` = '$start_date', `start_time` = '$start_time', `end_date` = '$end_date', `end_time` = '$end_time', `address` = '$address', `city` = '$city', `postcode` = '$postcode', `state` = '$state', `country`='$country', `description`='$description', `recurring`='$recurring', `featured`='$featured', `status`='$status' WHERE `id`= '$post_id'";

			$update_result = $db->query($update_query);			

			$msg_result='<div id="gt-formsuccess">Courses/Events has been updated successfully.!</div>';			

		}
		else
		{
			$update_query = "INSERT INTO `ss_event_courses` SET `title` = '$title', `event_img` = '".$imageuploadname[1]."', `imgurl` = '$imgurl', `start_date` = '$start_date', `start_time` = '$start_time', `end_date` = '$end_date', `end_time` = '$end_time', `address` = '$address', `city` = '$city', `postcode` = '$postcode', `state` = '$state', `country`='$country', `description`='$description', `recurring`='$recurring', `status`='$status', `featured`='$featured', `add_date`='$gtcurrenttime'";
			$update_result = $db->query($update_query);		

			$msg_result='<div id="gt-formsuccess">Courses/Events has been added successfully.!</div>';
		}
		unset($_SESSION['myForm']);
	}
}

if(isset($_GET["fid"]))
{
	
$select_query = 'SELECT * FROM `ss_event_courses` WHERE id = "'.$_GET["fid"].'"';
$select_result = $db->query($select_query);
$row = $select_result->row;

$_SESSION['myForm']['id'] = stripslashes($row['id']);
$_SESSION['myForm']['title'] = stripslashes($row['title']);
$_SESSION['myForm']['event_img'] = stripslashes($row['event_img']);
$_SESSION['myForm']['imgurl'] = stripslashes($row['imgurl']);
$_SESSION['myForm']['start_date'] = tochangedateformat($row['start_date'], "SHOW");
$_SESSION['myForm']['start_time'] = stripslashes($row['start_time']);
$_SESSION['myForm']['end_date'] = tochangedateformat($row['end_date'], "SHOW");
$_SESSION['myForm']['end_time'] = stripslashes($row['end_time']);

$_SESSION['myForm']['address'] = stripslashes($row['address']);
$_SESSION['myForm']['city'] = stripslashes($row['city']);
$_SESSION['myForm']['postcode'] = stripslashes($row['postcode']);
$_SESSION['myForm']['state'] = stripslashes($row['state']);
$_SESSION['myForm']['country'] = stripslashes($row['country']);
$_SESSION['myForm']['description'] = stripslashes($row['description']);
$_SESSION['myForm']['recurring'] = stripslashes($row['recurring']);
$_SESSION['myForm']['status'] = stripslashes($row['status']);
$_SESSION['myForm']['featured'] = stripslashes($row['featured']);

	$reg_title = 'Edit Courses/Events';

	$reg_subtitle = 'Courses/Events Edit Page';

	$reg_breadcrumb = 'Edit Courses/Events';

	$reg_button = 'Update';



}

else

{	

	$reg_title = 'Add New Courses/Events';

	$reg_subtitle = 'Courses/Events Add Page';

	$reg_breadcrumb = 'Add New Courses/Events';

	$reg_button = 'Save';

	if($_SESSION['myForm']['status']=="")
	{
		$_SESSION['myForm']['status'] = '1';
	}
	if($_SESSION['myForm']['featured']=="")
	{
		$_SESSION['myForm']['featured'] = '0';
	}

}



?>



        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->

            <?php include('sidebar.php'); ?>



            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        <?php echo $reg_title; ?>

                        <small><?php echo $reg_subtitle; ?></small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li><a href="<?php echo $baseurl; ?>master/ukc-submissions.php"><i class="fa fa-leaf"></i> Category List </a></li>

                        <li class="active"><?php echo $reg_breadcrumb; ?></li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="" method="post" enctype="multipart/form-data">

                	<div class="row">

                        <div class="col-md-12">

                        <?php if(!empty($errors)) {

                            echo '<div id="gt-formfeedback"><b><font size="4">WHOOPS! Please review the following issues:</font></b><ul>';

                                foreach ($errors as $msg) { //prints each error

                                echo "<li>$msg</li>";

                                } // end of foreach

                                echo '</ul></div>'; }

                                

                                if($msg_result !="") { echo $msg_result; }

                        ?>

                        </div>

                    </div>

					<div class="row">

                    

                    	<div class="col-md-12">

                        	<div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title">Course/Event Details</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->

                                	<?php if(trim($row['id']) !="") { ?>

                                    	<input name="post_id" type="hidden" value="<?php echo $row['id']; ?>" />

                                        <input name="oldimage_1" type="hidden" value="<?php echo $_SESSION['myForm']['college_photo']; ?>" />

                        				<input name="uploadfolder" type="hidden" value="<?php echo $_SESSION['myForm']['imgurl']; ?>" />

                                    <?php } ?>

                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputEmail1">Title<span class="error">*</span></label></div>

                                            <div class="col-md-10"><input type="text" name="title" placeholder="Title" id="title" class="form-control" value="<?php echo $_SESSION['myForm']['title']; ?>"></div>

                                        </div>
                                        
                                       

                                       <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Address</label></div>

                                            <div class="col-md-10"><input type="text" name="address" placeholder="Address" id="address" class="form-control" value="<?php echo $_SESSION['myForm']['address']; ?>"></div>

                                        </div>

                                         <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">City</label></div>

                                            <div class="col-md-10"><input type="text" name="city" placeholder="City" id="city" class="form-control" value="<?php echo $_SESSION['myForm']['city']; ?>"></div>

                                        </div>
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Postcode</label></div>

                                            <div class="col-md-10"><input type="text" name="postcode" placeholder="Postcode" id="postcode" class="form-control" value="<?php echo $_SESSION['myForm']['postcode']; ?>"></div>

                                        </div>
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">State</label></div>

                                            <div class="col-md-10"><input type="text" name="state" placeholder="State" id="state" class="form-control" value="<?php echo $_SESSION['myForm']['state']; ?>"></div>

                                        </div>
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Country</label></div>

                                            <div class="col-md-10"><input type="radio" name="country" id="country_1" value="Australia" required="required" <?php if($_SESSION['myForm']['country']=="Australia") { echo 'checked="checked"'; } else { } ?> /> &nbsp;&nbsp;Australia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="country" id="country_1" value="New Zealand" required="required"  <?php if($_SESSION['myForm']['country']=="New Zealand") { echo 'checked="checked"'; } else { } ?>  />&nbsp;&nbsp; New Zealand</div>

                                        </div>
                                        
                                         <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Start Date</label></div>

                                            <div class="col-md-10"><input type="text" name="start_date" placeholder="Start Date" id="start_date" class="form-control gtdatedropdown" value="<?php echo $_SESSION['myForm']['start_date']; ?>" autocomplete="off"></div>

                                        </div>
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">End Date</label></div>

                                            <div class="col-md-10"><input type="text" name="end_date" placeholder="End Date" id="end_date" class="form-control gtdatedropdown" value="<?php echo $_SESSION['myForm']['end_date']; ?>" autocomplete="off"></div>

                                        </div>

                                        

                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Event Image</label></div>

                                            <div class="col-md-10">

                                            	<input name="image_1" id="image_1" type="file" /><br />

												<span class="error">(Image type should be <strong>jpg</strong> and maximum size will be <strong>1024 kb</strong> only. )</span><br />

												<?php if(trim($row['id']) !="") { if($row['event_img']!="") { ?><a href="<?php echo $baseurl.$_SESSION['myForm']['imgurl'].$_SESSION['myForm']['event_img']; ?>" title="View College Pic" target="_blank">View Pic</a><?php } else { echo "<strong>No Pic added yet!</strong>"; } }?>

                                             </div>

                                        </div>

                                        

                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Status</label></div>

                                            <div class="col-md-10"><input type="radio" name="status" value="1" id="RadioGroup1_0" <?php if($_SESSION['myForm']['status']=='1') { echo 'checked="checked"'; } ?>  /> Published &nbsp;&nbsp;&nbsp;&nbsp;

                                                  <input type="radio" name="status" value="0" id="RadioGroup1_1" <?php if($_SESSION['myForm']['status']=='0') { echo 'checked="checked"'; } ?>  />  Unpublished                                              

                                            </div>

                                        </div> 
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Display On Home</label></div>

                                            <div class="col-md-10"><input type="radio" name="featured" value="1" id="featured1_0" <?php if($_SESSION['myForm']['featured']=='1') { echo 'checked="checked"'; } ?>  /> Yes &nbsp;&nbsp;&nbsp;&nbsp;

                                                  <input type="radio" name="featured" value="0" id="featured1_1" <?php if($_SESSION['myForm']['featured']=='0') { echo 'checked="checked"'; } ?>  />  No                                              

                                            </div>

                                        </div>  
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Description</label></div>

                                            <div class="col-md-10"><textarea name="description" id="rwscontenteditor" placeholder="Description"></textarea></div>

                                        </div>                                    

                                        

                                    </div><!-- /.box-body -->                                    

                                

                            </div>

                        </div>

                        

                        </div>

                        

                        <div class="row">

                            <div class="col-md-12">

                                <div class="box box-warning">

                                    <div class="box-footer" style="text-align:center">

                                          <button class="btn btn-primary" type="submit" name="rws-submit"> <?php echo $reg_button; ?> </button>

                                          &nbsp;&nbsp;&nbsp;&nbsp;

                                          <button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='event-list.php'"> Back </button>

                                     </div>

                                </div>

                            </div>

                        </div>

                        </form>

                    

                    

                          	

              </section><!-- /.content -->

              

              <footer>

              		<?php include('footer-copyright.php'); ?>

              </footer>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>