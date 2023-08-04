<?php   
  
  include("includes/config.php"); 
    // checkuserlogin();
   
  
  
    $record_per_page = 5;  
    $page = '';  
    if(isset($_POST['page'])){

        $page=$_POST['page'];

    }else{

        $page=1;

    }
    $start_from=($page-1)*$record_per_page;
   
   
    

    $action = $_POST['action'];

    if($action == "aramco"){
          
    $page_query=" SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  AND t1.jobarea='aramco' 
    ORDER BY add_date DESC limit $start_from,$record_per_page";

    $tot=" SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  AND t1.jobarea='aramco' 
    ORDER BY add_date DESC";
    
    }

    if($action == "adnoc"){
          
        $page_query=" SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  AND t1.jobarea='adnoc'
        ORDER BY add_date DESC limit $start_from,$record_per_page";

        $tot=" SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  AND t1.jobarea='adnoc'
        ORDER BY add_date DESC";
        
    }

    if($action == "other"){
          
        $page_query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
        AND t1.jobarea='other' ORDER BY add_date DESC limit $start_from,$record_per_page";

        $tot="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  AND t1.jobarea='other' 
        ORDER BY add_date DESC";
        
    }

    if($action == "oilngas"){
          
        $page_query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1'  
        AND t1.category='oilngas' ORDER BY add_date DESC limit $start_from,$record_per_page";

        $tot="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
         AND t1.category='oilngas' ORDER BY add_date DESC";
      
  }

  if($action == "Offshore"){
          
        $page_query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
         AND t1.category='Offshore' ORDER BY add_date DESC limit $start_from,$record_per_page";

        $tot="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
         AND t1.category='Offshore' ORDER BY add_date DESC";
    
  }

  if($action == "Mainfleet"){
          
    $page_query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
     AND t1.category='Mainfleet' ORDER BY add_date DESC limit $start_from,$record_per_page";

    $tot="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
     AND t1.category='Mainfleet' ORDER BY add_date DESC";

}

  if($action == "Onshore"){
          
    $page_query="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
     AND t1.category='Onshore' ORDER BY add_date DESC limit $start_from,$record_per_page";

    $tot="SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' 
     AND t1.category='Onshore' ORDER BY add_date DESC";

}

    
   //query to from
    $page_result =  $db->query($page_query);	
    $page_data   =  $page_result->rows;					  
    $rcount      =  $page_result->num_rows;


    //total count query data
    $totconnect =  $db->query($tot);	
    $totalpage_data   = $totconnect->rows;					  
    $totcount =   $totconnect->num_rows;
   
    $stringhtml = "";


    if(empty($_SESSION["USER"]['ID'])){
      $confidential="job-post-confidential";
      $style="";
    }else{
    $style="display:none;";
    }
  
 //   $total_pages = ceil($total_records/$record_per_page);


  

     /* ------start---------new format job-----------------*/
   
   
     foreach($page_data as $key => $row)
     {
         if(!empty($row["logo"])) { $imgurl = '<a href="'.$baseurl.'job-details.php?jobid='.$row["id"].'" title="'.$row["jobtitle"].'"><img src="'.$baseurl.$row["logo"].'" alt="'.$row["jobtitle"].'" /></a>'; } else { $imgurl = '<a href="'.$baseurl.'job-details.php?jobid='.$row["id"].'" title="'.$row["jobtitle"].'"><img src="'.$baseurl.'images/no-pic-com-logo.jpg" alt="'.$row["jobtitle"].'" /></a>'; }
         
         if(!empty($row["location"])) { $showlocation = ", ".$array_location_all[$row["location"]]; } else { $showlocation =""; }
         
         if($row["section"]=="Shore") { $showcategory = $array_category_shore[$row["category"]]; } else { $showcategory = $array_category_offshore[$row["category"]]; }
         
         $stringhtml .= '<div class="row"   id="job-content"> 
                
                <div class="col-md-8">
                <h5>Rank :<a href="'.$baseurl.'job-details.php?jobid='.$row["id"].'" title="'.$row["jobtitle"].'"> '.$row["jobtitle"].'</a></h5>
                <span style="color:#b1035ff0";><i class="fa fa-building-o" aria-hidden="true"></i>&nbsp Company :Confidential</span> ,  &nbsp 
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> Vessel Type : <span class="'. $confidential.'" > '.$row["vessel"].' </span></span><br>
             <span><i class="fa fa-usd" aria-hidden="true"></i> Salary : <span class="'. $confidential.'" >  '.$row["salary"].' </span> </span> ,   &nbsp
             <span> <i class="fas fa-briefcase" aria-hidden="true"></i> Experience : <span class="'. $confidential.'" > '.$row["experience"].' </span></span><br>
             <span><i class="fa fa-calendar" aria-hidden="true"></i> Posted Date :'.date('d-m-Y',strtotime($row["add_date"])).'
              &nbsp  <b><span class="text-muted">Posted in '.$showcategory.' <em>('.$row["jobarea"].' Job)</em></span></b>    </span>                          
                </div>


                <div class="col-md-4">
                        
                <a style="color:white !important"; href="'.$baseurl.'applyjob1.php?jobid='.$row["id"].'"  jobid="'.$row["id"].'" title="'.$row["jobtitle"].'" class="btn job">
               	Apply Now </a>
                      </div>                                                                                           
                                    
                                   
                    
                             </div>
                            ';
     }

  /* ------start---------new format job-----------------*/
 
 $firstpage=1;
 $nextpage=(int)$page+1;
 $previouspage=(int)$nextpage-2;	
 $nnextpage=(int)$nextpage+1;	
 $nnnextpage=(int)$nnextpage+1;
 $nextpage2=(int)$nnnextpage+1;

 $lastPage = ceil($totcount / 5); 

 
 $newcount=(int)($page-1)*5+1;
 $newcount2=(int)$newcount+4;    

 if($totcount==0){
   $newcount=0;
  }else{
   $newcount=(int)($page-1)*5+1;
  }

 

 

 if($rcount==5){

  

  $stringhtml .="<tr>
 
        <td colspan='6' align='left' style='border-right: none;'>
        Showing ".$newcount." to  ".$newcount2." of ".$totcount." records
       </td>
     
       <td colspan='7' align='right'>
 
        ";

  $stringhtml .="</br><div class='col-lg-12'><div class='row' align='center';><tr>

			<td colspan='11' align='right'>
 			";

 

 $stringhtml .="<ul class='pagination'>

		  <li class='nextpage' id='".$firstpage."' action='".$action."' >First Page</li>";  
     
     	  
		  if($page>1){ 

			$stringhtml .="<li class='nextpage' id='".$previouspage."'  action='".$action."' >Previous Page</li>
      <li class='nextpage' id='".$previouspage."'  action='".$action."' >".$previouspage."</li>	";

		  }
      else{

      }

       

    $stringhtml .=" <li class='nextpage' id='".$page."' style='color: white;background-color:#1ccae3;' 
      action='".$action."' >".$page."</li>
 
    <li class='nextpage' id='".$nextpage."' action='".$action."' >".$nextpage."</li>  		 
  

	  <li class='nextpage' id='".$nextpage."'  action='".$action."' >Next Page</li>

		  </ul></div></div> 

		";	 

 
    }
    else{
      
     
         
     if($totcount>0){    

      $stringhtml .="<tr>
  
          <td colspan='6' align='left' style='border-right: none;'>
          Showing ".$newcount." to  ".$totcount." of ".$totcount." records
          </td>  
          <td colspan='7' align='right'>
            <ul class='pagination' style='float: right;'>
            <li class='nextpage' id='".$firstpage."' action='".$action."'>First Page</li>
            <li class='nextpage' id='".$previouspage."' action='".$action."'>Previous Page</li></ul>
          </td>
  
           </tr>";
     }
     else{
          echo "<b>No Record Found.....!!!</b>";
     }
    
    }

   echo $stringhtml;


?>

   <script src="bower_components/jquery/dist/jquery.min.js"></script>   