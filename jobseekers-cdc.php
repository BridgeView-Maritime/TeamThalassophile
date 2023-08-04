<style>
	table tr th{
		text-align:center;
	}
	table {
		text-align:center;
	}
</style>


<?php

 include("includes/config.php");  



 if(isset($_POST['submit']))
{		


    $country = $_POST['country'];
    $cdc_no = $_POST['cdc_no'];
    $issue_date2 = $_POST['issue_date2'];
    $expire_date2 = $_POST['expire_date2'];


    if(!empty($_GET['edit'])){

       
        $update="UPDATE ss_jobseekers_cdc SET js_id = '".$_SESSION["USER"]['ID']."', country = '".$country."', cdc_no = '".$cdc_no."', issue_date2 = '".$issue_date2."', expire_date2 = '".$expire_date2."'
        where id='".$_GET['edit']."' "; 

        $updatecdc = $db->query($update);	

    if($updatecdc){

        echo "<script>alert('Record Updated Successfully');window.location.href='jobseekers-cdc.php';</script>";

                }

    }

    else{
    $insert = "INSERT INTO `ss_jobseekers_cdc` SET js_id = '".$_SESSION["USER"]['ID']."', country = '".$country."', cdc_no = '".$cdc_no."', issue_date2 = '".$issue_date2."', expire_date2 = '".$expire_date2."'"; 
	$update_result = $db->query($insert);


    if($update_result){
            echo " Inserted";

            echo "<script>document.location.href='".$baseurl."jobseekers-cdc.php'</script>"; 
    }else{
    	   echo "Not Inserted";
    }
}



}


if(!empty($_GET['edit'])){

    $edit="select * FROM ss_jobseekers_cdc where id='".$_GET['edit']."' ";
    $editm = $db->query($edit);	
    $eres = $editm->rows;
                                             
  
  }

  foreach($eres as $key => $row1) {   $s_country = $row1['country'];   } 


?>



<!-- RWS Header Starts -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
       <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="<?php echo $baseurl;?>images/favicon.png">
<title>Team Thalassophile !</title>        
<link href="<?php echo $baseurl;?>css/global.css" rel="stylesheet">
        <!-- Custom styles for this template -->
<link href="<?php echo $baseurl;?>css/style.css" rel="stylesheet">
<link href="<?php echo $baseurl;?>css/responsiveness.css" rel="stylesheet">




<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true">&nbsp;&nbsp;CDC</i></span>
                
            </div>
        </div>
    </div>
</div>
 
<!-- RWS Dashboard Starts -->


<div class="rws-maincontentinner">
	<div class="container">
    <div class="row">
    	<div class="col-md-4">
        	<?php include("app/jobseekers-leftmenu.php"); ?>        	
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">

     <!---------------show data table----------->

          <?php
    		$query="SELECT * FROM ss_jobseekers_cdc WHERE js_id=".$_SESSION["USER"]['ID']." ";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
               <!-- <div class="mtitle">Passpost Data <span class="rws-addnewitem"><a href="jobseekers-education-add.php">Add New</a></span></div>   -->
                
                <div class="mtitle">CDC Details <span class="rws-addnewitem"></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>CDC Issuing Country</th>
                                <th>CDC Number</th>
                                <th>Date Of Issue</th>
                                <th>Date Of Expire</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["country"]; ?></td>
                                <td><?php echo $row["cdc_no"]; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row['issue_date2']));?></td>
                        <td><?php echo date('d-m-Y',strtotime($row['expire_date2']));?></td>
                        <!--    <td><?php echo $row["issue_date2"]; ?></td>
                                <td><?php echo $row["expire_date2"]; ?></td>     -->
                                <td>
                                <a href="?edit=<?php echo $row['id']; ?>"
                                   post_id="<?php  echo $row["id"]; ?>" 
                                   title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                 </td>
                            </tr>
                           <?php } ?> 
                        </tbody>
                    </table>
                
                    

                </div>
                </div>
            </div>
            <?php } ?>
        
        

        <!---------------------end-------------------->
        

        <form action="" method="post">
        	<div class="rws-module">
                <div class="rws-mcontent">
                <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>


                <div class="mtitle">CDC  Details </div>
                <br>


                	<div class="rws-fields">
                		<div class="col-sm-6">

                        <label> CDC Issuing Country </label><br/>

          				 <?php
 		              
 		                    $country="select * from ss_countries  where country!='' GROUP BY country order by country ASC";

                            $result = $db->query($country);
	                        $rowlist = $result->rows;
              		    ?>

              			<select name="country" required>
    					<option selected >-- Select Country --</option>
    								
    					<?php
        				    foreach($rowlist as $key => $row)
	                        {
                                if($row['country']== $s_country){
                                    echo "<option  value='". $row['country'] ."' selected>" .$row['country'] ."</option>"; 
                                    }else{
            					echo "<option  value='". $row['country'] ."'>" .$row['country'] ."</option>"; 
                                    }
        					}	
    					?>  
  						</select>

  						</div>    

  						<div class="col-sm-6">

                        <label>CDC Number</label><br/>
                        <input type="text" name="cdc_no" id="cdc_no" value="<?php  foreach($eres as $key => $row1) { echo $row1['cdc_no'];   } ?>" required>

  						</div>    


                    </div>

                	<!-- Row Ends -->
 
                    <div class="rws-fields row">
                        <div class="col-sm-6">
                            	<label>Date Of Issue</label><br/>
                            	<input type="date" name="issue_date2" value="<?php  foreach($eres as $key => $row1) { echo $row1['issue_date2'];   } ?>" required/>
                        </div>
                        <div class="col-sm-6">
                        	    <label>Date Of Expire</label><br/>
                            <input type="date" name="expire_date2"  value="<?php  foreach($eres as $key => $row1) { echo $row1['expire_date2'];   } ?>" required/>
                        </div>
                    </div>
            		<!-- Row Ends -->                    
                    
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="submit" id="submit" class="rwsbutton width_100"  value="Submit" /> &nbsp;&nbsp; 
              <!--      <input type="button" value="Back" onClick="document.location.href='jobseekers-education-add.php'" class="rwsbutton width_100" />      -->
              <input type="button" value="Next" onClick="document.location.href='jobseekers-certificate-add.php'" class="rwsbutton width_100" />     
                </div>
            </div>
      </form>    
            
        </div>
        
    </div>
    
</div>
</div>
