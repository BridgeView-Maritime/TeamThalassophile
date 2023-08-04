
<?php include('header.php'); $gtpage = 'employer-list'; $listjs = 1; 



if(isset($_REQUEST["action"]))

{

	$action=$_REQUEST["action"];

	$chkid="'".implode("','",$_GET["chkid"])."'";

	$chkidid=$_GET["chkid"];

	

	switch($action)

	{

		case "Inactive":
			$sql="UPDATE `ss_employer` SET `status`='0' WHERE `id` in ($chkid)";
			$db->query($sql);		
			$msg='Status has been updated successfully to Inactive!';
			$class='successmsg';
		break;

		case "Active":
			$sql="UPDATE `ss_employer` SET `status`='1'  WHERE `id` in ($chkid)";
			$db->query($sql);	
			$msg='Status has been updated successfully to Active!';
			$class='successmsg';
		break;

		case "Featured":
			$sql="UPDATE `ss_employer` SET `featured`='1' WHERE `id` in ($chkid)";
			$db->query($sql);		
			$msg='Status has been updated successfully to Featured!';
			$class='successmsg';
		break;

		case "Unfeatured":
			$sql="UPDATE `ss_employer` SET `featured`='0'  WHERE `id` in ($chkid)";
			$db->query($sql);	
			$msg='Status has been updated successfully to Unfeatured!';
			$class='successmsg';
		break;

		case "Delete":

			$sql="delete from `ss_employer` where `id` in ($chkid)";

			$db->query($sql);

			$msg='Records has been deleted successfully!';

			$class='successmsg';

		break;

	}

}

/* ----- Action Code Ends HERE ----- */







	$orderfield = $_GET["field"];

	$orderby = $_GET["order"];



	$search_txt = trim($_GET["search_txt"]);



	if($search_txt !="")

	{

		$search_exploded = explode (" ", $search_txt);

		foreach($search_exploded as $search_txt){

		$x++;

		if($x==1)

			$nquery .= " AND (firstname LIKE '%$search_txt%' OR lastname LIKE '%$search_txt%' OR email LIKE '%$search_txt%' OR mobile LIKE '%$search_txt%' OR company LIKE '%$search_txt%' OR description LIKE '%$search_txt%' ) ";

		else

			$nquery .= " AND (firstname LIKE '%$search_txt%' OR lastname LIKE '%$search_txt%' OR email LIKE '%$search_txt%' OR mobile LIKE '%$search_txt%' OR company LIKE '%$search_txt%' OR description LIKE '%$search_txt%' ) ";

		}	

		

	}



	$query="SELECT * FROM ss_employer WHERE id > 0 ".$nquery;

	$rs = $db->query($query);	

	$foundnum = $rs->num_rows;

	

	$per_page = 5;

	

	$max_pages = ceil($foundnum / $per_page);	

	$pagenum = trim($_GET['PageNo']);	

	$max_pages = ceil($foundnum / $per_page);	

	$pagenum = trim($_GET['PageNo']);

	if(is_numeric($pagenum))

	{

		if($pagenum >= $max_pages) { $pageshow = $max_pages; }

		elseif($pagenum < $max_pages && $pagenum > 0) { $pageshow = $pagenum; } 

		elseif($pagenum <= 0) { $pageshow = '1'; }

		else { $pageshow = '1';	 }

	}

	else

	{

		$pageshow = '1';

	}



	if($pageshow==0) { $begin = $pageshow; } else { $begin = $pageshow - 1; }

	$start = $begin * $per_page;

	if(!$start)

	$start=0; 

	

	/*echo $query." ORDER BY $orderfield $orderby LIMIT $start, $per_page";

	echo "<br>";

	echo $query." ORDER BY t1.add_date DESC LIMIT $start, $per_page";*/

	

	if($orderfield !="") { $result = $db->query($query." ORDER BY $orderfield $orderby LIMIT $start, $per_page"); }

//	else { $result = $db->query($query." ORDER BY add_date ASC  "); }

	 else { $result = $db->query($query." ORDER BY add_date DESC LIMIT $start, $per_page"); }

	 $tot = $result->num_rows;

	/* URL For Dynamic Order by and pagination*/

	if($orderfield !="") 

	{ 

		$urltoshow = "employer-list.php?page=gclt&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.'&search='.$search_txt;

		$urltosearch = "employer-list.php?page=gclt&PageNo=1&field=".$orderfield."&order=".$orderby;

		$urltopage = "employer-list.php?page=gclt&field=".$orderfield."&order=".$orderby.'&search='.$search_txt;

	 }

	else 

	{ 

		$urltoshow = "employer-list.php?page=gclt&PageNo=".$pagenum.'&search='.$search_txt; 

		$urltosearch = "employer-list.php?page=gclt&PageNo=1"; 

		$urltopage = "employer-list.php?page=gclt&search=".$search_txt; 

	}

	

	$_SESSION["Viewrcturl"] = $urltoshow;

	

	/* Sort Code */

	if($orderby != "" && $orderby == "ASC")

	{

		$show_firmid = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=id&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">ID</a>';

		$show_title = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=firstname&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Name</a>';	

		$show_email = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=email&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Email</a>';	

		$show_mobile = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=mobile&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Mobile</a>';
		
		$show_company = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=company&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Company</a>';
		
		$show_website = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=website&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">website</a>';
		
		$show_jobstatus = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=jobstatus&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Job Status</a>';		

		$show_add_date = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=add_date&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Register Date</a>';

		$show_status = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=status&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Status</a>';
		
		$show_validate = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=validate&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Validate</a>';
		
		$show_featured = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=featured&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Featured</a>';
         
		
		
	}

	else

	{

		$show_firmid = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=id&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">ID</a>';

		$show_title = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=firstname&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Name</a>';	

		$show_email = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=email&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Email</a>';	

		$show_mobile = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=mobile&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Mobile</a>';
		
		$show_company = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=company&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Company</a>';
		
		$show_website = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=website&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Website</a>';
		
		$show_jobstatus = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=jobstatus&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Job Status</a>';		

		$show_add_date = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=add_date&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Register Date</a>';

		$show_status = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=status&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Status</a>';
		
		$show_validate = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=validate&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Validate</a>';
		
		$show_featured = '<a href="employer-list.php?page=gclt&PageNo='.$pagenum.'&field=featured&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Featured</a>';
        		
	}

	/* Sort Code */



?>



        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->

            <?php include('sidebar.php'); ?>



            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        Employer List

                        <small>Front-End Employer List</small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li class="active">Employer List</li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                    <div class="row">

                        <div class="col-xs-12"><!-- /.box -->

                        	<?php if(!empty($msg)) { ?>

                              <div id="gt-formsuccess">                                

                                  <?php echo $msg; ?>

                              </div>

                              <?php } ?>

                            <form action="" method="get" name="form4" id="form4">

                            <div class="box"><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                	<?php if($foundnum>0) { echo '<div class="rws-messageshow">'.$foundnum.' '.trim($_GET["search_txt"]).'  Employers Found!</div>'; } ?>

                                	<div class="row" style="padding-bottom:10px; padding-top:5px;">

                                    	<div class="col-xs-6">
										<button type="submit"  id="empactivate" class="btn btn-primary" >Activate</button>
		        	<button type="submit"  id="deactivate" class="btn btn-primary" >Dectivate</button>
<!--
                                        <button class="btn btn-primary" type="button" name="rws-addbtn" onclick="document.location.href='college-add.php'"> Add New </button> &nbsp;-->

								<?php if($foundnum>0) { ?>

                          <!--      <button class="btn btn-primary" type="button" name="delete" id="delete" onclick="javascript:deleteRecord();" > Delete </button> &nbsp;	

                                <button class="btn btn-primary" type="button" name="active" id="active" onclick="javascript:activeRecord();" > Active </button> &nbsp;

                                <button class="btn btn-primary" type="button" name="inactive" id="inactive" onclick="javascript:inactiveRecord();" > Inactive </button> &nbsp;		
                                <button class="btn btn-primary" type="button" name="featured" id="featured" onclick="javascript:featuredRecord();" > Featured </button> &nbsp;		
                                <button class="btn btn-primary" type="button" name="removefeatured" id="removefeatured" onclick="javascript:unfeaturedRecord();" > Remove Featured </button> &nbsp;			 -->				                                

                                <input type="hidden" name="page" id="page" value="<?php echo $_GET["page"]; ?>"/>

                                <input type="hidden" name="action" id="action" value="search"/>

                                <input type="hidden" name="PageNo" value="<?php echo $_GET["PageNo"]; ?>"/>

                                <input type="hidden" name="field" value="<?php echo $_GET["field"]; ?>"/>

                                <input type="hidden" name="order" value="<?php echo $_GET["order"]; ?>"/>

                                <?php } ?>

                                        </div>

                                    

                                        <div class="col-xs-6" >

                                           <div id="dataTables_filter"  class="dataTables_filter">

                                           		<label>Search: <input class="form-control" type="text" name="search_txt" id="search_txt" value="<?php echo trim($_GET["search_txt"]);?>" style="max-width:260px; display:inline-block; margin:0 10px;" /> <button class="btn btn-primary" type="submit" name="rws-submit"> Search </button></label>

                                           </div>

                                        </div>

                                    </div>
                                    
  <!--              <div class="gtstatitics">
                <p>Employer Registered Within</p>
                <p>7 Days [<strong><?php echo togetemployersdata("-7 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                30 Days [<strong><?php echo togetemployersdata("-30 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                6 Months [<strong><?php echo togetemployersdata("-180 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                12 Months [<strong><?php echo togetemployersdata("-365 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                All [<strong><?php echo togetemployersdata("All", $condition="");?></strong>]</p>                
                </div>              -->

                                    <?php if($foundnum>0) { ?>

                                    <table id="example2" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                                <th width="10" style="color:#3c8dbc;"><input name="chkSelectAll" type="checkbox" id="chkSelectAll" value="checkbox" onclick="javascript:selectAllChk();" />Sr.No</th>

                                                <th><?php echo $show_firmid; ?></th>

                                                <th><?php echo $show_title; ?></th>

                                                <th><?php echo $show_email; ?></th>                                                

                                                <th><?php echo $show_mobile; ?></th>

                                                <th><?php echo $show_company; ?></th>

                                                <th><?php echo $show_website; ?></th>

                                                <th><?php echo $show_add_date; ?></th>

                                                <th><?php echo $show_status; ?></th>
                                                
                                        <!--        <th><?php echo $show_featured; ?></th>
                                                
                                                <th><?php echo $show_validate; ?></th>     -->

												<th style="color:#3c8dbc;">Action</th>
												
                                            </tr>

                                        </thead>

                                        <tbody>

                                        <?php  

										$rowlist = $result->rows;

										

										$j=1; foreach($rowlist as $key => $row) { 

											if($row["status"]=='0') 

											{ 

												$status = '<span style="color:#665252; font-weight:bold;">Inactive</span>'; 

												$status_cls = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 

											} 

											else 

											{ 

												$status = '<span style="color:#556652; font-weight:bold;">Active</span>'; 

												$status_cls = 'style="border:1px solid #9adf8f; background: #d5ffce;"';

											}
											
											if($row["validate"]=='0') 

											{ 

												$status1 = '<span style="color:#665252; font-weight:bold;">Not Validated</span>'; 

												$status_cls1 = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 

											} 

											else 

											{ 

												$status1 = '<span style="color:#556652; font-weight:bold;">Validated</span>'; 

												$status_cls1 = 'style="border:1px solid #9adf8f; background: #d5ffce;"';

											}
											
											if($row["featured"]=='0') 
											{
												$status2 = '<span style="color:#665252; font-weight:bold;">Not Featured</span>'; 
												$status_cls2 = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 
											} 
											else 
											{ 
												$status2 = '<span style="color:#556652; font-weight:bold;">Featured</span>';
												$status_cls2 = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
											}

										 ?>

                                            <tr>

                                          <!--      <td><input name="chkid[<? echo $j; ?>]" type="checkbox" id="chkid[<? echo $j; ?>]" value="<? echo $row['id']; ?>" /></td>  -->

										        <td><input type="checkbox" class="checkBoxClass" id="id_<?php echo $row['id'];?>" /> <?php echo $j; ?> </td>

                                                <td><?php echo $row["id"]; ?></td>

                                                <td><?php echo ucwords(strtolower($row["firstname"])).' '. ucfirst(strtolower($row["lastname"])); ?></td>

                                                <td><?php echo $row["email"]; ?></td>

                                                <td><?php echo $row["mobile"]; ?></td>
                                                
                                                <td><?php echo $row["company"]; ?></td>											

												<td><a href='<?php echo $row["website"]; ?>' target='_blank'><?php echo $row["website"]; ?></a></td>

                                                <td><?php echo toshowdatewithtime($row["add_date"]); ?></td>

                                                <td <?php echo $status_cls; ?>><?php echo $status; ?></td>
                                       <!--         <td <?php echo $status_cls2; ?>><?php echo $status2; ?></td>
                                                <td <?php echo $status_cls1; ?>><?php echo $status1; ?></td>     -->

                                                <td><a href="employer-details.php?fid=<?php echo $row["id"]; ?>">View Details</a></td>

                                            </tr> 

                                         <?php  $j++; } ?>                                              

                                        </tbody>

                                  <!--      <tfoot>

                                            <tr>

                                                <th>#</th>

                                                <th><?php echo $show_firmid; ?></th>

                                                <th><?php echo $show_title; ?></th>

                                                <th><?php echo $show_email; ?></th>                                                

                                                <th><?php echo $show_mobile; ?></th>

                                                <th><?php echo $show_company; ?></th>

                                                <th><?php echo $show_website; ?></th>

                                                <th><?php echo $show_add_date; ?></th>

                                                <th><?php echo $show_status; ?></th>
                                                
                                                <th><?php echo $show_featured; ?></th>
                                                
                                                <th><?php echo $show_validate; ?></th>

                                                <th>Action</th>

                                            </tr>

                                        </tfoot>

                                    -->

                                    </table>

                                    <?php } ?>            
									
			<br>	

                                    <div class="row"  style="padding-top:10px; padding-bottom:10px;">

                                    	<div class="col-xs-6">

                                        	<div class="dataTables_info" id="example1_info">

												<?php if($tot==5) { echo 'Showing  '.($start+1).' to '.($start+$per_page).' of '.$foundnum.' entries'; }
												else if($tot<5) { echo 'Showing  '.($start+1).' to '.$foundnum.' of '.$foundnum.' entries'; }
												else { echo '<strong style="color:#FF0000;">There is no employer registered yet.</strong>'; }?>

                                            </div>
											
                                        </div>

                                    	<div class="col-xs-6">

                                        	<div class="dataTables_paginate paging_bootstrap">

                                            	<?php echo generate_pagination_new($urltopage, $max_pages, $pagenum, $foundnum, $per_page, $pageshow, $start); ?>

                                            </div>

                                        </div>

                                    </div><!-- /.Pagination Ends -->

                              </div><!-- /.box-body -->

                          </div><!-- /.box -->

                          </form>

                      </div>

                    </div>



                </section><!-- /.content -->

              

              <footer>

              		<?php include('footer-copyright.php'); ?>

              </footer>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>


<script>

    //----for activate all emp -----------//

$('#empactivate').click(function(){
var post_arr = [];

// Get checked checkboxes

$('#example2 input[type=checkbox]').each(function() {

  if (jQuery(this).is(":checked")) {

    var id = this.id;

    var splitid = id.split('_');

    var postid = splitid[1];

     var action = "activeall";

    post_arr.push(postid,action);

   

  }

});

if(post_arr.length > 0){

    var action = "empactiveall";

    var isactivate = confirm("Do you really want to activate records?");

    if (isactivate == true) {

       // AJAX Request

       $.ajax({

          url: 'candidate_approve_ajax.php',

          type: 'POST',

          data: { post_id:post_arr,action:action},

          success: function(data){



              location.reload(true);     

              //   alert(data);



          }

       });

    } 

} 

});

</script>

<script>

    //----for deactivate all emp -----------//

$('#deactivate').click(function(){
var post_arr = [];

// Get checked checkboxes

$('#example2 input[type=checkbox]').each(function() {

  if (jQuery(this).is(":checked")) {

    var id = this.id;

    var splitid = id.split('_');

    var postid = splitid[1];

    // var action = "activeall";

    post_arr.push(postid,action);

   

  }

});

if(post_arr.length > 0){

    var action = "deactiveall";

    var isactivate = confirm("Do you really want to deactive records?");

    if (isactivate == true) {

       // AJAX Request

       $.ajax({

          url: 'candidate_approve_ajax.php',

          type: 'POST',

          data: { post_id:post_arr,action:action},

          success: function(data){



              location.reload(true);     

              //   alert(data);



          }

       });

    } 

} 

});

</script>