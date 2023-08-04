<?php include('header.php'); $gtpage = 'jobseekers-list'; $rwseditor=1;

$_SESSION['myForm']="";

$emp_id = $_GET["fid"];

// Get the jobseekers personal info
			$select_query 		= 'SELECT * FROM `ss_employer` WHERE id = "'.$emp_id.'"';
			$select_result 		= $db->query($select_query);
			$rowut 				= $select_result->row;
			
			
			
			
?>



        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->

            <?php include('sidebar.php'); ?>



            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        Employer Details

                        <small><?php echo $reg_subtitle; ?></small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li><a href="<?php echo $baseurl; ?>master/employer-list.php"><i class="fa fa-leaf"></i> Employer List </a></li>

                        <li class="active">Employer Details</li>

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

                                    <h3 class="box-title">Employer Details</h3>

                                </div><!-- /.box-header -->

                                <!-- form start -->

                                	<?php if(trim($row['id']) !="") { ?>

                                    	<input name="post_id" type="hidden" value="<?php echo $row['id']; ?>" />

                                        <input name="oldimage_1" type="hidden" value="<?php echo $_SESSION['myForm']['college_photo']; ?>" />

                        				<input name="uploadfolder" type="hidden" value="<?php echo $_SESSION['myForm']['imgurl']; ?>" />

                                    <?php } ?>

                                    <div class="box-body">

                                        
                                    <div class="rws-cvdatashow" id="rws-cvdatashow">
                    	
                    	<div class="rws-cvheaderdata">
                        	<div class="row">
                            	<div class="col-sm-3">
                                	<img src="<?php echo $baseurl.$rowut['logo']; ?>" alt="<?php echo $rowut['firstname'].' '.$rowut['lastname'];?>" class="rws-profileimg" />
                                </div>
                                <div class="col-sm-9">
                                	<p class="nomargin"><?php echo $rowut['firstname'].' '.$rowut['lastname'];?></p>
                                    <p class="rwsproheadline nomargin"><?php echo $rowut['company'];?></p>
                                    <p class="rwslocation nomargin"><i class="fas fa-map-marker-alt"></i> <?php echo $rowut['country'];?></p>
                                    <p class="rwscontactinfo nomargin"><i class="far fa-envelope"></i> <?php echo $rowut['email'];?> &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-mobile-alt"></i> <?php echo $rowut['mobile'];?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Header Ends -->
                        
                                                
                    </div>                                    

                                        

                                    </div><!-- /.box-body -->                                    

                                

                            </div>

                        </div>

                        

                        </div>

                        

                        <div class="row">

                            <div class="col-md-12">

                                <div class="box box-warning">

                                    <div class="box-footer" style="text-align:center">

                                         <button class="btn btn-primary" type="button" name="rws-back" onclick="document.location.href='employer-list.php'"> Back </button>

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