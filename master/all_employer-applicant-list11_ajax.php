<?php

include('../includes/config.php');

    $record_per_page = 10;  


    if(isset($_POST['page'])){

        $page=$_POST['page'];

    }else{

        $page=1;

    }


    $start_from=($page-1)*$record_per_page;

    $table="";

   
    $job_id = $_POST['job_id'];
  
  
    /*   for applicant link page code   */
    $condition = "";
    if(!empty($_POST['job_id']))
			{
            
			//	$conditon .= " AND t1.job_id='$job_id'";	
                
                $condition .= " t1.job_id='$job_id' ";	
		
                //	$urlconditions .= "&job_id=".$_GET["job_id"];
				
			//	$pagetitle = "Manage Job Applicants for ".togetfieldvalue("jobtitle", "ss_employer_jobs", " `id`=".$_GET["job_id"]);          

           
    $query="SELECT t1.*, t2.fullname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category, t3.job_type, t3.vessel, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id  WHERE  $condition ";
        
			}
           else{
  
 //  $query="SELECT * FROM `ss_jobseekers_jobapplied` order by id DESC limit $start_from,$record_per_page ";
   
    
    $query="SELECT t1.*, t2.fullname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category, t3.job_type, t3.vessel, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id  ORDER BY id DESC limit $start_from,$record_per_page";


        }
            

    $query1="SELECT t1.*, t2.fullname, t2.email, t2.mobile, t2.profile_pic, t2.resume, t2.location, t2.professional_headline, t3.section, t3.jobtitle, t3.category, t3.job_type, t3.vessel, t3.location as joblocation, t4.firstname as emp_firstname, t4.lastname as emp_lastname, t4.email as emp_email, t4.mobile as emp_mobile, t4.company as emp_company FROM ss_jobseekers_jobapplied as t1 LEFT JOIN ss_jobseekers as t2 ON t1.js_id=t2.id  LEFT JOIN ss_employer_jobs as t3 ON t1.job_id=t3.id LEFT JOIN ss_employer as t4 ON t1.emp_id=t4.id ORDER BY id DESC";

    

    $rs = $db->query($query);	
    $rcount = $rs->num_rows;


    $rs1 = $db->query($query1);	
    $totcount = $rs1->num_rows;


?>

    <div class="col-xs-12"><!-- /.box -->

    <?php if(!empty($msg)) { ?>

    <div id="gt-formsuccess">                                

        <?php echo $msg; ?>

    </div>

    <?php } ?>

    <form action="" method="get" name="form4" id="form4">

    <div class="box"><!-- /.box-header -->

        <div class="box-body table-responsive">

            <?php // if($foundnum>0) { echo '<div class="rws-messageshow">'.$foundnum.' '.trim($_GET["search_txt"]).'  results found!</div>'; } ?>

            <div class="row" style="padding-bottom:10px; padding-top:5px;">

                                        

            </div>
            


            <?php if($rcount>0) { 

        $table .="      <table id='example1'  class='table table-bordered table-striped'>

                <thead>

                    <tr>

                    <td style='padding:5px 5px; color:#3c8dbc;'>Sr No</td>

                    <td style='color:#3c8dbc;'>Jobseeker ID</td>

                    <td style='color:#3c8dbc;'>Rank</td>

                    <td style='color:#3c8dbc;'>Name</td>
                                 
                    <td style='color:#3c8dbc;'>Category</td>

                    <td style='color:#3c8dbc;'>Vessel Type</td> 	

                    <td style='color:#3c8dbc;'>Apply Date</td> 		  		
                    
                    <td style='color:#3c8dbc;'>Status</td>

                   


                    </tr>

                </thead>     

                <tbody>  ";

            
            $rowlist = $rs->rows;

                
            $sr=1; 	 foreach($rowlist as $key => $row) { 


                    if($row["status"]==1) { $class="rwsactive"; $statustext='Active'; }
                    if($row["status"]==0) { $class="rwsinactive"; $statustext='Inactive'; }

            
            
                    $table .="<tr style='font:normal 15px sans-serif;width:100%;text-align:center;'>";

                    $table .="<td>".$sr++."</td>";

                    $table .="<td>".$row['id']."</td>";

                    $table .="<td>".$row['jobtitle']."</td>";
                      
                    $table .="<td>".ucwords(strtolower($row['fullname']))."</td>";
               
                    $table .="<td>".$row['category']."</td>";

                    $table .="<td>".$row['vessel']."</td>";

                    $table .="<td>".toshowdatewithtime($row['apply_date'])."</td>";

                    $table .="<td>".$statustext."</td>";           
                    
                   
                                                                                                                        
                

    $table .="    
                        </td>
                    </tr> ";

             }                                         

    $table .="        </tbody>

        

            </table>    ";

    }    

    

    $firstpage=1;
    $nextpage=(int)$page+1;
    $previouspage=(int)$nextpage-2;	
    $nnextpage=(int)$nextpage+1;	
    $nnnextpage=(int)$nnextpage+1;
    $nextpage2=(int)$nnnextpage+1;

    $lastPage = ceil($totcount / 10); 


    $newcount=(int)($page-1)*10+1;
    $newcount2=(int)$newcount+9;    

    if($totcount==0){
    $newcount=0;
    }else{
    $newcount=(int)($page-1)*10+1;
    }



if(empty($_POST['job_id'])){

    if($rcount==10){        
    
    $table .="<tr>

    <td colspan='6' align='left' style='border-right: none;'>
    Showing ".$newcount." to  ".$newcount2." of ".$totcount." records
    </td>

    <td colspan='7' align='right'>

    ";

    $table .="</br><div class='col-lg-12'><div class='row' align='center';><tr>

    <td colspan='11' align='right'>
    ";



    $table .="<ul class='pagination'>

    <li class='nextpage' id='".$firstpage."' action='".$action."' >First Page</li>";  


    if($page>1){ 

    $table .="<li class='nextpage' id='".$previouspage."'  action='".$action."' >Previous Page</li>
    <li class='nextpage' id='".$previouspage."'  action='".$action."' >".$previouspage."</li>	";

    }
    else{

    }



    $table .=" <li class='nextpage' id='".$page."' style='color: white;background-color:#1ccae3;' 
    action='".$action."' >".$page."</li>

    <li class='nextpage' id='".$nextpage."' action='".$action."' >".$nextpage."</li>  		 


    <li class='nextpage' id='".$nextpage."'  action='".$action."' >Next Page</li>

    </ul></div></div> 

    ";	 


    }
    else{



    if($totcount>0){
        
   
    /*    $table .="</br><div class='col-lg-12'><div class='row' align='center';><tr>

    <td colspan='11' align='right'>
    ";    */

  
    $table .="<tr>

    <td colspan='6' align='left' style='border-right: none;'>
    Showing ".$newcount." to  ".$totcount." of ".$totcount." records
    </td>  
    <td colspan='7' align='right'>
    <ul class='pagination' style='float: right; padding-top:20px;'>
    <li class='nextpage' id='".$firstpage."' action='".$action."'>First Page</li>
    <li class='nextpage' id='".$previouspage."' action='".$action."'>Previous Page</li></ul>
    </td>

    </tr>";
    }
    else{
    echo "<b>No Record Found.....!!!</b>";
    }

    }




}
    echo $table;

    ?>

    </div><!-- /.box-body -->

    </div><!-- /.box -->

    </form>

    </div>


  