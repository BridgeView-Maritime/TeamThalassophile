<style>

</style>
<?php

include('../includes/config.php');

$record_per_page = 10;
$job_id = $_POST['job_id'];
$emp_id = $_POST['emp_id'];


if (isset($_POST['page'])) {

  $page = $_POST['page'];
} else {

  $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$table = "";

$query = "SELECT * FROM `ss_agent` where validate = '1' and approval = '1' order by id DESC limit $start_from,$record_per_page ";

$query1 = "SELECT * FROM `ss_agent` order by id DESC";

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

  <!-- <form action="" method="get" name="form4" id="form4"> -->

  <div class="box"><!-- /.box-header -->

    <div class="box-body table-responsive">

      <?php if ($rcount > 0) {

        $table .= "<h2 style = 'margin-top:5px'>List of Assogned Jobs</h2>
          <div class='row' style='margin: 0 0 10px;'>
          <div class=''>
          <button  id='" . $job_id . "'  emp_id = '" . $emp_id . "'class='btn btn-primary assignagent'>Activate</button>
          <button  id='deactivate' class='btn btn-primary'>Dectivate</button>
          </div>
          </div>

        <table id='example1'  class='table table-bordered table-striped'>
                <thead>
                    <tr>
                    <th width='10' style='color:#3c8dbc;'><input name='chkSelectAll' type='checkbox' class='chkSelectAll' value='checkbox' />Sr.No</th>

                    <td style='color:#3c8dbc;'>Job ID</td>

                    <td style='color:#3c8dbc;'>Name</td>

                    <td style='color:#3c8dbc;'>Email</td>

                    <td style='color:#3c8dbc;'>Mobile</td>

                    <td style='color:#3c8dbc;'>Company</td>

                    <td style='color:#3c8dbc;'>Contry</td>

                    <td style='color:#3c8dbc;'>Registered Date</td>

                    <td style='color:#3c8dbc;'>Status</td> 		  		

                    </tr>

                </thead>     

                <tbody class='agent_job_list_ajax'>  

                ";

        $rowlist = $rs->rows;

        $sr = 1;
        foreach ($rowlist as $key => $row) {
          // echo $row['id'];exit;

          if ($row["status"] == 1) {
            $class = "rwsactive";
            $statustext = 'Active';
          }
          if ($row["status"] == 0) {
            $class = "rwsinactive";
            $statustext = 'Inactive';
          }
          if ($row["validate"] == '0') {

            $status1 = '<span style="color:#665252; font-weight:bold;">Not Validated</span>';

            $status_cls1 = 'style="border:1px solid #df8f8f; background: #ffcece;"';
          } else {

            $status1 = '<span style="color:#556652; font-weight:bold;">Validated</span>';

            $status_cls1 = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
          }
          if ($row["approval"] == '0') {

            $status2 = '<span style="color:#665252; font-weight:bold;">Not Approved</span>';

            $status_cls2 = 'style="border:1px solid #df8f8f; background: #ffcece;"';
          } else {

            $status2 = '<span style="color:#556652; font-weight:bold;">Approved</span>';

            $status_cls2 = 'style="border:1px solid #9adf8f; background: #d5ffce;"';
          }

          $table .= "<tr style='font:normal 15px sans-serif;width:100%;text-align:center;'>";

          $query10 = "SELECT * FROM `ss_agent_vacancy` where agn_id = " . $row['id'] . " and job_id = $job_id";

          $rs = $db->query($query10);
          $rcount = $rs->num_rows;

          if ($rcount > 0) {
            $checkedStatus = "disabled";
            $lable = "Already assigned";
          } else {
            $checkedStatus = "";
            $lable = "";
          }

          $query20 = "SELECT * FROM `ss_agent_vacancy` where agn_id = " . $row['id'] . " and job_id = $job_id and status = '0'";

          $rs = $db->query($query20);
          $rcount = $rs->num_rows;

          if ($rcount > 0) {
            $lable = "Deactivated";
            $checkedStatus = "";
          } else {
          }

          $table .= "<td> <input type='checkbox' class='checkBoxClass '  id=" . $row['id'] . "  $checkedStatus /> " . $sr++ . "
            
            <p>$lable</p>
            
            </td>";

          $table .= "<td>" . $row['id'] . "</td>";

          $table .= "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";

          $table .= "<td>" . $row['email'] . "</td>";

          $table .= "<td>" . $row['mobile'] . "</td>";

          $table .= "<td>" . $row['company'] . "</td>";

          $table .= "<td>" . $row['country'] . "</td>";

          $table .= "<td>" . toshowdatewithtime($row['add_date']) . "</td>";

          $table .= "<td " . $status_cls2 . " >" . $status2 . "</td>";
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

    <td colspan='7' align='right'>";

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

          // $table .="<tr>

          // <td colspan='6'  style='border-right: none;'>
          // Showing ".$newcount." to  ".$totcount." of ".$totcount." records
          // </td>  
          // <td colspan='7' align='right'>
          // <ul class='pagination' style='float:right; padding-top:20px;'>
          // <li class='nextpage' id='".$firstpage."' action='".$action."'>First Page</li>
          // <li class='nextpage' id='".$previouspage."' action='".$action."'>Previous Page</li></ul>
          // </td>

          // </tr>";
        } else {
          echo "<b>No Record Found.....!!!</b>";
        }
      }

      echo $table;

      ?>

    </div><!-- /.box-body -->

  </div><!-- /.box -->

  <!-- </form> -->

</div>

<script>
  // $(".chkSelectAll").click(function () {
  //      $('input:checkbox').not(this).prop('checked', this.checked);
  //  });

  $(document).ready(function() {
    $(".chkSelectAll").change(function() {
      if (this.checked) {
        $(".checkBoxClass").each(function() {
          this.checked = true;
        });
      } else {
        $(".checkBoxClass").each(function() {
          this.checked = false;
        });
      }
    });

    $(".checkBoxClass").click(function() {
      if ($(this).is(":checked")) {
        var isAllChecked = 0;

        $(".checkBoxClass").each(function() {
          if (!this.checked)
            isAllChecked = 1;
        });

        if (isAllChecked == 0) {
          $(".chkSelectAll").prop("checked", true);
        }
      } else {
        $(".chkSelectAll").prop("checked", false);
      }
    });
  });
</script>


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