<?php

include("includes/config.php");

$action = $_POST['action'];

// $record_per_page = 5;  
// $page = '';  
// if(isset($_POST['page'])){

//     $page=$_POST['page'];

// }else{

//     $page=1;

// }
// $start_from=($page-1)*$record_per_page;

if ($action == "rankrequest") {

    $cat = $_POST['cat'];
    $rank = $_POST['rank'];
    if ($cat == "") {
        $cat = "Marine";
    }
    print_r($cat);

    // if($action == "Onshore"){

    //     $page_query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
    //      AND t1.category='Onshore' ORDER BY add_date DESC limit $start_from,$record_per_page";

    //     $tot="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
    //      AND t1.category='Onshore' ORDER BY add_date DESC";

    // }


    //query to from
    $page_result =  $db->query($page_query);
    $page_data   =  $page_result->rows;
    $rcount      =  $page_result->num_rows;


    //total count query data
    $totconnect =  $db->query($tot);
    $totalpage_data   = $totconnect->rows;
    $totcount =   $totconnect->num_rows;

    $stringhtml = "";

    if (empty($_SESSION["USER"]['ID'])) {
        $confidential = "job-post-confidential";
        $style = "";
    } else {
        $style = "display:none;";
    }

    if ($cat == 'SHORE') {


        $query1 = "SELECT * FROM `shore_rank`  ";
        $result1 = $db->query($query1);
        $rowlist = $result1->rows;

        $output = "";

        foreach ($rowlist as $key => $row) {
            $output .= "<option value='" . $row['rankname'] . "'>" . $row['rankname'] . "</option>";


            // foreach ($page_data as $key => $row) {
            if (!empty($row["logo"])) {
                $imgurl = '<a href="' . $baseurl . 'job-details.php?jobid=' . $row["id"] . '" title="' . $row["jobtitle"] . '"><img src="' . $baseurl . $row["logo"] . '" alt="' . $row["jobtitle"] . '" /></a>';
            } else {
                $imgurl = '<a href="' . $baseurl . 'job-details.php?jobid=' . $row["id"] . '" title="' . $row["jobtitle"] . '"><img src="' . $baseurl . 'images/no-pic-com-logo.jpg" alt="' . $row["jobtitle"] . '" /></a>';
            }

            if (!empty($row["location"])) {
                $showlocation = ", " . $array_location_all[$row["location"]];
            } else {
                $showlocation = "";
            }

            if ($row["section"] == "Shore") {
                $showcategory = $array_category_shore[$row["category"]];
            } else {
                $showcategory = $array_category_offshore[$row["category"]];
            }

            $stringhtml .= '<div class="row"   id="job-content"> 
                
                <div class="col-md-8">
                <h5>Rank :<a href="' . $baseurl . 'job-details.php?jobid=' . $row["id"] . '" title="' . $row["jobtitle"] . '"> ' . $row["jobtitle"] . '</a></h5>
                <span style="color:#b1035ff0";><i class="fa fa-building-o" aria-hidden="true"></i>&nbsp Company :Confidential</span> ,  &nbsp 
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> Vessel Type : <span class="' . $confidential . '" > ' . $row["vessel"] . ' </span></span><br>
             <span><i class="fa fa-usd" aria-hidden="true"></i> Salary : <span class="' . $confidential . '" >  ' . $row["salary"] . ' </span> </span> ,   &nbsp
             <span> <i class="fas fa-briefcase" aria-hidden="true"></i> Experience : <span class="' . $confidential . '" > ' . $row["experience"] . ' </span></span><br>
             <span><i class="fa fa-calendar" aria-hidden="true"></i> Posted Date :' . date('d-m-Y', strtotime($row["add_date"])) . '
              &nbsp  <b><span class="text-muted">Posted in ' . $showcategory . ' <em>(' . $row["jobarea"] . ' Job)</em></span></b>    </span>                          
                </div>


                <div class="col-md-4">
                        
                <a style="color:white !important"; href="' . $baseurl . 'applyjob1.php?jobid=' . $row["id"] . '"  jobid="' . $row["id"] . '" title="' . $row["jobtitle"] . '" class="btn job">
               	Apply Now </a>
                      </div>                                                                                           
                                    
                                   
                    
                             </div>
                            ';
            // }
        }

        echo $stringhtml;
    } else {

        $query = "SELECT * FROM `ss_allrank` WHERE category='" . $cat . "' ";
        $result = $db->query($query);
        $rowlist = $result->rows;

        $output = "";

        foreach ($rowlist as $key => $row) {


            if ($rank == $row['rankname']) {
                $output .= "<option value='" . $row['rankname'] . "' selected>" . $row['rankname'] . "</option>";
            } else {
                $output .= "<option value='" . $row['rankname'] . "'>" . $row['rankname'] . "</option>";
            }
            // echo $row['rankname'];
        }

        // die;
        echo $output;
    }
}
