<style>

</style>
<?php

include('../includes/config.php');

$record_per_page = 10;


if (isset($_POST['page'])) {

  $page = $_POST['page'];
} else {

  $page = 1;
}

$agnid = $_POST['agnid'];
$start_from = ($page - 1) * $record_per_page;

$table = "";

$query = "SELECT * FROM `ss_employer_jobs` order by id DESC limit $start_from,$record_per_page ";

$query1 = "SELECT * FROM `ss_employer_jobs` order by id DESC";

$query2 = "SELECT av.job_id, j.add_date, j.start_date, j.end_date, j.company_name, j.category, j.jobtitle, j.area_of_operation, j.description, j.salary, j.currency, j.period, j.emp_id, a.firstname, a.logo, a.approval FROM `ss_agent_vacancy` as av join `ss_employer_jobs` as j  on (av.job_id = j.id) JOIN `ss_agent` as a ON ( a.id = av.agn_id ) $queryjoin where av.status = '1' and a.id = '" . $agnid . "' ";

// echo $query2;exit;

$rs = $db->query($query);
$rcount = $rs->num_rows;


$rs1 = $db->query($query1);
$totcount = $rs1->num_rows;


?>

<div class="col-xs-12"><!-- /.box -->

  <?php if (!empty($msg)) { ?>

    <div id="gt-formsuccess">

      <?php echo $msg; ?>

    </div>

  <?php } ?>

  <form action="" method="get" name="form4" id="form4">

    <div class="box"><!-- /.box-header -->

      <div class="box-body table-responsive">

        <?php // if($foundnum>0) { echo '<div class="rws-messageshow">'.$foundnum.' '.trim($_GET["search_txt"]).'  results found!</div>'; } 
        ?>

        <div class="row" style="padding-bottom:10px; padding-top:5px;">

        </div>

        <?php if ($rcount > 0) {

          $table .= "      <table id='example1'  class='table table-bordered table-striped'>

                <thead>

                    <tr>

                    <td style='padding:5px 5px;color:#3c8dbc;'>Sr No</td>

                    <td style='color:#3c8dbc;'>Job ID</td>

                    <td style='color:#3c8dbc;'>Rank</td>

                    <td style='color:#3c8dbc;'>Category</td>

                    <td style='color:#3c8dbc;'>Vessel Type</td>

                    <td style='color:#3c8dbc;'>Posted In</td>

                    <td style='color:#3c8dbc;'>Posted Date</td>

                    <td style='color:#3c8dbc;'>Expiry Date</td>

                    <td style='color:#3c8dbc;'>Applied Applicants</td> 	

                    <td style='color:#3c8dbc;'>Agent Applicants</td> 	
                    
                    <td style='color:#3c8dbc;'>Agent Assigned</td> 

                    <td style='color:#3c8dbc;'>Status</td> 		  		

                    <td style='color:#3c8dbc;'>Action</td>


                    </tr>

                </thead>     

                <tbody>  ";

          $rowlist = $rs->rows;

          $sr = 1;
          foreach ($rowlist as $key => $row) {

            if ($row["status"] == 1) {
              $class = "rwsactive";
              $statustext = 'Active';
            }
            if ($row["status"] == 0) {
              $class = "rwsinactive";
              $statustext = 'Inactive';
            }

            $table .= "<tr style='font:normal 15px sans-serif;width:100%;text-align:center;'>";

            $table .= "<td>" . $sr++ . "</td>";

            $table .= "<td>" . $row['id'] . "</td>";

            $table .= "<td>" . $row['jobtitle'] . "</td>";

            $table .= "<td>" . $row['category'] . "</td>";

            $table .= "<td>" . $row['vessel'] . "</td>";

            $table .= "<td>" . $row['section'] . "</td>";

            $table .= "<td>" . toshowdatewithtime($row['add_date']) . "</td>";

            $table .= "<td>" . toshowdatewithtime($row['end_date']) . "</td>";

            $total = "SELECT * FROM `ss_jobseekers_jobapplied` where job_id='" . $row["id"] . "' ";
            $ta = $db->query($total);
            $totalapplicants = $ta->num_rows;

            $table .= "<td><a href='all_employer-applicant-list11.php?job_id=" . $row['id'] . "'>
                    Applicants[" . $totalapplicants . "]</a> </td>";

            // Candidates assigned by agents

            $total = "SELECT * FROM `ss_agent_candidate` where job_id='" . $row["id"] . "' ";
            $ta = $db->query($total);
            $totalassigned = $ta->num_rows;

            $table .= "<td>
                            <a  job_id=" . $row["id"] . " can_id=" . $row["id"] . " id='agentApplicants'
                            class='btn btn-success' data-toggle='modal' data-target='#exampleModal'>
                            Assigned [" . $totalassigned . "] </a>
        
                            </td>";


            // Candidates to assign jobs
            $total = "SELECT * FROM `ss_agent_vacancy` where job_id='" . $row["id"] . "' and status = '1'";
            $ta = $db->query($total);
            $totalassigned = $ta->num_rows;

            $table .= "<td>
                    
                    <a  job_id=" . $row["id"] . " emp_id=" . $row["emp_id"] . " id='applicant'
                    class='btn btn-success' data-toggle='modal' data-target='#exampleModal'>
                    Assigned [" . $totalassigned . "] </a>

                    </td>";


            $table .= "<td>" . $statustext . "</td>";



            $table .= " <td align='left' valign='top' class='rws-actionbtns'>
        
                                                
                    <a href='javascript:void(0);'
                    post_id='" . $row["id"] . "'
                    onClick='' class='btn btn-success jobactive' title='Active'><i class='fa fa-check-square-o' aria-hidden='true'></i></a>
                    
                    <a href='javascript:void(0);' 
                    post_id='" . $row["id"] . "'
                    onClick='' class='btn btn-warning jobinactive' title='Inactive'><i class='fa fa-ban' aria-hidden='true'></i></a>&nbsp;
                                    
                </td>

                        </td>
                    </tr> ";
          }

          $table .= "</tbody>
            </table>    ";
        }

        $firstpage = 1;
        $nextpage = (int)$page + 1;
        $previouspage = (int)$nextpage - 2;
        $nnextpage = (int)$nextpage + 1;
        $nnnextpage = (int)$nnextpage + 1;
        $nextpage2 = (int)$nnnextpage + 1;

        $lastPage = ceil($totcount / 10);

        $newcount = (int)($page - 1) * 10 + 1;
        $newcount2 = (int)$newcount + 9;

        if ($totcount == 0) {
          $newcount = 0;
        } else {
          $newcount = (int)($page - 1) * 10 + 1;
        }

        if ($rcount == 10) {

          $table .= "<tr>

    <td colspan='6' align='left' style='border-right: none;'>
    Showing " . $newcount . " to  " . $newcount2 . " of " . $totcount . " records
    </td>

    <td colspan='7' align='right'>

    ";

          $table .= "</br><div class='col-lg-12'><div class='row' align='center';><tr>

    <td colspan='11' align='right'>
    ";

          $table .= "<ul class='pagination'>

    <li class='nextpage' id='" . $firstpage . "' action='" . $action . "' >First Page</li>";

          if ($page > 1) {

            $table .= "<li class='nextpage' id='" . $previouspage . "'  action='" . $action . "' >Previous Page</li>
    <li class='nextpage' id='" . $previouspage . "'  action='" . $action . "' >" . $previouspage . "</li>	";
          } else {
          }

          $table .= " <li class='nextpage' id='" . $page . "' style='color: white;background-color:#1ccae3;' 
    action='" . $action . "' >" . $page . "</li>

    <li class='nextpage' id='" . $nextpage . "' action='" . $action . "' >" . $nextpage . "</li>  		 


    <li class='nextpage' id='" . $nextpage . "'  action='" . $action . "' >Next Page</li>

    </ul></div></div> 

    ";
        } else {



          if ($totcount > 0) {


            /*    $table .="</br><div class='col-lg-12'><div class='row' align='center';><tr>

    <td colspan='11' align='right'>
    ";          */

            $table .= "<tr>

    <td colspan='6'  style='border-right: none;'>
    Showing " . $newcount . " to  " . $totcount . " of " . $totcount . " records
    </td>  
    <td colspan='7' align='right'>
    <ul class='pagination' style='float:right; padding-top:20px;'>
    <li class='nextpage' id='" . $firstpage . "' action='" . $action . "'>First Page</li>
    <li class='nextpage' id='" . $previouspage . "' action='" . $action . "'>Previous Page</li></ul>
    </td>

    </tr>";
          } else {
            echo "<b>No Record Found.....!!!</b>";
          }
        }

        echo $table;

        ?>

      </div><!-- /.box-body -->

    </div><!-- /.box -->

  </form>

</div>


<script>
  $(".jobactive").click(function() {

    var post_id = $(this).attr('post_id');
    alert('Are You Want to Active This Record');

    var action = "JobActive";
    $.ajax({
      method: "POST",
      url: "candidate_approve_ajax.php",
      data: {
        post_id: post_id,
        action: action
      },
      success: function(result) {
        //   alert(result);
        swal(result);
        setInterval(function() {
          window.location.reload();
        }, 1000);
      }

    });
  });


  $(".jobinactive").click(function() {

    var post_id = $(this).attr('post_id');
    //alert(post_id);
    alert('Are You Want to Inactive This Record');

    var action = "JobInactive";
    $.ajax({
      method: "POST",
      //  url : "vacancy_update.php",
      url: "candidate_approve_ajax.php",
      data: {
        post_id: post_id,
        action: action
      },
      success: function(data) {
        swal(data);
        setInterval(function() {
          window.location.reload();
        }, 1000);
      }

    });
  });
</script>