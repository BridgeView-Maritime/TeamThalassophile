<?php include('header.php'); $gtpage = 'services-list'; $rwseditor=0; $gtdateopt="on"; checkadminroles('services');

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
	$starting_from				= addslashes($_POST["starting_from"]);
	$parent_id 					= addslashes($_POST["parent_id"]);	
	$status 					= addslashes($_POST["status"]);	
	$post_id 					= $_POST["post_id"];
	
	$service_description		= $_POST["service_description"];
	$discount					= $_POST["discount"];
	$total_seat					= $_POST["total_seat"];
	
	$bus_no						= $_POST["bus_no"];
	$driver_contact				= $_POST["driver_contact"];
	
	$occasion					= $_POST["occasion"];
	$forwhom					= $_POST["forwhom"];
	$meta_title					= $_POST["meta_title"];
	$meta_keyword				= $_POST["meta_keyword"];
	$meta_description			= $_POST["meta_description"];
	$seourl						= $_POST["seourl"];
	$featured					= $_POST["featured"];
	
	
	

	// Form Validation Code

	$errors = array(); //Initialize error array 

	if (empty($_POST['title']) ) 		{	$errors[]="Service Name field can't be blank!";			}

	if(empty($errors)) {		
		// UPLOAD FILE CODE STARTS 
		
		if(trim($post_id) =="")
		{			
			$rand2 = mt_rand(100000,999999);
			$uploadfolder = '../images/servicebg';
			
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
			$uploadfolder = '../images/servicebg';
			
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
		
		// UPLOAD FILE CODE ENDS

		if(trim($post_id)!="")
		{
			$update_query = "UPDATE `ss_services` SET `name` = '$title', `status` = '$status', `parent_id` = '$parent_id', `service_description` = '$service_description', `service_image` = '".$imageuploadname[1]."', `service_image_2` = '".$imageuploadname[2]."', `starting_from`='$starting_from', `total_seat`='$total_seat', `discount`='$discount', `bus_no`='$bus_no', `driver_contact`='$driver_contact', `occasion`='$occasion', `forwhom`='$forwhom', `meta_title`='$meta_title', `meta_keyword`='$meta_keyword', `meta_description`='$meta_description', `seourl`='$seourl', `featured`='$featured' WHERE `service_id`= '$post_id'";
			
			$update_result = $db->query($update_query);		
			
			$msg_result='<div id="gt-formsuccess">Category Product has been updated successfully.!</div>';	
		}
		else
		{
			$update_query = "INSERT INTO `ss_services` SET `name` = '$title', `status` = '$status', `parent_id` = '$parent_id', `date_added`='$gtcurrenttime', `service_description` = '$service_description', `starting_from`='$starting_from', `discount`='$discount', `total_seat`='$total_seat', `bus_no`='$bus_no', `driver_contact`='$driver_contact', `occasion`='$occasion', `forwhom`='$forwhom', `meta_title`='$meta_title', `meta_keyword`='$meta_keyword', `meta_description`='$meta_description', `seourl`='$seourl', `featured`='$featured', `service_image_2` = '".$imageuploadname[2]."', `service_image` = '".$imageuploadname[1]."'";

			$update_result = $db->query($update_query);
			$msg_result='<div id="gt-formsuccess">Category Product has been added successfully.!</div>';
			
			$service_id = $db->getLastId();
			
			/* Add product Pricing*/
			if($parent_id==6)
			{
				//Collage - Adding price for A3 
				
				$update_query = "INSERT INTO `ss_services_package` SET `service_id` = '$service_id', `package_price` = '1020', `package_subtitle`='A3', `status`='1', `package_mrp`='1200', `date_added`='$gtcurrenttime'";
				$update_result = $db->query($update_query);
	
				//Collage - Adding price for A2
				
				$update_query = "INSERT INTO `ss_services_package` SET `service_id` = '$service_id', `package_price` = '1980', `package_subtitle`='A2', `status`='1', `package_mrp`='2200', `date_added`='$gtcurrenttime'";
				$update_result = $db->query($update_query);
			}
			else
			{
				//Collage - Adding price for A5
				
				$update_query = "INSERT INTO `ss_services_package` SET `service_id` = '$service_id', `package_price` = '360', `package_subtitle`='A5', `status`='1', `package_mrp`='400', `date_added`='$gtcurrenttime'";
				$update_result = $db->query($update_query);
	
				//Collage - Adding price for A4
				
				$update_query = "INSERT INTO `ss_services_package` SET `service_id` = '$service_id', `package_price` = '450', `package_subtitle`='A4', `status`='1', `package_mrp`='500', `date_added`='$gtcurrenttime'";
				$update_result = $db->query($update_query);
			}
			

		}
		unset($_SESSION['myForm']);

	}

}

if(isset($_GET["fid"]))
{
$select_query = 'SELECT * FROM `ss_services` WHERE service_id = "'.$_GET["fid"].'"';
$select_result = $db->query($select_query);
$row = $select_result->row;

$_SESSION['myForm']['service_id'] 			= stripslashes($row['service_id']);
$_SESSION['myForm']['title'] 				= stripslashes($row['name']);
$_SESSION['myForm']['parent_id'] 			= stripslashes($row['parent_id']);
$_SESSION['myForm']['status'] 				= stripslashes($row['status']);
$_SESSION['myForm']['service_image'] 		= stripslashes($row['service_image']);
$_SESSION['myForm']['service_description'] 	= stripslashes($row['service_description']);
$_SESSION['myForm']['path'] 				= todisplaypath($row['parent_id']);
$_SESSION['myForm']['starting_from'] 		= stripslashes($row['starting_from']);

$_SESSION['myForm']['total_seat'] 			= stripslashes($row['total_seat']);
$_SESSION['myForm']['bus_no'] 				= stripslashes($row['bus_no']);
$_SESSION['myForm']['driver_contact'] 		= stripslashes($row['driver_contact']);

$_SESSION['myForm']['service_image_2'] 		= stripslashes($row['service_image_2']);

$_SESSION['myForm']['discount'] 			= stripslashes($row['discount']);

$_SESSION['myForm']['occasion'] 			= stripslashes($row['occasion']);
$_SESSION['myForm']['forwhom'] 				= stripslashes($row['forwhom']);
$_SESSION['myForm']['meta_title'] 			= stripslashes($row['meta_title']);
$_SESSION['myForm']['meta_keyword'] 		= stripslashes($row['meta_keyword']);
$_SESSION['myForm']['meta_description'] 	= stripslashes($row['meta_description']);
$_SESSION['myForm']['seourl'] 				= stripslashes($row['seourl']);
$_SESSION['myForm']['featured'] 			= stripslashes($row['featured']);


	$reg_title = 'Edit Category Product';
	$reg_subtitle = 'Category Product Edit Page';
	$reg_breadcrumb = 'Edit Category Product';
	$reg_button = 'Update';
}
else
{	
	$reg_title = 'Add New Category Product';
	$reg_subtitle = 'Category Product Add Page';
	$reg_breadcrumb = 'Add New Category Product';
	$reg_button = 'Save';
	if($_SESSION['myForm']['status']=="")
	{
		$_SESSION['myForm']['status'] = '1';
	}
}

$query="SELECT service_id, name FROM ss_services WHERE name LIKE 'class%' AND status=1 ORDER BY service_id ASC LIMIT 0, 15";
$rs = $db->query($query);

$foundnum = $rs->num_rows;	
$data = array();
$rowlist = $rs->rows;
if ($foundnum>0)
{
	foreach($rowlist as $key => $row) { 
	  $data[] = array(
            'name' => todisplaypath($row['service_id']),
            'service_id' => $row['service_id']
        );
    }
}

/*print("<pre>");
print_r($data);
print("</pre>");*/

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
                        <li><a href="<?php echo $baseurl; ?>master/services-list.php"><i class="fa fa-leaf"></i> Services List </a></li>
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

                                    <h3 class="box-title">Product Details</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->
                                	<?php if($_GET['fid']!="") { ?>
                                    	<input name="post_id" type="hidden" value="<?php echo $_GET['fid']; ?>" />
                                        <input name="oldimage_1" type="hidden" value="<?php echo $_SESSION['myForm']['service_image']; ?>" />
                                        <input name="oldimage_2" type="hidden" value="<?php echo $_SESSION['myForm']['service_image_2']; ?>" />
                                    <?php } ?>
                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputEmail1">Name<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="title" placeholder="Name" id="title" class="form-control" value="<?php echo $_SESSION['myForm']['title']; ?>" required="required"></div>

                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Occation</label></div>
                                            <div class="col-md-10"><input type="text" name="occasion" placeholder="Occation" id="occasion" class="form-control" value="<?php echo $_SESSION['myForm']['occasion']; ?>"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">For Whom</label></div>
                                            <div class="col-md-10"><input type="text" name="forwhom" placeholder="For Whom" id="forwhom" class="form-control" value="<?php echo $_SESSION['myForm']['forwhom']; ?>"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Parent Name<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                                <div class="ui-widget">
                                                    <input type="text" name="path" value="<?php echo $_SESSION['myForm']['path']; ?>" size="100" class="ui-autocomplete-input form-control" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                    <input type="hidden" name="parent_id" value="<?php echo $_SESSION['myForm']['parent_id']; ?>">
    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Product Image 1</label></div>
                                            <div class="col-md-10">
                                            <input name="image_1" id="image_1" type="file" /><br />
                                            <?php if($_SESSION['myForm']['service_image']!="") { ?><a href="<?php echo $baseurl.'images/servicebg/'.$_SESSION['myForm']['service_image']; ?>" title="View Image" target="_blank">View Image</a><?php } else { echo "<strong>No image added yet!</strong>"; } ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Product Image 2</label></div>
                                            <div class="col-md-10">
                                            <input name="image_2" id="image_2" type="file" /><br />
                                            <?php if($_SESSION['myForm']['service_image_2']!="") { ?><a href="<?php echo $baseurl.'images/servicebg/'.$_SESSION['myForm']['service_image_2']; ?>" title="View Image" target="_blank">View Image</a><?php } else { echo "<strong>No image added yet!</strong>"; } ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputPassword1">Show on Home</label></div>
                                            <div class="col-md-10"><input type="radio" name="featured" value="1" id="featured_0" <?php if($_SESSION['myForm']['featured']=='1') { echo 'checked="checked"'; } ?>  /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <input type="radio" name="featured" value="0" id="featured_1" <?php if($_SESSION['myForm']['featured']=='0') { echo 'checked="checked"'; } ?>  />  No  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputPassword1">Status</label></div>
                                            <div class="col-md-10"><input type="radio" name="status" value="1" id="RadioGroup1_0" <?php if($_SESSION['myForm']['status']=='1') { echo 'checked="checked"'; } ?>  /> Published &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <input type="radio" name="status" value="0" id="RadioGroup1_1" <?php if($_SESSION['myForm']['status']=='0') { echo 'checked="checked"'; } ?>  />  Unpublished  
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputEmail1">SEO URL<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="seourl" placeholder="SEO URL" id="seourl" class="form-control" value="<?php echo $_SESSION['myForm']['seourl']; ?>"></div>

                                        </div>
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputEmail1">Meta Title<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="meta_title" placeholder="Meta Title" id="meta_title" class="form-control" value="<?php echo $_SESSION['myForm']['meta_title']; ?>"></div>

                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Meta Keyword</label></div>
                                            <div class="col-md-10"><input type="text" name="meta_keyword" placeholder="Meta Keyword" id="meta_keyword" class="form-control" value="<?php echo $_SESSION['myForm']['meta_keyword']; ?>"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Meta Description</label></div>
                                            <div class="col-md-10"><input type="text" name="meta_description" placeholder="Meta Description" id="meta_description" class="form-control" value="<?php echo $_SESSION['myForm']['meta_description']; ?>"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputPassword1">Description</label></div>
                                            <div class="col-md-10"><textarea name="service_description" id="service_description" cols="" rows="4"  class="form-control"><?php echo $_SESSION['myForm']['service_description']; ?></textarea> 
                                            </div>
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

                                          <button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='services-list.php'"> Back </button>

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

<?php 
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
?>