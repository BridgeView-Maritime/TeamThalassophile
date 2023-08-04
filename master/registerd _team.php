
<?php include('header.php');
$gtpage = 'candidate_approve';
$listjs = 1;

$today=date('Y-m-d');


$record_per_page = 10;

$output = '';


 if(isset($_POST['page'])){

 	$page=$_POST['page'];

 }else{

 	$page=1;
 }


 $start_from=($page-1)*$record_per_page;

 $table="";

/*

 	$addresume="select * from addresume where emailid!='' AND presentrank Like '%".$esearch."%' order by DATE(cdate) DESC limit $start_from,$record_per_page";

*/


if(isset($_POST['esearch']) || isset($_POST['eship']) || isset($_POST['ename']) || isset($_POST['indos']) || isset($_POST['eemail']) || isset($_POST['erank']) || isset($_POST['epassport']) || isset($_POST['ecdc']) ){

	 @$esearch=$_POST['esearch'];
	 $eship=$_POST['eship'];
	 $ename=$_POST['ename'];
	 $indos=$_POST['indos'];
	 $eemail=$_POST['eemail'];
	 $erank=$_POST['erank'];
	 $epassport=$_POST['epassport'];
	 $ecdc=$_POST['ecdc'];



$addresume="select * from addresume where emailid!='' AND nationality='Other' AND fullname!='' AND presentrank Like '%".$esearch."%' AND shiptype Like '%".$eship."%' AND fullname Like '%".$ename."%'  AND emailid like '%".$eemail."%' AND presentrank Like '%".$erank."%' AND  passportno Like '%".$epassport."%' AND seamanbno Like '%".$ecdc."%'  order by resumeid DESC limit $start_from,$record_per_page";
 


$tot="select * from addresume where emailid!=''  AND nationality='Other' AND fullname!='' AND presentrank Like '%".$esearch."%' AND shiptype Like '%".$eship."%' AND fullname Like '%".$ename."%'  AND emailid like '%".$eemail."%' AND presentrank Like '%".$erank."%' AND passportno Like '%".$epassport."%' AND seamanbno Like '%".$ecdc."%'  order by resumeid DESC";

 }else{



// $addresume="select * from addresume where emailid!='' AND nationality='Other'  order by resumeid DESC  $start_from,$record_per_page";
$jsquery="SELECT * FROM ss_jobseekers where add_date like '%" . $date . "%' ";

    $jsquery="SELECT * FROM ss_jobseekers where add_date like '%" . $date . "%' ";


    $jsquery="select * from ss_jobseekers where DATE(add_date) between DATE' ".$fdate."' AND DATE '".$ldate."' ";

}



 

 $table .="
 		   <table id='datatable' class='table-responsive  table-striped table-striped table-bordered dataTable table'>
           <thead >
 		  	<tr>
                <th scope='col'>Sr No</td>			   
				<th scope='col'>Full Name</td>
				<th scope='col'>Mobile</td>
				<th scope='col'>Rank</td>
				<th scope='col'>Passport</td>		
				<th scope='col' style='width: 70px;'>DOB</td>		
				<th scope='col'>Email ID</td>
				<th scope='col'>Available Date</td>
 		  		<th scope='col'>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
               </tr>
             </thead>
 		  ";

$sr=($page-1)*10+1;

while($erows=mysqli_fetch_assoc($rconnect)){

	$chatbox=exeQuery("SELECT * FROM chatbox where emailid='".$erows['emailid']."' order by id desc limit 1 ");

	$canstatus=exeQuery("SELECT * FROM visiter where indosno='".$erows['indosno']."' ");
	$canstatusres=mysqli_fetch_assoc($canstatus);

	$cehckonboard=exeQuery("SELECT * FROM contractnew where signondate!='0000-00-00' and signoffdate='1000-01-01' and vcan_id='".$erows['indosno']."' ");

	$table .="<tr class='table-bordered' style='text-align:center'>";
	$table .="<td>".$sr++."</td>";
	

	if($cehckonboard->num_rows > 0){
		$table.= "<br><span class='badge' style='color:white;background-color:#3f51b5;'>Onboard</span>";
	}


	if($chatbox->num_rows > 0){

		$chatres=mysqli_fetch_assoc($chatbox);

		$table .="<br><span class='badge feedback' emailid='".$erows['emailid']."' fullname='".ucwords(strtolower($erows['fullname']))."' indosno='".$erows['indosno']."' vid='".$canstatusres['vs_id']."' style='color: #fff;background-color: #007bff;cursor:pointer;' title='click here to add feedback'>Feedback on<br> ".date('d-m-Y H:i:s',strtotime($chatres['date']))."<br> By ".strtolower($chatres['user'])."</span>";

		
	 }
	
	
	
	$table.= "</td>";
	$table .="<td align='left'>".ucwords(strtolower($erows['fullname']))."";

	

	$table .= vaccination_details($erows['vaccine'],$erows['vaccine1'],$erows['vaccine2']); //vaccination function comming from RF_function.php
      
	if($canstatusres['status']=="0"){
		$table .="<br>".	candidate_blacklist($canstatusres['dstatus'],$canstatusres['dremark']);
	}

    $table .=" </td>";
	$table .="<td>".$erows['phoneno']."</td>";
	$table .="<td>".preg_replace('/[^[:print:]]/', '',$erows['presentrank']). "</td>";
	$table .="<td>".$erows['passportno']. "</td>";

        
	if($erows['dob']!==''){
        $dob=date('d-m-Y',strtotime($erows['dob']));
	}else{
		$dob="";
	}
	$table .="<td>".$dob."</td>";

	$table .="<td>".$erows['emailid']."</td>";
    if(!empty($erows['availablefrom'])){
	$table .="<td align='left'>".date('d F Y',strtotime($erows['availablefrom']))."</td>";
    }else{
    $table .="<td align='left'>N/A</td>";
    }
	if($erows['photo']!==''){

		$table .="<td>

				<span class='feedback' indosno='".strtoupper($erows['indosno'])."' fullname='".$erows['fullname']."' emailid='".$erows['emailid']."' vid='".$canstatusres['vs_id']."' style='color:blue;cursor:pointer;'><i class='glyphicon glyphicon-envelope' title='Add feedback'></i></span>

	             <span class='fa fa-eye viewfullresume span_blue' style='color:blue;cursor:pointer;' id='".$erows['indosno']."'  emailid='".$erows['emailid']."' title='View Candidate CV'></span>&nbsp; ";

				 $path='../../upload/'.$erows['photo'].'';

				 $pathinfo = pathinfo($path);

				 $extension= $pathinfo['extension'];

				 if($extension=="pdf"){

					$table .="<a href='view_pdf.php?view=".$path."' target='_blank' ><span  class='fa fa-download span_red' style='color:red;cursor:pointer;' title='Download Original CV'></span></a>&nbsp;";

				 }else{
					$table .=" <a href='../../upload/".$erows['photo']."' target='_blank' ><span  class='fa fa-download span_red' style='color:red;cursor:pointer;' title='Download Original CV'></span></a>&nbsp;";
				 }


				 $table .="	 <a href='javascript:void(0)'  style='color:black;cursor:pointer;' class='pinfo fa fa-edit ' data-toggle='modal' data-target='#pinfomodal'
				            fullname='".$erows['fullname']."'
                            emailid='".$erows['emailid']."'
                            indosno='".$erows['indosno']."'
                            phoneno='".$erows['phoneno']."'
							mobileno='".$erows['mobileno']."'
							passportno='".$erows['passportno']."'							
                            presentrank='".$erows['presentrank']."'
                    
                             ></span></a>
		      </td>";

	}else{
	$table .="<td>

				<span class='feedback' indosno='".strtoupper($erows['indosno'])."' fullname='".$erows['fullname']."' emailid='".$erows['emailid']."' vid='".$canstatusres['vs_id']."' style='color:blue;cursor:pointer;'><i class='glyphicon glyphicon-envelope' title='Add feedback'></i></span>


	             <span class='fa fa-eye viewfullresume span_blue' style='color:blue;cursor:pointer;'  id='".$erows['indosno']."'  emailid='".$erows['emailid']."' title='View Candidate CV'></span>&nbsp;

				 <a href='javascript:void(0)'  style='color:black;cursor:pointer;' class='pinfo fa fa-edit' data-toggle='modal' data-target='#pinfomodal'
				 fullname='".$erows['fullname']."'
				 emailid='".$erows['emailid']."'
				 indosno='".$erows['indosno']."'
				 phoneno='".$erows['phoneno']."'
				 passportno='".$erows['passportno']."'
				
				 presentrank='".$erows['presentrank']."'
		         ></a>
		      </td>";
	}


               

	$table .="</tr>";

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

 if($rcount==10){

 $table .="<tr>

 			<td colspan='6' align='left' style='border-right: none;'>
			 Showing ".$newcount." to  ".$newcount2." of ".$totcount." records
			</td>


			<td colspan='7' align='right'>

 			";



$table .="
     <ul class='pagination' style='float: right;'>
		  <li class='nextpage' id='".$firstpage."'>First Page</li>";


		  if($page>2){
			$table .="<li class='nextpage' id='".$previouspage."'> << </li>
					 <li class='nextpage' id='".$previouspage."' >".$previouspage."</li>
					 ";
		  }
      else{
       }

	   $table .=" <li class='nextpage' id='".$page."' style='color: white;background-color: #1e88e5;'>".$page."</li>
				<li class='nextpage' id='".$nextpage."'>".$nextpage."</li>
				<li class='nextpage' id='".$nextpage."'> >> </li>


		  </ul>
		";

//  }



 }
  else{
 	 $table .="<tr>

				<td colspan='6' align='left' style='border-right: none;'>
				Showing ".$newcount." to  ".$totcount." of ".$totcount." records
				</td>

				<td colspan='7' align='right'>
					<ul class='pagination' style='float: right;'>
					<li class='nextpage' id='".$firstpage."'>First Page</li>
					<li class='nextpage' id='".$previouspage."'>Previous Page</li></ul>
				</td>

 	 	   </tr>";
  }
 $table .="</table>";

 echo $table;

?>


<?php

	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=file.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

	include("../library/RF_function.php");


$record_per_page = 10;

$output = '';


 if(isset($_POST['page'])){

 	$page=$_POST['page'];

 }else{

 	$page=1;
 }


 $start_from=($page-1)*$record_per_page;

 $table="";

/*

 	$addresume="select * from addresume where emailid!='' AND presentrank Like '%".$esearch."%' order by DATE(cdate) DESC limit $start_from,$record_per_page";

*/


if(isset($_POST['esearch']) || isset($_POST['eship']) || isset($_POST['ename']) || isset($_POST['indos']) || isset($_POST['eemail']) || isset($_POST['erank']) || isset($_POST['epassport']) || isset($_POST['ecdc']) ){

	 @$esearch=$_POST['esearch'];
	 $eship=$_POST['eship'];
	 $ename=$_POST['ename'];
	 $indos=$_POST['indos'];
	 $eemail=$_POST['eemail'];
	 $erank=$_POST['erank'];
	 $epassport=$_POST['epassport'];
	 $ecdc=$_POST['ecdc'];



$addresume="select * from addresume where emailid!='' AND nationality='Other' AND fullname!='' AND presentrank Like '%".$esearch."%' AND shiptype Like '%".$eship."%' AND fullname Like '%".$ename."%'  AND emailid like '%".$eemail."%' AND presentrank Like '%".$erank."%' AND  passportno Like '%".$epassport."%' AND seamanbno Like '%".$ecdc."%'  order by resumeid DESC limit $start_from,$record_per_page";
 


$tot="select * from addresume where emailid!=''  AND nationality='Other' AND fullname!='' AND presentrank Like '%".$esearch."%' AND shiptype Like '%".$eship."%' AND fullname Like '%".$ename."%'  AND emailid like '%".$eemail."%' AND presentrank Like '%".$erank."%' AND passportno Like '%".$epassport."%' AND seamanbno Like '%".$ecdc."%'  order by resumeid DESC";

 }else{



// $addresume="select * from addresume where emailid!='' AND nationality='Other'  order by resumeid DESC  $start_from,$record_per_page";
$addresume="select * from addresume where emailid!='' AND DATE(availablefrom) between DATE' ".$fdate."' AND DATE '".$ldate."' ";
$tot="select * from addresume where emailid!='' AND nationality='Other' order by resumeid DESC";

}



 $rconnect=mysqli_query($shipconn,$addresume);
 $rcount=mysqli_num_rows($rconnect);

 $totconnect=mysqli_query($shipconn,$tot);
 $totcount=mysqli_num_rows($totconnect);

 $table .="
 		   <table id='datatable' class='table-responsive  table-striped table-striped table-bordered dataTable table'>
           <thead >
 		  	<tr>
                <th scope='col'>Sr No</td>			   
				<th scope='col'>Full Name</td>
				<th scope='col'>Mobile</td>
				<th scope='col'>Rank</td>
				<th scope='col'>Passport</td>		
				<th scope='col' style='width: 70px;'>DOB</td>		
				<th scope='col'>Email ID</td>
				<th scope='col'>Available Date</td>
 		  		<th scope='col'>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
               </tr>
             </thead>
 		  ";

$sr=($page-1)*10+1;

while($erows=mysqli_fetch_assoc($rconnect)){

	$chatbox=exeQuery("SELECT * FROM chatbox where emailid='".$erows['emailid']."' order by id desc limit 1 ");

	$canstatus=exeQuery("SELECT * FROM visiter where indosno='".$erows['indosno']."' ");
	$canstatusres=mysqli_fetch_assoc($canstatus);

	$cehckonboard=exeQuery("SELECT * FROM contractnew where signondate!='0000-00-00' and signoffdate='1000-01-01' and vcan_id='".$erows['indosno']."' ");

	$table .="<tr class='table-bordered' style='text-align:center'>";
	$table .="<td>".$sr++."</td>";
	

	if($cehckonboard->num_rows > 0){
		$table.= "<br><span class='badge' style='color:white;background-color:#3f51b5;'>Onboard</span>";
	}


	if($chatbox->num_rows > 0){

		$chatres=mysqli_fetch_assoc($chatbox);

		$table .="<br><span class='badge feedback' emailid='".$erows['emailid']."' fullname='".ucwords(strtolower($erows['fullname']))."' indosno='".$erows['indosno']."' vid='".$canstatusres['vs_id']."' style='color: #fff;background-color: #007bff;cursor:pointer;' title='click here to add feedback'>Feedback on<br> ".date('d-m-Y H:i:s',strtotime($chatres['date']))."<br> By ".strtolower($chatres['user'])."</span>";

		
	 }
	
	
	
	$table.= "</td>";
	$table .="<td align='left'>".ucwords(strtolower($erows['fullname']))."";

	

	$table .= vaccination_details($erows['vaccine'],$erows['vaccine1'],$erows['vaccine2']); //vaccination function comming from RF_function.php
      
	if($canstatusres['status']=="0"){
		$table .="<br>".	candidate_blacklist($canstatusres['dstatus'],$canstatusres['dremark']);
	}

    $table .=" </td>";
	$table .="<td>".$erows['phoneno']."</td>";
	$table .="<td>".preg_replace('/[^[:print:]]/', '',$erows['presentrank']). "</td>";
	$table .="<td>".$erows['passportno']. "</td>";

        
	if($erows['dob']!==''){
        $dob=date('d-m-Y',strtotime($erows['dob']));
	}else{
		$dob="";
	}
	$table .="<td>".$dob."</td>";

	$table .="<td>".$erows['emailid']."</td>";
    if(!empty($erows['availablefrom'])){
	$table .="<td align='left'>".date('d F Y',strtotime($erows['availablefrom']))."</td>";
    }else{
    $table .="<td align='left'>N/A</td>";
    }
	if($erows['photo']!==''){

		$table .="<td>

				<span class='feedback' indosno='".strtoupper($erows['indosno'])."' fullname='".$erows['fullname']."' emailid='".$erows['emailid']."' vid='".$canstatusres['vs_id']."' style='color:blue;cursor:pointer;'><i class='glyphicon glyphicon-envelope' title='Add feedback'></i></span>

	             <span class='fa fa-eye viewfullresume span_blue' style='color:blue;cursor:pointer;' id='".$erows['indosno']."'  emailid='".$erows['emailid']."' title='View Candidate CV'></span>&nbsp; ";

				 $path='../../upload/'.$erows['photo'].'';

				 $pathinfo = pathinfo($path);

				 $extension= $pathinfo['extension'];

				 if($extension=="pdf"){

					$table .="<a href='view_pdf.php?view=".$path."' target='_blank' ><span  class='fa fa-download span_red' style='color:red;cursor:pointer;' title='Download Original CV'></span></a>&nbsp;";

				 }else{
					$table .=" <a href='../../upload/".$erows['photo']."' target='_blank' ><span  class='fa fa-download span_red' style='color:red;cursor:pointer;' title='Download Original CV'></span></a>&nbsp;";
				 }


				 $table .="	 <a href='javascript:void(0)'  style='color:black;cursor:pointer;' class='pinfo fa fa-edit ' data-toggle='modal' data-target='#pinfomodal'
				            fullname='".$erows['fullname']."'
                            emailid='".$erows['emailid']."'
                            indosno='".$erows['indosno']."'
                            phoneno='".$erows['phoneno']."'
							mobileno='".$erows['mobileno']."'
							passportno='".$erows['passportno']."'							
                            presentrank='".$erows['presentrank']."'
                    
                             ></span></a>
		      </td>";

	}else{
	$table .="<td>

				<span class='feedback' indosno='".strtoupper($erows['indosno'])."' fullname='".$erows['fullname']."' emailid='".$erows['emailid']."' vid='".$canstatusres['vs_id']."' style='color:blue;cursor:pointer;'><i class='glyphicon glyphicon-envelope' title='Add feedback'></i></span>


	             <span class='fa fa-eye viewfullresume span_blue' style='color:blue;cursor:pointer;'  id='".$erows['indosno']."'  emailid='".$erows['emailid']."' title='View Candidate CV'></span>&nbsp;

				 <a href='javascript:void(0)'  style='color:black;cursor:pointer;' class='pinfo fa fa-edit' data-toggle='modal' data-target='#pinfomodal'
				 fullname='".$erows['fullname']."'
				 emailid='".$erows['emailid']."'
				 indosno='".$erows['indosno']."'
				 phoneno='".$erows['phoneno']."'
				 passportno='".$erows['passportno']."'
				
				 presentrank='".$erows['presentrank']."'
		         ></a>
		      </td>";
	}


               

	$table .="</tr>";

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

 if($rcount==10){

 $table .="<tr>

 			<td colspan='6' align='left' style='border-right: none;'>
			 Showing ".$newcount." to  ".$newcount2." of ".$totcount." records
			</td>


			<td colspan='7' align='right'>

 			";



$table .="
     <ul class='pagination' style='float: right;'>
		  <li class='nextpage' id='".$firstpage."'>First Page</li>";


		  if($page>2){
			$table .="<li class='nextpage' id='".$previouspage."'> << </li>
					 <li class='nextpage' id='".$previouspage."' >".$previouspage."</li>
					 ";
		  }
      else{
       }

	   $table .=" <li class='nextpage' id='".$page."' style='color: white;background-color: #1e88e5;'>".$page."</li>
				<li class='nextpage' id='".$nextpage."'>".$nextpage."</li>
				<li class='nextpage' id='".$nextpage."'> >> </li>


		  </ul>
		";

//  }



 }
  else{
 	 $table .="<tr>

				<td colspan='6' align='left' style='border-right: none;'>
				Showing ".$newcount." to  ".$totcount." of ".$totcount." records
				</td>

				<td colspan='7' align='right'>
					<ul class='pagination' style='float: right;'>
					<li class='nextpage' id='".$firstpage."'>First Page</li>
					<li class='nextpage' id='".$previouspage."'>Previous Page</li></ul>
				</td>

 	 	   </tr>";
  }
 $table .="</table>";

 echo $table;

?>


