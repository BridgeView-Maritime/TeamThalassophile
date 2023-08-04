<?php include('header.php'); $gtpage = 'package-list'; $rwseditor=1; $gtdateopt="on"; checkadminroles('package');
$_SESSION['myForm']="";

if(isset($_GET["fid"]))
{
	$select_query = 'SELECT t1.*, t3.name as service_name FROM ss_services_package as t1 INNER JOIN ss_services as t3 ON t1.service_id=t3.service_id WHERE t1.services_package_id = "'.$_GET["fid"].'"';
	$select_result = $db->query($select_query);
	$row = $select_result->row;

	$_SESSION['myForm']['services_package_id'] 		= stripslashes($row['services_package_id']);
	$_SESSION['myForm']['title'] 					= stripslashes($row['package_subtitle']);
	$_SESSION['myForm']['package_id'] 				= stripslashes($row['package_id']);
	$_SESSION['myForm']['package_price'] 			= stripslashes($row['package_price']);
	$_SESSION['myForm']['description'] 				= stripslashes($row['description']);
	$_SESSION['myForm']['duration'] 				= stripslashes($row['duration']);
	$_SESSION['myForm']['total_hours'] 				= stripslashes($row['total_hours']);
	$_SESSION['myForm']['hourly_cost'] 				= stripslashes($row['hourly_cost']);
	$_SESSION['myForm']['discounted_hourly_cost'] 	= stripslashes($row['discounted_hourly_cost']);
	$_SESSION['myForm']['status'] 					= stripslashes($row['status']);
	
	$_SESSION['myForm']['total_seat'] 				= stripslashes($row['total_seat']);
	$_SESSION['myForm']['from'] 					= stripslashes($row['from']);
	$_SESSION['myForm']['to'] 						= stripslashes($row['to']);
	$_SESSION['myForm']['stoppage'] 				= stripslashes($row['stoppage']);
	$_SESSION['myForm']['start_time'] 				= stripslashes($row['start_time']);
	$_SESSION['myForm']['end_time'] 				= stripslashes($row['end_time']);
	$_SESSION['myForm']['featured'] 				= stripslashes($row['featured']);
	
	$_SESSION['myForm']['pickup_point'] 			= stripslashes($row['pickup_point']);
	$_SESSION['myForm']['drop_point'] 				= stripslashes($row['drop_point']);
	
	
	$_SESSION['myForm']['package_mrp'] 				= stripslashes($row['package_mrp']);
	
	$_SESSION['myForm']['path'] 					= todisplaypath($row['service_id']);
	
	$_SESSION['myForm']['service_id'] 				= stripslashes($row['service_id']);

	$product_categories = categorylistforaproducts($row['service_id']);


	$reg_title = 'Edit Category Product Details';
	$reg_subtitle = 'Package Category Product Edit Page';
	$reg_breadcrumb = 'Edit Category Product Details';
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
                        <li><a href="<?php echo $baseurl; ?>master/package-list.php"><i class="fa fa-leaf"></i> Bus List </a></li>
                        <li class="active"><?php echo $reg_breadcrumb; ?></li>
                    </ol>
                </section>



                <!-- Main content -->
                <section class="content">
                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="package-post-form.php" method="post" enctype="multipart/form-data">

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
                                    <h3 class="box-title">Product Pricing Details</h3><span style="float:right; display:inline-block; padding:5px;"><button class="btn btn-primary" type="button" name="rws-addbtn" onclick="document.location.href='package-copy.php?fid=<?php echo $_GET["fid"]?>'"> Copy this Bus Details </button></span>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                	<?php if($_GET['fid']!="") { ?>
                                    	<input name="post_id" type="hidden" value="<?php echo $row['services_package_id']; ?>" />
                                    <?php } ?>
                                    <div class="box-body">
                                    
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Size<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                                <div class="ui-widget">
                                                    <input type="text" name="path" value="<?php echo $_SESSION['myForm']['path']; ?>" class="form-control ui-autocomplete-input" size="100" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" required="required">
                                                    <input type="hidden" name="parent_id" value="<?php echo $_SESSION['myForm']['service_id']; ?>">
    
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputEmail1">Size<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="title" placeholder="Size" id="title" class="form-control" value="<?php echo $_SESSION['myForm']['title']; ?>" required="required"></div>

                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">MRP<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="number" name="package_mrp" placeholder="Ticket MRP" id="package_mrp" class="form-control" value="<?php echo $_SESSION['myForm']['package_mrp']; ?>" min="200" max="20000" required="required"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Selling Price<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="number" name="package_price" placeholder="Ticket Selling Price" id="package_price" class="form-control" value="<?php echo $_SESSION['myForm']['package_price']; ?>" min="200" max="20000" required="required"></div>
                                        </div>
                                        
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

                                          <button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='package-list.php'"> Back </button>

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