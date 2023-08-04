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

$query2 = "SELECT av.id,av.job_id, j.vessel, j.section, j.add_date, j.start_date, j.end_date, j.company_name, j.category, j.jobtitle, j.area_of_operation, j.description, j.salary, j.currency, j.period, j.emp_id, a.firstname, a.logo, a.approval FROM `ss_agent_vacancy` as av join `ss_employer_jobs` as j  on (av.job_id = j.id) JOIN `ss_agent` as a ON ( a.id = av.agn_id ) where av.status = '1' and av.agn_id = '" . $agnid . "' ";

// echo $query2;exit;

$rs = $db->query($query2);
$rcount = $rs->num_rows;


$rs1 = $db->query($query2);
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

        <?php // if($foundnum>0) { echo '<div class="rws-messageshow">'.$foundnum.' '.trim($_GET["search_txt"]).'  results found!</div>'; } 
        ?>

        <?php if ($rcount > 0) {

          $table .= "     <h2 style = 'margin-top:5px'>List of Agents</h2>
          <div class='row' style='margin: 0 0 10px;'>
          <div class=''>
          
                    <button  class='btn btn-primary deactivate_job_agent'>Dectivate</button>
          </div>
          </div>
          
          <table id='example1'  class='table table-bordered table-striped'>

                <thead>

                    <tr>

                    <th width='10' style='color:#3c8dbc;'><input name='chkSelectAllJobs' type='checkbox' class='chkSelectAllJobs' value='checkbox' />Sr.No</th>

                    <td style='color:#3c8dbc;'>Job ID</td>

                    <td style='color:#3c8dbc;'>Date</td>

                    <td style='color:#3c8dbc;'>Company</td>

                    <td style='color:#3c8dbc;'>Job Area</td>

                    <td style='color:#3c8dbc;'>Salary</td>

                    <td style='color:#3c8dbc;'>Status</td> 		  		

                    </tr>

                </thead>     

                <tbody class='vacancy_agent_list_ajax'>  ";

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

            $table .= "<td> <input type='checkbox' class='checkBoxClassJobs' id=" . $row['id'] . " /> " . $sr++ . "</td>";

            $table .= "<td>" . $row['job_id'] . "</td>";

            $table .= "<td valign='top'>".date('d-m-Y H:i:s', strtotime($row['add_date']))."</td>";

            $table .= "<td valign='top' style='text-align:left ;'><b>Company Name</b> : ". $row['company_name']."<br>
            <b>Rank</b> : ". $row['category']."<br>
            <b>Jobtitle</b> : <a href=". $row['job_id'].">". $row["jobtitle"]."</a>
          </td>";

            $table .= "<td>" . $row["area_of_operation"] . "</td>";

            $table .= "<td valign='top' style='text-align:left ;'>
            <b>Salary</b> : ". $row['currency']." ".$row['salary']."<br>

            <b>Period</b> : ". $row['period']."
          </td>";

            $table .= "<td>" . $statustext . "</td>";

            $table .= "                    
                        </td>
                    </tr> ";
          }

          $table .= "</tbody>
            </table>";
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

  <!-- </form> -->

</div>

<script>

    //----for hecking all with one check -----------//
 $(document).ready(function() {
    $(".chkSelectAllJobs").change(function() {
        if (this.checked) {
            $(".checkBoxClassJobs").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkBoxClassJobs").each(function() {
                this.checked=false;
            });
        }
    });

    $(".checkBoxClassJobs").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".checkBoxClassJobs").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $(".chkSelectAllJobs").prop("checked", true);
            }     
        }
        else {
            $(".chkSelectAllJobs").prop("checked", false);
        }
    });
});
</script>


