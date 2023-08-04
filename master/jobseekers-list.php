<style>
	.jsclass{
		margin:10px 10px;
	}

</style>


<?php include('header.php'); $gtpage = 'jobseekers-list'; $listjs = 1; 



if(isset($_REQUEST["action"]))

{

	$action=$_REQUEST["action"];

	$chkid="'".implode("','",$_GET["chkid"])."'";

	$chkidid=$_GET["chkid"];

	

	switch($action)

	{

		case "Inactive":

			$sql="UPDATE `ss_jobseekers` SET `status`='0' WHERE `id` in ($chkid)";

			$db->query($sql);			

			$msg='Status has been updated successfully to Pending!';

			$class='successmsg';

		break;

		case "Active":

			$sql="UPDATE `ss_jobseekers` SET `status`='1'  WHERE `id` in ($chkid)";

			$db->query($sql);			

			$msg='Status has been updated successfully to Accepted!';

			$class='successmsg';					

		break;

		

		case "Delete":

			// CODE to delete associated branch to college

			$sql="delete from `branch` where `js_id` in ($chkid)";

			$db->query($sql);

			// CODE to delete associated course to college

			$sql="delete from `course` where `js_id` in ($chkid)";

			$db->query($sql);

			

			$sql="delete from `ss_jobseekers` where `id` in ($chkid)";

			$db->query($sql);

			$msg='Records has been deleted successfully!';

			$class='successmsg';

		break;

	}

}

/* ----- Action Code Ends HERE ----- */







	$orderfield = $_GET["field"];

	$orderby = $_GET["order"];



/*	$search_txt = trim($_GET["search_txt"]);

	$search_rank = $_GET["search_rank"];

	$search_name = $_GET["search_name"];

	$search_email = $_GET["search_email"];

	$search_mob   = $_GET["search_mob"];

	$search_loc   = $_GET["search_loc"];


	*/

/*
	if($search_txt !="")

	{
		//echo "hiiii";

		$search_exploded = explode (" ", $search_txt);

		foreach($search_exploded as $search_txt){

		$x++;

		if($x==1)

			$nquery .= " AND (firstname LIKE '%$search_txt%' OR lastname LIKE '%$search_txt%' OR email LIKE '%$search_txt%' OR mobile LIKE '%$search_txt%' OR location LIKE '%$search_txt%' OR professional_headline LIKE '%$search_txt%' OR additional_skills LIKE '%$search_txt%' OR jobstatus LIKE '%$search_txt%') ";

		else

			$nquery .= " AND (firstname LIKE '%$search_txt%' OR lastname LIKE '%$search_txt%' OR email LIKE '%$search_txt%' OR mobile LIKE '%$search_txt%' OR location LIKE '%$search_txt%' OR professional_headline LIKE '%$search_txt%' OR additional_skills LIKE '%$search_txt%' OR jobstatus LIKE '%$search_txt%') ";

		}			

	}     */




/*
	if( $search_rank !=""){
 
	

		$nquery .= " AND (rankname LIKE '%$search_rank%') ";

	}

	if( $search_name !=""){
 
		$nquery .= " OR (firstname LIKE '%$search_name%' ) ";

	}    

	if( $search_email !=""){
 
		$nquery .= " OR (email LIKE '%$search_email%') ";
	}  

	
	if( $search_mob !=""){
 
		$nquery .= " OR (mobile LIKE '%$search_mob%') ";
	}  

	
	if( $search_loc !=""){
 
		$nquery .= " OR (location LIKE '%$search_loc%') ";
	}  
*/


if(isset($_GET['search_rank']) || isset($_GET['search_name']) || isset($_GET['search_email']) || isset($_GET['search_mob']) || 
   isset($_GET['search_loc']) ){

	$search_txt = trim($_GET["search_txt"]);

	$search_rank = $_GET["search_rank"];

	$search_name = $_GET["search_name"];

	$search_email = $_GET["search_email"];

	$search_mob   = $_GET["search_mob"];

	$search_loc   = $_GET["search_loc"];
	
	// $query="SELECT * FROM ss_jobseekers WHERE id > 0 ".$nquery;

	$query="SELECT * FROM ss_jobseekers WHERE id > 0 AND rankname Like '%".$search_rank."%' AND fullname Like '%".$search_name."%'
	 AND email Like '%".$search_email."%' AND mobile Like '%".$search_mob."%'  AND location Like '%".$search_loc."%' ";


	}else{

		$query="SELECT * FROM ss_jobseekers WHERE id > 0 ";

	}

	$rs = $db->query($query);	

	$foundnum = $rs->num_rows;

	

	$per_page = 10;

	

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

	else { $result = $db->query($query." ORDER BY add_date DESC LIMIT $start, $per_page"); }
 

	$tot = $result->num_rows;


	/* URL For Dynamic Order by and pagination*/

	if($orderfield !="") 

	{ 

		$urltoshow = "jobseekers-list.php?page=gclt&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.'&search='.$search_txt;

		$urltosearch = "jobseekers-list.php?page=gclt&PageNo=1&field=".$orderfield."&order=".$orderby;

		$urltopage = "jobseekers-list.php?page=gclt&field=".$orderfield."&order=".$orderby.'&search='.$search_txt;

	 }

	else 

	{ 

		$urltoshow = "jobseekers-list.php?page=gclt&PageNo=".$pagenum.'&search='.$search_txt; 

		$urltosearch = "jobseekers-list.php?page=gclt&PageNo=1"; 

		$urltopage = "jobseekers-list.php?page=gclt&search=".$search_txt; 

	}

	

	$_SESSION["Viewrcturl"] = $urltoshow;

	

	/* Sort Code */

	if($orderby != "" && $orderby == "ASC")

	{

		$show_firmid = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=id&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">ID</a>';

		$show_title = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=firstname&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Name</a>';	

		$show_email = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=email&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Email</a>';	

		$show_mobile = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=mobile&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Mobile</a>';
		
		$show_location = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=location&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Location</a>';
		
		$show_phead = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=professional_headline&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Rank</a>';
		
		$show_jobstatus = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=jobstatus&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Job Status</a>';		

		$show_add_date = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=add_date&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Register Date</a>';

		$show_status = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=status&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Admin Approval</a>';
		
		$show_validate = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=validate&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">Validate</a>';

		$show_viewcv = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=validate&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">View CV</a>';
		
	}

	else

	{

		$show_firmid = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=id&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">ID</a>';

		$show_title = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=firstname&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Name</a>';	

		$show_email = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=email&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Email</a>';	

		$show_mobile = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=mobile&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Mobile</a>';
		
		$show_location = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=location&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Location</a>';
		
		$show_phead = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=professional_headline&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Rank</a>';
		
		$show_jobstatus = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=jobstatus&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Job Status</a>';		

		$show_add_date = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=add_date&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Register Date</a>';

		$show_status = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=status&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Admin Approval</a>';
		
		$show_validate = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=validate&order=ASC&search='.$search_txt.'" title="Click to Sort in desending order.">Validate</a>';

		$show_viewcv = '<a href="jobseekers-list.php?page=gclt&PageNo='.$pagenum.'&field=validate&order=DESC&search='.$search_txt.'" title="Click to Sort in desending order.">View CV</a>';
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

                        Jobseekers List

                        <small>Front-End Jobseekers List</small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li class="active">Jobseekers List</li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                    <div class="row">

                        <div class="col-xs-12"><!-- /.box -->

			
        <!-----------------load model------------------------------------------------->
        <style>
        @media (min-width: 768px){
        .modal-dialog {
        width: 60%;
        margin: 30px auto;
        }
        }
        </style>
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                <div class="modal-dialog" style="width: 60%; margin:30px auto;"  role="document">

                <div class="modal-content">

                    <div class="modal-header">

                    <!-- <h5 class="modal-title" id="exampleModalLongTitle" align="center" style="font-size: 30px;">RESUME</h5> -->

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    </div>

                    <div class="modal-body">

                    

                    </div>

                    <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    

                    </div>

                </div>

                </div>

                </div>
             <!-------------------end model---------------------------------------------->


                        	<?php if(!empty($msg)) { ?>

                              <div id="gt-formsuccess">                                

                                  <?php echo $msg; ?>

                              </div>

                              <?php } ?>

                            <form action="" method="get" name="form4" id="form4">

                            <div class="box"><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                	<?php if($foundnum>0) { echo '<div class="rws-messageshow">'.$foundnum.' '.trim($_GET["search_txt"]).'  Jobseekers Found!</div>'; } 
									     		
									?>

                                	<div class="row" style="padding-bottom:10px; padding-top:5px;">

                                    	<div class="col-xs-6">
<!--
                                        <button class="btn btn-primary" type="button" name="rws-addbtn" onclick="document.location.href='college-add.php'"> Add New </button> &nbsp;-->

								<?php if($foundnum>0) { ?>

                        <!--        <button class="btn btn-primary" type="button" name="delete" id="delete" onclick="javascript:deleteRecord();" > Delete </button> &nbsp;	

                                <button class="btn btn-primary" type="button" name="active" id="active" onclick="javascript:activeRecord();" > Active </button> &nbsp;

                                <button class="btn btn-primary" type="button" name="inactive" id="inactive" onclick="javascript:inactiveRecord();" > Inactive </button> &nbsp;			 -->				                                

                                <input type="hidden" name="page" id="page" value="<?php echo $_GET["page"]; ?>"/>

                                <input type="hidden" name="action" id="action" value="search"/>

                                <input type="hidden" name="PageNo" value="<?php echo $_GET["PageNo"]; ?>"/>

                                <input type="hidden" name="field" value="<?php echo $_GET["field"]; ?>"/>

                                <input type="hidden" name="order" value="<?php echo $_GET["order"]; ?>"/>

                                <?php } ?>

                                        </div>

                                    

                                        <div class="col-xs-12" >

                                           <div id="dataTables_filter"  class="dataTables_filter">

                                           		Search: <!--<input class="form-control" type="text" name="search_txt" id="search_txt" placeholder="search by name" value="<?php echo trim($_GET["search_txt"]);?>" style="max-width:260px; display:inline-block; margin:0 10px;" /> 	-->

											<input class="form-control jsclass" type="text" name="search_name" id="search_name" placeholder="search by name" value="<?php echo $_GET["search_txt"];?>" style="max-width:260px; display:inline-block; margin:0 10px;" /> 

											 <input class="form-control jsclass" type="text" name="search_email" id="search_email" value="<?php echo $_GET["search_email"];?>" placeholder="search by email" style="max-width:260px; display:inline-block; margin:0 10px;" /> 

											 <input class="form-control jsclass" type="text" name="search_mob" id="search_mob" value="<?php echo $_GET["search_mob"];?>" placeholder="search by mobile" style="max-width:260px; display:inline-block; margin:0 10px;" /> 

											 <input class="form-control jsclass" type="text" name="search_loc" id="search_loc" value="<?php echo $_GET["search_loc"];?>" placeholder="search by location" style="max-width:260px; display:inline-block; margin:0 10px;" /> 

										    <select  name="search_rank" class="jsclass" id="search_rank" style='padding:7px 7px;width:15%;'>

														<option value="">Select Rank</option>

														<?php
									
														$rank = $db->query("select * from ss_rank ");
                                                        $list1 = $rank->rows;    
														  
														foreach($list1 as $key => $row)   
														

																{

															echo '<option value="'.$row['rankname'].'">'. $row['rankname'].'</option>';

															    }        

														?> 

													</select>   
									    
												&nbsp;&nbsp;&nbsp;	<button class="btn btn-primary" type="submit" name="rws-submit"> Search </button>

                                           </div>

                                        </div>

                                    </div>
                                 <br>   
         <!--       <div class="gtstatitics">
                <p>Candidate Registered Within</p>
                <p>7 Days [<strong><?php echo togetjobseekersdata("-7 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                30 Days [<strong><?php echo togetjobseekersdata("-30 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                6 Months [<strong><?php echo togetjobseekersdata("-180 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                12 Months [<strong><?php echo togetjobseekersdata("-365 day", $condition="");?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                All [<strong><?php echo togetjobseekersdata("All", $condition="");?></strong>]</p>
                <p>Candidate register with job alert [<?php echo togetjobseekersdata("", $condition=" `subscribe`='1' ");?>]</p>
                </div>   -->

                                    <?php if($foundnum>0) { ?>

                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                                <th width="10" style="color:#3c8dbc;"><input name="chkSelectAll" type="checkbox" id="chkSelectAll" value="checkbox" onclick="javascript:selectAllChk();" />Sr.No</th>

                                                <th><?php echo $show_firmid; ?></th>

                                                <th><?php echo $show_title; ?></th>

                                                <th><?php echo $show_email; ?></th>                                                

                                                <th><?php echo $show_mobile; ?></th>

                                                <th><?php echo $show_location; ?></th>

                                                <th><?php echo $show_phead; ?></th>
                                                
                                       <!--         <th><?php echo $show_jobstatus; ?></th>    -->

                                                <th><?php echo $show_add_date; ?></th>

                                         <th><?php echo $show_status; ?></th>  
                                                
                                          <!--    <th><?php echo $show_validate; ?></th>   -->

										  <th><?php echo $show_viewcv; ?></th>



                               <!--         <th>Action</th>       -->

                                            </tr>

                                        </thead>

                                        <tbody>

                                        <?php  

										$rowlist = $result->rows;

										

										$j=1; foreach($rowlist as $key => $row) { 

											if($row["admin_approval"]=='0') 

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

										 ?>
										


                                            <tr>

                                                <td><input name="chkid[<? echo $j; ?>]" type="checkbox" id="chkid[<? echo $j; ?>]" value="<? echo $row['id']; ?>" /><?php echo $j; ?></td>

                                                <td><?php echo $row["id"]; ?></td>

                                                <td><?php echo ucwords(strtolower($row["fullname"])); ?>&nbsp;&nbsp;
												<?php 
												if($row['country']!='')
												{
													?>
													<img src="../images/country/<?php echo $row['country']  ?>.png" alt="" width="25" style="float: right;">
													<?php
												}
												?>
											
											</td>

                                                <td><?php echo $row["email"]; ?></td>

                                                <td><?php echo $row["mobile"]; ?></td>
                                                
                                                <td><?php echo ucwords(strtolower($row["location"])); ?></td>

                                                <td><?php echo $row["rankname"]; ?></td>
											

                                           <!--     <td><?php echo $row["jobstatus"]; ?></td>  -->

                                                <td><?php echo toshowdatewithtime($row["add_date"]); ?></td>

                                                 <td <?php echo $status_cls; ?>><?php echo $status; ?></td>   
                                         <!--       <td <?php echo $status_cls1; ?>><?php echo $status1; ?></td>   -->
 
                                         

										 
							<?php

								if($row['resume']=="")

								{

								echo "<td> <span class='fa fa-eye viewshipcv' title='Click Here To View Full CV' id='".$row['id']."' style='cursor:pointer;color: #3c8dbc;'> </span> NA </td>";

								}else

								{

								echo "<td>

										<span class='fa fa-eye viewshipcv' title='Click Here To View Full CV' id='".$row['id']."' style='cursor:pointer;color: #3c8dbc;'> </span>



										<a href='../".$row['resume']." '  target='_blank' class='uploadcv fa fa-download' data-toggle='tooltip' title='Download Original CV'></a>

									</td>";

								}

							?>

              <!--      <td><a href="jobseekers-details.php?fid=<?php echo $row["id"]; ?>">View Details</a></td>       -->
                                            </tr> 

                                         <?php  $j++; } ?>                                              

                                        </tbody>

                                    <!--    <tfoot>

                                            <tr>

                                                <th>#</th>

                                                <th><?php echo $show_firmid; ?></th>

                                                <th><?php echo $show_title; ?></th>

                                                <th><?php echo $show_email; ?></th>                                                

                                                <th><?php echo $show_mobile; ?></th>

                                                <th><?php echo $show_location; ?></th>

                                                <th><?php echo $show_phead; ?></th>
                                                
                                                <th><?php echo $show_jobstatus; ?></th>

                                                <th><?php echo $show_add_date; ?></th>

                                                <th><?php echo $show_status; ?></th>
                                                
                                                <th><?php echo $show_validate; ?></th>

                                                <th>Action</th>

                                            </tr>

                                        </tfoot>    -->

                                    </table>

                                    <?php } ?>                            

                                    <div class="row"  style="padding-top:10px; padding-bottom:10px;">

                                    	<div class="col-xs-6">

                                        	<div class="dataTables_info" id="example1_info">

												<?php if($tot==10) { echo 'Showing  '.($start+1).' to '.($start+$per_page).' of '.$foundnum.' entries'; } 
												  else if($tot<10) { echo 'Showing  '.($start+1).' to '.$foundnum.' of '.$foundnum.' entries'; }
												  else { echo '<strong style="color:#FF0000;">There is no jobseeker registered yet.</strong>'; }
												
												?>

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

$(document).on('click','.viewshipcv',function(){

	
      $('#exampleModalLong').modal('toggle');

   var id=$(this).attr('id');


 // alert(id);

  $.ajax({

        method:"POST",

        data:{id:id},

        url:"show_thalla_resume11.php",

        success:function(data){

           $('.modal-body').html(data);   
     //   $('.modal-body').html('tanuja');   
      //  alert('tanu');

        }

 });

});
</script>

 
           <!----for loading modal------->
  <script type="text/javascript" src="js/bootstrap.js"></script>  