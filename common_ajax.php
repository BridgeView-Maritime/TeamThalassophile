<?php include("includes/config.php");

$action = $_POST['action'];

if ($action == "agent_candidate") {

    $jobid = $_POST['jobid'];
    $agnid = $_POST['agnid'];

    

    // $selected = $_POST['selected'];

    // $docid=$_POST['docid'];

    $selectAll =   "SELECT ac.id,ac.job_id,ac.fullname,ac.cv_category,ac.rank, j.jobtitle,j.currency, j.salary,j.period,a.firstname,a.email, c.country FROM `ss_agent_candidate` as ac join `ss_agent_vacancy` as av on (av.job_id = ac.job_id) join `ss_agent` as a on(ac.agn_id = a.id) join `ss_employer_jobs` as j on (av.job_id = j.id) join `ss_countries` as c on(ac.country = c.id) where ac.job_id = '" . $jobid . "' and ac.agn_id = '" . $agnid . "' group by ac.id order by ac.id ";

    $result = $db->query($selectAll);

    
    $rowlist = $result->rows;
    $foundnum = $result->num_rows;

    $table = "

        <h3 align='center'>Proposed Candidate List</h3>

        <table border='1' cellspacing='0' class='table table-striped table-bordered table-responsive'>

		<thead style= 'background-color:#643cca;color: white'>

			<th>Sr No</th>

			<th>Candidate Details</th>

			<th>Company Details</th>

            <th>Agent Details</th>


            ";

    $table .= "
    <th>Action</th>            
	</thead>
    <tbody>
    ";

  
		// $rowlist = $result->rows;
		$i = 1;
		$j = 1;
		foreach ($rowlist as $key => $row) {

            
            $table .=  "<tr >
            <td valign='top'>". $i++."</td>

            <td valign='top' style='text-align:left ;'>".'<b>'.'Candidate Id</b> : ' . $row['id'].'<br>'.'<b>'.'Candidate Name</b> : ' . $row['fullname'].'<br>'. '<b>Country</b> : '. $row['country'].' <br>'.'<b>Category</b> : '. $row['cv_category'].' <br>'.' <b>Rank  </b> : <a href='. $row['job_id'].' >'. $row['rank'].' </a>'.
			"</td>
            <td valign='top' style='text-align:left ;'>".'<b>'.'Jobtitle</b> : ' . $row['jobtitle'].'<br>'.'<b>'.'Currency</b> : ' . $row['currency'].'<br>'. '<b>Salary</b> : '. $row['salary'].' <br>'.' <b>Period  </b> : '. $row['period'].
			"</td>
            <td valign='top' style='text-align:left ;'>".'<b>'.'Name</b> : ' . $row['firstname'].'<br>'.'<b>'.'Email</b> : ' . $row['email'].
			"</td>
            <td valign='top'></td>
            
            
            
            
           " ;
            



            
        }

        $table .= "
        </tr>
</tbody>
    </table>
    ";


    echo $table;
}
?>