<?php include('header.php'); $gtpage = 'export-frentor'; $rwseditor=0; $gtdateopt="on"; checkadminroles('reports');

$_SESSION['myForm']="";

	$reg_title = 'Export Users';
	$reg_subtitle = 'Export Users Page';
	$reg_breadcrumb = 'Export Users';
	$reg_button = 'Export';

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
                <form role="form" name="rwsglobalform"  id="rwsglobalform" action="export-frentor-csv.php" method="post" enctype="multipart/form-data" target="_blank">

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

                                    <h3 class="box-title">Export Users Criteria</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Start Date<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="start_date" placeholder="Start Date" id="start_date" class="form-control gtdatedropdown" value="" autocomplete="off"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">End Date<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input type="text" name="end_date" placeholder="End Date" id="end_date" class="form-control gtdatedropdown" value="" autocomplete="off"></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">User Type<span class="error">*</span></label></div>
                                            <div class="col-md-10"><input name="user_type" type="radio" value="F" checked="checked" /> Frentor
                                            &nbsp;&nbsp;&nbsp;&nbsp;<input name="user_type" type="radio" value="C" /> Consumer
                                            &nbsp;&nbsp;&nbsp;&nbsp;<input name="user_type" type="radio" value="B" /> Both
                                            
                                            </div>
                                        </div>
                                        
                                        
                                        <!--<div class="form-group row">
                                            <div class="col-md-2"><label for="exampleInputEmail1">Parent Name<span class="error">*</span></label></div>
                                            <div class="col-md-10">
                                                <div class="ui-widget">
                                                    <input type="text" name="path" value="<?php echo $_SESSION['myForm']['path']; ?>" size="100" class="ui-autocomplete-input form-control" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                    <input type="hidden" name="parent_id" value="<?php echo $_SESSION['myForm']['parent_id']; ?>">
    
                                                </div>
                                            </div>
                                        </div>-->
                                        
                                    </div><!-- /.box-body -->                                    

                                

                            </div>

                        </div>

                        

                        </div>

                        

                        <div class="row">

                            <div class="col-md-12">

                                <div class="box box-warning">

                                    <div class="box-footer" style="text-align:center">
                                          <button class="btn btn-primary" type="submit" name="rws-submit"> <?php echo $reg_button; ?> </button>
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