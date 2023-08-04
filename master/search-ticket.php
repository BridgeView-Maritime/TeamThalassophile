<?php include('header.php'); $gtpage = 'search-ticket'; $rwseditor=0; $gtdateopt="on";  checkadminroles('reports');

$_SESSION['myForm']="";

	$reg_title = 'Book Ticket';
	$reg_subtitle = 'Book Ticket From Admin';
	$reg_breadcrumb = 'Book Ticket';
	$reg_button = 'Search';	

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
                        <li class="active"><?php echo $reg_breadcrumb; ?></li>
                    </ol>
                </section>



                <!-- Main content -->
                <section class="content">
                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="" method="get" enctype="multipart/form-data">

                	<div class="row">

                        <div class="col-md-12">
                        
                        <?php if(isset($_SESSION["gtThanksMSGbooking"])) { echo $_SESSION["gtThanksMSGbooking"]; unset($_SESSION["gtThanksMSGbooking"]); }?>

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

                                    <h3 class="box-title">Search Ticket Availability</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-sm-3"><input type="text" name="rws_from" id="rws_from" value="<?php echo $_GET["rws_from"]; ?>" class="rwscityicon form-control" autocomplete="off" required="required" placeholder="*FROM" /></div>
                                            <div class="col-sm-3"><input type="text" name="rws_to" id="rws_to" value="<?php echo $_GET["rws_to"]; ?>" class="rwscityicon form-control" autocomplete="off" required="required"  placeholder="*TO" /></div>
                                            <div class="col-sm-3"><input type="text" name="rws_onward_date" id="rws_onward_date" class="rwsdatecal form-control" value="<?php echo $_GET["rws_onward_date"]; ?>" autocomplete="off" required="required"  placeholder="*ONWARD DATE" /></div>
                                            <div class="col-sm-3"><button class="btn btn-primary" type="submit" name="rws-submit"> <?php echo $reg_button; ?> </button></div>
                                        </div>                                        
                                    </div><!-- /.box-body -->   
                            </div>
                        </div>
                        </div>
                        
                         </form>

                        <div class="row">

                            <div class="col-md-12">
                            	

                                <div class="box box-warning" style=" overflow:hidden;">                                
                                    <?php			
										if(isset($_GET["rws_onward_date"]))
										{
											$rws_from 			= $_GET["rws_from"];
											$rws_to 			= $_GET["rws_to"];
											$rws_onward_date 	= $_GET["rws_onward_date"];
											$rws_return_date 	= $_GET["rws_return_date"];
											
											$queryfeatured = "SELECT * FROM `ss_services_package` WHERE `from` = '$rws_from' AND `to` = '$rws_to' ORDER BY date_added DESC LIMIT 0, 20";
											
											echo getlistofbusservicessearch($queryfeatured, $rws_onward_date, $rws_return_date, "Admin"); 
										} 
										else 
										{ 
											echo '<div id="gt-formattention" style="margin:20px;"><strong>Please select date to check availability.</strong></div>';
										} 
									?>
                                </div>

                            </div>

                        </div>


                       

                    

                    

                          	

              </section><!-- /.content -->

              

              <footer>

              		<?php include('footer-copyright.php'); ?>

              </footer>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>