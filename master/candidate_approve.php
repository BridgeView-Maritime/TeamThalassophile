<?php include('header.php');
$gtpage = 'candidate_approve';
$listjs = 1;

$date=date('Y-m-d');


 

if (isset($_REQUEST["action"])) {

    $action = $_REQUEST["action"];

    $chkid = "'" . implode("','", $_GET["chkid"]) . "'";

    $chkidid = $_GET["chkid"];

    //  echo $chkid;

    switch ($action) {

        case "Active":

            echo "hiiii";

            $sql = "UPDATE `ss_jobseekers` SET `status`='1'  WHERE `id` in ($chkid)";

            echo $sql;
            exit();

            $db->query($sql);

            $msg = 'Status has been updated successfully to Accepted!';

            $class = 'successmsg';

            break;


        case "Inactive":

            $sql = "UPDATE `ss_jobseekers` SET `status`='0' WHERE `id` in ($chkid)";

            $db->query($sql);

            $msg = 'Status has been updated successfully to Pending!';

            $class = 'successmsg';

            break;


        case "Delete":

            // CODE to delete associated branch to college

            $sql = "delete from `branch` where `js_id` in ($chkid)";

            $db->query($sql);

            // CODE to delete associated course to college

            $sql = "delete from `course` where `js_id` in ($chkid)";

            $db->query($sql);



            $sql = "delete from `ss_jobseekers` where `id` in ($chkid)";

            $db->query($sql);

            $msg = 'Records has been deleted successfully!';

            $class = 'successmsg';

            break;
    }
}



/* ----- Action Code Ends HERE ----- */


$orderfield = $_GET["field"];

$orderby = $_GET["order"];



$search_txt = trim($_GET["search_txt"]);
$cv_category = trim($_GET["cv_category"]);

$conditon = "";

// For CV Category
if($cv_category !== ""){
$condition .= " AND cv_category = '".$cv_category."'";
}



if ($search_txt != "") {

    $search_exploded = explode(" ", $search_txt);

    foreach ($search_exploded as $search_txt) {

        $x++;

        if ($x == 1)

            $nquery .= " AND ( fullname LIKE '%$search_txt%' OR email LIKE '%$search_txt%' OR mobile LIKE '%$search_txt%' OR location LIKE '%$search_txt%' OR professional_headline LIKE '%$search_txt%' OR additional_skills LIKE '%$search_txt%' OR jobstatus LIKE '%$search_txt%')";

        else

            $nquery .= " AND (fullname LIKE '%$search_txt%' OR email LIKE '%$search_txt%' OR mobile LIKE '%$search_txt%' OR location LIKE '%$search_txt%' OR professional_headline LIKE '%$search_txt%' OR additional_skills LIKE '%$search_txt%' OR jobstatus LIKE '%$search_txt%') $condition";
    }
}

// if ($cv_category != "") {
    
//         $x++;
//         if ($x == 1){
//             $cvquery = " AND cv_category = '$cv_category'";
//         }
//         else{

//         }
    
// }


//echo $nquery;exit;
// $query="SELECT * FROM ss_jobseekers WHERE id > 0 ".$nquery;

if ($nquery != "") {

    // echo "hiiii";exit;

    
    $query = "SELECT * FROM ss_jobseekers WHERE id > 0 AND admin_approval='0' AND status='1' " . $nquery;

    // echo $query;exit;

} 
// elseif($cvquery != "") {
//     $query = "SELECT * FROM ss_jobseekers WHERE id > 0 AND admin_approval='0' AND status='1' ". $cvquery;
// }

// elseif($nquery != "" & $cvquery != ""){
//     $query = "SELECT * FROM ss_jobseekers WHERE id > 0 AND admin_approval='0' AND status='1' ". $nquery . $cvquery;
// }

else {
    $query = "SELECT * FROM ss_jobseekers WHERE id > 0 AND admin_approval='0' AND status='1' $condition";
   
}


// echo $query;exit;
$rs = $db->query($query);

$foundnum = $rs->num_rows;



$per_page = 20;



$max_pages = ceil($foundnum / $per_page);

$pagenum = trim($_GET['PageNo']);

$max_pages = ceil($foundnum / $per_page);

$pagenum = trim($_GET['PageNo']);

if (is_numeric($pagenum)) {

    if ($pagenum >= $max_pages) {
        $pageshow = $max_pages;
    } elseif ($pagenum < $max_pages && $pagenum > 0) {
        $pageshow = $pagenum;
    } elseif ($pagenum <= 0) {
        $pageshow = '1';
    } else {
        $pageshow = '1';
    }
} else {

    $pageshow = '1';
}



if ($pageshow == 0) {
    $begin = $pageshow;
} else {
    $begin = $pageshow - 1;
}

$start = $begin * $per_page;

if (!$start)

    $start = 0;



/*echo $query." ORDER BY $orderfield $orderby LIMIT $start, $per_page";

	echo "<br>";

	echo $query." ORDER BY t1.add_date DESC LIMIT $start, $per_page";*/



if ($orderfield != "") {
    $result = $db->query($query . " ORDER BY $orderfield $orderby LIMIT $start, $per_page");
} else {
    $result = $db->query($query . " ORDER BY add_date DESC LIMIT $start, $per_page");
}

$tot = $result->num_rows;

/* URL For Dynamic Order by and pagination*/

if ($orderfield != "") {

    $urltoshow = "candidate_approve.php?page=gclt&PageNo=" . $pagenum . "&field=" . $orderfield . "&order=" . $orderby . '&search=' . $search_txt . '&cv_category=' . $cv_category;

    $urltosearch = "candidate_approve.php?page=gclt&PageNo=1&field=" . $orderfield . "&order=" . $orderby;

    $urltopage = "candidate_approve.php?page=gclt&field=" . $orderfield . "&order=" . $orderby . '&search=' . $search_txt . '&cv_category=' . $cv_category;
} else {

    $urltoshow = "candidate_approve.php?page=gclt&PageNo=" . $pagenum . '&search=' . $search_txt . '&cv_category=' . $cv_category;

    $urltosearch = "candidate_approve.php?page=gclt&PageNo=1";

    $urltopage = "candidate_approve.php?page=gclt&search=" . $search_txt . '&cv_category=' . $cv_category;
}



$_SESSION["Viewrcturl"] = $urltoshow;



/* Sort Code */

if ($orderby != "" && $orderby == "DESC") {

    $show_firmid = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=id&order=DESC&search=' . $search_txt . '&cv_category=' . $condition . '" title="Click to Sort in desending order.">ID</a>';

    $show_title = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=firstname&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Name</a>';

    $show_email = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=email&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Email</a>';

    $show_mobile = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=mobile&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Mobile</a>';

    $show_location = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=location&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Location</a>';

    $show_phead = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=professional_headline&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Rank</a>';

    $show_jobstatus = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=jobstatus&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Job Status</a>';

    $show_add_date = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=add_date&order=DESC&search=' . $search_txt . '" title="Click to Sort in desending order.">Register Date</a>';

    $show_status = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=status&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Admin Approvel</a>';

    $show_validate = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=validate&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Validate</a>';

    $show_viewcv = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=validate&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">View CV</a>';
} else {

    $show_firmid = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=id&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">ID</a>';

    $show_title = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=firstname&order=ASC&search=' . $search_txt . '" title="Click to Sort in desending order.">Name</a>';

    $show_email = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=email&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Email</a>';

    $show_mobile = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=mobile&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Mobile</a>';

    $show_location = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=location&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Location</a>';

    $show_phead = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=professional_headline&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Rank</a>';

    $show_jobstatus = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=jobstatus&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Job Status</a>';

    $show_add_date = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=add_date&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Register Date</a>';

    $show_status = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=status&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Admin Approvel</a>';

    $show_validate = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=validate&order=ASC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">Validate</a>';

    $show_viewcv = '<a href="candidate_approve.php?page=gclt&PageNo=' . $pagenum . '&field=validate&order=DESC&search=' . $search_txt . '&cv_category=' . $condition .'" title="Click to Sort in desending order.">View CV</a>';
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

                Candidate Approval

                <small></small>

            </h1>

            <ol class="breadcrumb">

                <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">Candidate Approval</li>

            </ol>

        </section>



        <!-- Main content -->

        <section class="content">

            <div class="row">

                <div class="col-xs-12"><!-- /.box -->


                    <!-----------------load model------------------------------------------------->
                    <style>
                        @media (min-width: 768px) {
                            .modal-dialog {
                                width: 60%;
                                margin: 30px auto;
                            }
                        }
                    </style>
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                        <div class="modal-dialog" style="width: 60%; margin:30px auto;" role="document">

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

                    <?php if (!empty($msg)) { ?>

                        <div id="gt-formsuccess">

                            <?php echo $msg; ?>

                        </div>

                    <?php } ?>

                    <form action="" method="get" name="form4" id="form4">

                        <div class="box"><!-- /.box-header -->

                            <div class="box-body table-responsive">

                                <?php if ($foundnum > 0) {
                                    echo '<div class="rws-messageshow">' . $foundnum . ' ' . trim($_GET["search_txt"]) . '  Candidate Need Approval </div>';
                                } ?>

                                <div class="row" style="padding-bottom:10px; padding-top:5px;">
                                

                                    <div class="col-xs-6">
                                    <?php if ($foundnum > 0) { ?>
                                    <span id="activate" class="btn btn-primary">Activate</span>
                                <?php } ?>
                                        <!--
                                        <button class="btn btn-primary" type="button" name="rws-addbtn" onclick="document.location.href='college-add.php'"> Add New </button> &nbsp;-->

                                        <?php if ($foundnum > 0) { ?>

                                            <!--            <button class="btn btn-primary" type="button" name="delete" id="delete" onclick="javascript:deleteRecord();" > Delete </button> &nbsp;	

                                <button class="btn btn-primary" type="button" name="active" id="active" onclick="javascript:activeRecord();" > Active </button> &nbsp;

                                <button class="btn btn-primary" type="button" name="inactive" id="inactive" onclick="javascript:inactiveRecord();" > Inactive </button> &nbsp;		 -->


                                            <input type="hidden" name="page" id="page" value="<?php echo $_GET["page"]; ?>" />

                                            <input type="hidden" name="action" id="action" value="search" />

                                            <input type="hidden" name="PageNo" value="<?php echo $_GET["PageNo"]; ?>" />

                                            <input type="hidden" name="field" value="<?php echo $_GET["field"]; ?>" />

                                            <input type="hidden" name="order" value="<?php echo $_GET["order"]; ?>" />

                                        <?php } ?>

                                    </div>

                                    <div class="col-xs-2">

                                        

                                        <div class="input-group mb-3" style="float: right;">
                                            
                                            <select class="cv_category form-control" name="cv_category" id="cv_category" onchange="loadreminderassign($cv_category)">
                                                <option value="">Choose...</option>
                                                <option value="">All</option>
                                                <option value="Shore">Shore</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-xs-4">

                                        <div id="dataTables_filter" class="dataTables_filter">

                                            <label>Search: <input class="form-control" type="text" name="search_txt" id="search_txt" value="<?php echo trim($_GET["search_txt"]); ?>" style="max-width:260px; display:inline-block; margin:0 10px;" /> <button class="btn btn-primary" type="submit" name="rws-submit"> Search </button></label>

                                        </div>

                                    </div>

                                </div>

                                <!--        <div class="gtstatitics">
                <p>Candidate Registered Within</p>
                <p>7 Days [<strong><?php echo togetjobseekersdata("-7 day", $condition = ""); ?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                30 Days [<strong><?php echo togetjobseekersdata("-30 day", $condition = ""); ?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                6 Months [<strong><?php echo togetjobseekersdata("-180 day", $condition = ""); ?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                12 Months [<strong><?php echo togetjobseekersdata("-365 day", $condition = ""); ?></strong>] &nbsp;&nbsp;|&nbsp;&nbsp;
                All [<strong><?php echo togetjobseekersdata("All", $condition = ""); ?></strong>]</p>
                <p>Candidate register with job alert [<?php echo togetjobseekersdata("", $condition = " `subscribe`='1' "); ?>]</p>
                </div>
                                -->

                                <?php if ($foundnum > 0) { ?>

                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                                <th width="10" style="color:#3c8dbc;"><input name="chkSelectAll" type="checkbox" id="chkSelectAll" value="checkbox" onclick="javascript:selectAllChk();" />SR.NO.</th>

                                                <th><?php echo $show_firmid; ?></th>

                                                <th><?php echo $show_title; ?></th>

                                                <th><?php echo $show_email; ?></th>

                                                <th><?php echo $show_mobile; ?></th>

                                                <th><?php echo $show_location; ?></th>

                                                <th><?php echo $show_phead; ?></th>

                                                <!--       <th><?php echo $show_jobstatus; ?></th>   -->

                                                <th><?php echo $show_add_date; ?></th>

                                                <th><?php echo $show_status; ?></th>

                                                <!--   <th><?php echo $show_validate; ?></th>   -->

                                                <th><?php echo $show_viewcv; ?></th>

                                                <th style="color:#3c8dbc;">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            $rowlist = $result->rows;

                                            $sr = 1;

                                            $j = 1;
                                            foreach ($rowlist as $key => $row) {

                                                if ($row["admin_approval"] == '0') {

                                                    $status = '<span style="color:#665252; font-weight:bold;">Inactive</span>';

                                                    $status_cls = 'style="border:1px solid #df8f8f; background: #ffcece;"';
                                                } else {

                                                    $status = '<span style="color:#556652; font-weight:bold;">Active</span>';

                                                    $status_cls = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
                                                }

                                                if ($row["validate"] == '0') {

                                                    $status1 = '<span style="color:#665252; font-weight:bold;">Not Validated</span>';

                                                    $status_cls1 = 'style="border:1px solid #df8f8f; background: #ffcece;"';
                                                } else {

                                                    $status1 = '<span style="color:#556652; font-weight:bold;">Validated</span>';

                                                    $status_cls1 = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
                                                }

                                            ?>

                                                <tr>
                                                    <?php //$id=$row['id'];
                                                    ?>
                                                    <!--   <td><input name="chkid[<?php echo $j; ?>]" type="checkbox" id="chkid[<?php echo $j; ?>]" value="<?php echo $row['id']; ?>" /></td>  

                                                <td><input name="chkid[<?php echo $row['id']; ?>]" type="checkbox" id="chkid[<?php echo $row['id']; ?>]" value="<?php echo $row['id']; ?>" /></td>-->

                                                    <td><input type="checkbox" class="checkBoxClass" id="id_<?php echo $row['id']; ?>" /> <?php echo $sr++; ?> </td>

                                                    <td><?php echo $row["id"]; ?></td>

                                                    <td><?php echo ucwords(strtolower($row["fullname"])); ?></td>

                                                    <td><?php echo $row["email"]; ?></td>

                                                    <td><?php echo $row["mobile"]; ?></td>

                                                    <td><?php echo $row["location"]; ?></td>

                                                    <td><?php echo $row["rankname"]; ?></td>

                                                    <!--       <td><?php echo $row["jobstatus"]; ?></td>   -->

                                                    <td><?php echo toshowdatewithtime($row["add_date"]); ?></td>

                                                    <td <?php echo $status_cls; ?>><?php echo $status; ?></td>
                                                    <!--       <td <?php echo $status_cls1; ?>><?php echo $status1; ?></td>   -->

                                                    <!--     <td><a href="jobseekers-details.php?fid=<?php echo $row["id"]; ?>">View Details</a></td>   -->


                                                    <?php

                                                    if ($row['resume'] == "") {

                                                        echo "<td> <span class='fa fa-eye viewshipcv' title='Click Here To View Full CV' id='" . $row['id'] . "' style='cursor:pointer;color: #3c8dbc;'> </span> NA </td>";
                                                    } else {

                                                        echo "<td>

                                            <span class='fa fa-eye viewshipcv' title='Click Here To View Full CV' id='" . $row['id'] . "' style='cursor:pointer;color: #3c8dbc;'> </span>



                                            <a href='../" . $row['resume'] . " '  target='_blank' class='uploadcv fa fa-download' data-toggle='tooltip' title='Download Original CV'></a>

                                        </td>";
                                                    }

                                                    ?>

                                                    <td> <button type="submit" data-toggle="tooltip" title="Click Here To Activate" class="btn btn-success btn-sm approval" id="<?php echo $row['id']; ?>">Activate</button> <br>

                                                        <button type="submit" style="margin:2px;" data-toggle="tooltip" title="Click Here To Deactivate" class="btn btn-danger deactivateuser" id="<?php echo $row['id']; ?>">Deactivate</button>
                                                    </td>
                                                </tr>

                                            <?php $j++;
                                            } ?>

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
                                <br>
                                
                                <div class="row" style="padding-top:10px; padding-bottom:10px;">

                                    <div class="col-xs-6">

                                        <div class="dataTables_info" id="example1_info">

                                            <?php if ($tot == 5) {
                                                echo 'Showing  ' . ($start + 1) . ' to ' . ($start + $per_page) . ' of ' . $foundnum . ' entries';
                                            } else if ($tot < 5 && $tot > 0) {
                                                echo 'Showing  ' . ($start + 1) . ' to ' . $foundnum . ' of ' . $foundnum . ' entries';
                                            } else {
                                                //echo '<strong style="color:#FF0000;">There is no jobseeker registered yet.</strong>'; 
                                            }

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
    $(function() {
    if (localStorage.getItem('cv_category')) {
        $("#cv_category option").eq(localStorage.getItem('cv_category')).prop('selected', true);
    }

    $("#cv_category").on('change', function() {
        localStorage.setItem('cv_category', $('option:selected', this).index());
    });
});
</script>


<script>
    //----for activate single candidate -----------//

    $(document).on('click', '.approval', function() {

        if (confirm('Are you sure you want to active this?')) {

            var userid = $(this).attr('id');

            // alert(userid);

            var action = "candidate_activ";

            $.ajax({

                url: "candidate_approve_ajax.php",

                method: "POST",

                data: {
                    userid: userid,
                    action: action
                },

                success: function(data) {

                    alert(data);
                    // swal(data);

                    // location.reload(true);

                }

            });

        }

    });
</script>

<script>
    //----for activate all candidate -----------//

    $('#activate').click(function() {
        var post_arr = [];

        // Get checked checkboxes

        $('#example1 input[type=checkbox]').each(function() {

            if (jQuery(this).is(":checked")) {

                var id = this.id;

                var splitid = id.split('_');

                var postid = splitid[1];

                var action = "activeall";

                post_arr.push(postid, action);



            }

        });

        if (post_arr.length > 0) {

            var action = "activeall";

            var isactivate = confirm("Do you really want to activate records?");

            if (isactivate == true) {

                // AJAX Request

                $.ajax({

                    url: 'candidate_approve_ajax.php',

                    type: 'POST',

                    data: {
                        post_id: post_arr,
                        action: action
                    },

                    success: function(result) {
                        // console.log(post_id);
                        //   console.log(result);
                        alert(result);

                        location.reload(true);

                    }

                });

            }

        }

    });
</script>

<script>
    //----for deactivate single candidate -----------//

    $(document).on('click', '.deactivateuser', function() {

        if (confirm('Are you sure you want to deactive this?')) {

            var userid = $(this).attr('id');

            //alert(userid);

            var action = "candidate_deactive";

            $.ajax({

                url: "candidate_approve_ajax.php",

                method: "POST",

                data: {
                    userid: userid,
                    action: action
                },

                success: function(data) {
                    //  alert(data);
                    swal(data);

                    // location.reload(true);

                }

            });

        }

    });
</script>


<script>
    //----for view cv-----------//

    $(document).on('click', '.viewshipcv', function() {

        $('#exampleModalLong').modal('toggle');


        var id = $(this).attr('id');

        // alert(id);

        $.ajax({

            method: "POST",

            data: {
                id: id
            },

            url: "show_thalla_resume11.php",

            success: function(data) {

                $('.modal-body').html(data);
                //   $('.modal-body').html('tanuja');   


            }

        });

    });

    $('#activate').click(function () {
        $(this).attr("disabled", "disabled");
    })
</script>