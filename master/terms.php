<?php include('header.php'); $gtpage = 'event-list'; $rwseditor=1; $gtdateopt = "on";

$_SESSION['myForm']="";

if(isset($_POST["rws-submit"]))
{
	global $gt_exploits, $gt_profanity, $gt_spamwords;

	/*foreach ($_POST as $key => $val)
	 {
		$_POST["$key"] = cleandatafromspam($val);	
		if (preg_match($gt_exploits, $val))
		{
			exit("<p>Exploits/malicious scripting attributes aren't allowed.</p>");
		} elseif (preg_match($gt_profanity, $val) || preg_match($gt_spamwords, $val)) 
		{
			exit("<p>That kind of language is not allowed through our form.</p>");
		}
	}	*/

	$_SESSION['myForm'] = $_POST;
	
	$description = $_POST["description"];
	$post_id = $_POST["post_id"];


	$errors = array(); //Initialize error array 

	if (empty($_POST['description']) ) 
	{
		$errors[]="Description field can't be blank!";	
	}
	

	if(empty($errors)) 
	{		

	
		
			$update_query = "UPDATE `ss_terms` SET  `description`='$description'  WHERE `id`= '$post_id'";

			$update_result = $db->query($update_query);			

			$msg_result='<div id="gt-formsuccess">Terms & Condition has been updated successfully.!</div>';			
		
	}
}


	
$select_query = 'SELECT * FROM `ss_terms` LIMIT 1';
$select_result = $db->query($select_query);
$row = $select_result->row;

$_SESSION['myForm']['id'] = stripslashes($row['id']);
$_SESSION['myForm']['description'] = stripslashes($row['description']);


	$reg_title = 'Edit Terms And Condition';

	$reg_subtitle = 'Terms And Condition Edit Page';

	$reg_breadcrumb = 'Edit Terms And Condition';

	$reg_button = 'Update';





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

                        <li><a href="<?php echo $baseurl; ?>master/ukc-submissions.php"><i class="fa fa-leaf"></i> Terms & Condition </a></li>

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


                                <!-- form start -->

                                	<?php if(trim($row['id']) !="") { ?>

                                    	<input name="post_id" type="hidden" value="<?php echo $row['id']; ?>" />

                                       
                                    <?php } ?>

                                    <div class="box-body">
 
                                        
                                        <div class="form-group row">

                                            <div class="col-md-2"><label for="exampleInputPassword1">Description</label></div>

                                            <div class="col-md-10">
                                            	<textarea name="description" id="rwscontenteditor" placeholder="Description">
                                            		<?php echo $row['description'];?>                                           			
                                            	</textarea>
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