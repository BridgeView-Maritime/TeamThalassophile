<?php include('header.php'); $gtpage = 'services-img-list'; $rwseditor=1; $gtdateopt="on"; checkadminroles('package');
$_SESSION['myForm']="";

if(isset($_GET["fid"]))
{
	$select_query = 'SELECT t1.*, t3.name as service_name FROM ss_services_images as t1 INNER JOIN ss_services as t3 ON t1.service_id=t3.service_id WHERE t1.services_img_id = "'.$_GET["fid"].'"';
	$select_result = $db->query($select_query);
	$row = $select_result->row;

	$_SESSION['myForm']['services_img_id'] 			= stripslashes($row['services_img_id']);
	$_SESSION['myForm']['image'] 					= stripslashes($row['image']);

	$_SESSION['myForm']['status'] 					= stripslashes($row['status']);
	
	$_SESSION['myForm']['path'] 					= todisplaypath($row['service_id']);
	
	$_SESSION['myForm']['service_id'] 				= stripslashes($row['service_id']);

	$product_categories = categorylistforaproducts($row['service_id']);


	$reg_title = 'Edit Bus Image';
	$reg_subtitle = ' Bus Image Edit Page';
	$reg_breadcrumb = 'Edit  Bus Image';
	$reg_button = 'Update';
}
else
{	
	$reg_title = 'Add New  Bus Image';
	$reg_subtitle = ' Bus Image Add Page';
	$reg_breadcrumb = 'Add New  Bus Image';
	$reg_button = 'Save';
	if($_SESSION['myForm']['status']=="")
	{
		$_SESSION['myForm']['status'] = '1';
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
                        <li><a href="<?php echo $baseurl; ?>master/services-img-list.php"><i class="fa fa-leaf"></i> Service Template List </a></li>
                        <li class="active"><?php echo $reg_breadcrumb; ?></li>
                    </ol>
                </section>



                <!-- Main content -->
                <section class="content">
                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="template-post-form.php" method="post" enctype="multipart/form-data">

                	<div class="row">

                        <div class="col-md-12">

                        <?php if(!empty($errors)) {

                            echo '<div id="gt-formfeedback"><b><font size="4">WHOOPS! Please review the following issues:</font></b><ul>';
                                foreach ($errors as $msg) { //prints each error
                                echo "<li>$msg</li>";
                                } // end of foreach
                                echo '</ul></div>'; }                                

                                if($msg_result !="") { echo $msg_result; }
								if($_SESSION["gtThanksMSG"] !="") { echo $_SESSION["gtThanksMSG"]; unset($_SESSION["gtThanksMSG"]); }
                        ?>

                        </div>

                    </div>

					<div class="row">
                    	<div class="col-md-12">
                        	<div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Image Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                	<?php if($_GET['fid']!="") { ?>
                                    	<input name="post_id" type="hidden" value="<?php echo $row['services_img_id']; ?>" />
                                        <input name="oldimage_1" type="hidden" value="<?php echo $_SESSION['myForm']['image']; ?>" />
                                    <?php } ?>
                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputEmail1">Image<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input name="image_1" id="image_1" type="file" /><br />
                                            <?php if($_SESSION['myForm']['image']!="") { ?><a href="<?php echo $baseurl.'images/templates/'.$_SESSION['myForm']['image']; ?>" title="View Image" target="_blank">View Image</a><?php } else { echo "<strong>No image added yet!</strong>"; } ?></div>

                                        </div>
                                        
                                        <?php if(isset($_GET["fid"])) { ?>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Bus Name<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                                <div class="ui-widget">
                                                    <input type="text" name="path" value="<?php echo $_SESSION['myForm']['path']; ?>" class="form-control ui-autocomplete-input" size="100" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                    <input type="hidden" name="parent_id" value="<?php echo $_SESSION['myForm']['service_id']; ?>">
    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } else { ?> 
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Bus Name<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                                <div class="ui-widget">
                                                    <input type="text" name="category" class="form-control ui-autocomplete-input" size="100" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" placeholder="Type Bus Name">    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">&nbsp;</label></div>
                                            <div class="col-md-10">                                                
                                                <div id="product-category" class="scrollbox">
												  <?php $class = 'odd'; ?>                                
                                                  <?php foreach ($product_categories as $product_category) { ?>                                
                                                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>                                
                                                  <div id="product-category<?php echo $product_category['category_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_category['name']; ?>&nbsp;&nbsp;<img src="img/delete.png" alt="" style="cursor:pointer;" />                                
                                                    <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />                                                  </div>                                
                                                  <?php } ?>
                                
                                                </div>                                                
                                            </div>
                                        </div>   
                                        
                                        <?php } ?>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputPassword1">Status</label></div>
                                            <div class="col-md-10"><input type="radio" name="status" value="1" id="RadioGroup1_0" <?php if($_SESSION['myForm']['status']=='1') { echo 'checked="checked"'; } ?>  /> Published &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <input type="radio" name="status" value="0" id="RadioGroup1_1" <?php if($_SESSION['myForm']['status']=='0') { echo 'checked="checked"'; } ?>  />  Unpublished  
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

                                          <button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='services-img-list.php'"> Back </button>

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