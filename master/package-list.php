<?php include('header.php'); $gtpage = 'package-list'; $listjs = 1;  checkadminroles('package');



if(isset($_REQUEST["action"]))
{
	$action=$_REQUEST["action"];
	$chkid="'".implode("','",$_GET["chkid"])."'";
	$chkidid=$_GET["chkid"];
	switch($action)
	{
		case "Inactive":
			$sql="UPDATE `ss_services_package` SET `status`='0' WHERE `services_package_id` in ($chkid)";
			$db->query($sql);			
			$msg='Status has been updated successfully to Pending!';
			$class='successmsg';
		break;

		case "Active":
			$sql="UPDATE `ss_services_package` SET `status`='1'  WHERE `services_package_id` in ($chkid)";
			$db->query($sql);			
			$msg='Status has been updated successfully to Accepted!';
			$class='successmsg';	
		break;		

		case "Delete":
			$sql="DELETE FROM `ss_services_package` WHERE `services_package_id` in ($chkid)";
			$db->query($sql);

			$msg='Records has been deleted successfully!';
			$class='successmsg';

		break;

	}

}

$rwscid=$_GET["rwscid"];
foreach($rwscid as $key => $val)
{
	$sql="UPDATE `ss_services_package` SET `sort_order`='".$_GET["rwsorder".$val]."'  WHERE `services_package_id` ='$val'";
	$db->query($sql);
	
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
			$nquery = " AND (t1.package_subtitle LIKE '%$search_txt%' OR t1.package_id LIKE '%$search_txt%' OR t3.name LIKE '%$search_txt%') ";
		else
			$nquery = " AND (t1.package_subtitle LIKE '%$search_txt%' OR t1.package_id LIKE '%$search_txt%' OR t3.name LIKE '%$search_txt%') ";
		}
	}

	$query="SELECT t1.*, t3.name as service_name FROM ss_services_package as t1 INNER JOIN ss_services as t3 ON t1.service_id=t3.service_id WHERE t1.services_package_id > 0 ".$nquery;

	$rs = $db->query($query);

	$foundnum = $rs->num_rows;
	$per_page = 40;

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
	echo $query." ORDER BY t1.date_added DESC LIMIT $start, $per_page";*/	

	if($orderfield !="") { $result = $db->query($query." ORDER BY $orderfield $orderby LIMIT $start, $per_page"); }
	else { $result = $db->query($query." ORDER BY package_id ASC LIMIT $start, $per_page"); }

	/* URL For Dynamic Order by and pagination*/
	if($orderfield !="") 
	{ 
		$urltoshow = "package-list.php?page=gclt&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.'&search='.$search_txt;
		$urltosearch = "package-list.php?page=gclt&PageNo=1&field=".$orderfield."&order=".$orderby;
		$urltopage = "package-list.php?page=gclt&field=".$orderfield."&order=".$orderby.'&search='.$search_txt;
	 }
	else 
	{ 
		$urltoshow = "package-list.php?page=gclt&PageNo=".$pagenum.'&search='.$search_txt; 
		$urltosearch = "package-list.php?page=gclt&PageNo=1"; 
		$urltopage = "package-list.php?page=gclt&search=".$search_txt; 
	}	

	$_SESSION["Viewrcturl"] = $urltoshow;
	/* Sort Code */

	if($orderby != "" && $orderby == "ASC")
	{
		$show_firmid = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_id&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">ID</a>';
		$show_title = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_subtitle&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Bus Name</a>';	
		$show_name = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_id&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Package Name</a>';		
		$show_price = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_price&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Selling Price(in Rs.)</a>';		
		$show_duration = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=duration&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Duration(in Days)</a>';		
		$show_total_hours = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=total_hours&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Total Hours</a>';
		$show_hourly_cost = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=hourly_cost&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Hourly Cost</a>';
		$show_discounted_hourly_cost = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=discounted_hourly_cost&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Discounted Hourly Cost</a>';		
		$show_status = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=status&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Status</a>';
		$show_date_added = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=date_added&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Add Date</a>';
		
		$show_servicename = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=service_name&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Service Name</a>';
		
		$show_seat = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=total_seat&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Total Seats</a>';
		$show_from = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=service_name&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Product Name</a>';
		$show_to = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=to&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Destination</a>';
		$show_stoppage = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=stoppage&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Stoppage</a>';
		$show_start_time = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=start_time&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Departure Time</a>';
		$show_end_time = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_mrp&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">MRP (in Rs.)</a>';
		$show_featured = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=featured&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Featured Bus</a>';		

	}
	else
	{
		$show_firmid = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_id&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">ID</a>';
		$show_title = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_subtitle&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Bus Name</a>';	
		$show_name = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_id&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Package Name</a>';		
		$show_price = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_price&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Selling Price(in Rs.)</a>';		
		$show_duration = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=duration&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Duration(in Days)</a>';		
		$show_total_hours = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=total_hours&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Total Hours</a>';
		$show_hourly_cost = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=hourly_cost&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Hourly Cost</a>';
		$show_discounted_hourly_cost = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=discounted_hourly_cost&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Discounted Hourly Cost</a>';		
		$show_status = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=status&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Status</a>';
		$show_date_added = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=date_added&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Add Date</a>';
		
		$show_servicename = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=service_name&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Service Name</a>';
		
		$show_seat = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=total_seat&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Total Seats</a>';
		$show_from = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=service_name&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Product Name</a>';
		$show_to = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=to&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Destination</a>';
		$show_stoppage = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=stoppage&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Stoppage</a>';
		$show_start_time = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=start_time&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Departure Time</a>';
		$show_end_time = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=package_mrp&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">MRP (in Rs.)</a>';
		$show_featured = '<a href="package-list.php?page=gclt&PageNo='.$pagenum.'&field=featured&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Featured Bus</a>';	
		
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
                        Category Product and Price Details
                        <small>Front-End Category Product and Price Details</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Category Product and Price Details</li>
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
                                	<?php if($foundnum>0) { echo '<div class="rws-messageshow">'.$foundnum.' '.trim($_GET["search_txt"]).'  results found!</div>'; } ?>
                                	<div class="row" style="padding-bottom:10px; padding-top:5px;">
                                    	<div class="col-xs-6">
                                        <button class="btn btn-primary" type="button" name="rws-addbtn" onclick="document.location.href='package-add.php'"> Add New </button> &nbsp;
								<?php if($foundnum>0) { ?>
                                <button class="btn btn-primary" type="button" name="delete" id="delete" onclick="javascript:deleteRecord();" > Delete </button> &nbsp;	
                                <button class="btn btn-primary" type="button" name="active" id="active" onclick="javascript:activeRecord();" > Active </button> &nbsp;
                                <button class="btn btn-primary" type="button" name="inactive" id="inactive" onclick="javascript:inactiveRecord();" > Inactive </button> &nbsp;							                                
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

                                    <?php if($foundnum>0) { ?>

                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                                <th width="10"><input name="chkSelectAll" type="checkbox" id="chkSelectAll" value="checkbox" onclick="javascript:selectAllChk();" /></th>
                                                <th><?php echo $show_firmid; ?></th>
                                                <th><?php echo $show_title; ?></th> 
                                                <th><?php echo $show_from; ?></th>                                                 
                                                <th><?php echo $show_end_time; ?></th>
                                                <th><?php echo $show_price; ?></th>  
                                                <th><?php echo $show_status; ?></th>                                              
                                                <th><?php echo $show_date_added; ?></th>
                                                <th>Sort Order <button class="btn btn-primary" type="submit" name="rws-submit2"> Update </button></th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                        <?php  

										$rowlist = $result->rows;
										$j=1; foreach($rowlist as $key => $row) { 

											if($row["status"]=='0') 
											{ 
												$status = '<span style="color:#665252; font-weight:bold;">Unpublished</span>'; 
												$status_cls = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 
											} 
											else 
											{
												$status = '<span style="color:#556652; font-weight:bold;">Published</span>'; 
												$status_cls = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
											}
											
											if($row["featured"]=='0') 
											{ 
												$status_2 = '<span style="color:#665252; font-weight:bold;">No</span>'; 
												$status_cls_2 = 'style="border:1px solid #df8f8f; background: #ffcece;"'; 
											} 
											else 
											{
												$status_2 = '<span style="color:#556652; font-weight:bold;">Yes</span>'; 
												$status_cls_2 = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
											}

										 ?>

                                            <tr>
                                                <td><input name="chkid[<? echo $j; ?>]" type="checkbox" id="chkid[<? echo $j; ?>]" value="<? echo $row['services_package_id']; ?>" /></td>
                                                <td><?php echo $row["services_package_id"]; ?></td>
                                                <td><?php echo $row["package_subtitle"]; ?></td>
                                                <td><?php echo $row["service_name"]; ?></td>                                                
                                                <td><?php echo $row["package_mrp"]; ?></td>
                                                <td><?php echo $row["package_price"]; ?></td>
                                                <td <?php echo $status_cls; ?>><?php echo $status; ?></td>
                                                <td><?php echo toshowdatewithtime($row["date_added"]); ?></td>
                                                <td><input name="rwsorder<? echo $row['services_package_id']; ?>" type="text" value="<?php echo $row["sort_order"]; ?>"><input name="rwscid[]" type="hidden" value="<? echo $row['services_package_id']; ?>"></td>
                                                <td><a href="package-add.php?fid=<?php echo $row["services_package_id"]; ?>">Edit</a></td>
                                            </tr> 
                                         <?php  $j++; } ?>  
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $show_firmid; ?></th>
                                                <th><?php echo $show_title; ?></th> 
                                                <th><?php echo $show_from; ?></th>                                                 
                                                <th><?php echo $show_end_time; ?></th>
                                                <th><?php echo $show_price; ?></th>  
                                                <th><?php echo $show_status; ?></th>                                              
                                                <th><?php echo $show_date_added; ?></th>
                                                <th>&nbsp;</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php } ?>                            

                                    <div class="row"  style="padding-top:10px; padding-bottom:10px;">

                                    	<div class="col-xs-6">

                                        	<div class="dataTables_info" id="example1_info">

												<?php if($foundnum>0) { echo 'Showing  '.($start+1).' to '.($start+$per_page).' of '.$foundnum.' entries'; } else { echo '<strong style="color:#FF0000;">There is no Bus added yet.</strong>'; }?>

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