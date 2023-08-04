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


    $vaccine_name  = $_POST['vaccine_name'];
    $vaccine1_date = $_POST['vaccine1_date'];
    $vaccine2_date = $_POST['vaccine2_date'];


    if(!empty($_GET['edit'])){

       
        $update="UPDATE ss_jobseekers SET  vaccine_name = '".$vaccine_name."', vaccine1_date = '".$vaccine1_date."', 
        vaccine2_date = '".$vaccine2_date."' where id='".$_GET['edit']."' "; 

        $updatevaccine = $db->query($update);	

    if($updatevaccine){

        echo "<script>alert('Record Updated Successfully');window.location.href='jobseekers-covidedetails.php';</script>";

    }

    }


    else{

    $insert = "UPDATE ss_jobseekers SET  vaccine_name = '".$vaccine_name."', vaccine1_date = '".$vaccine1_date."', 
    vaccine2_date = '".$vaccine2_date."' where id='".$_SESSION["USER"]['ID']."' "; 
	$update_result = $db->query($insert);

    if($update_result){  
            echo " Inserted";

            echo "<script>document.location.href='".$baseurl."jobseekers-covidedetails.php'</script>"; 
    }else{
    	   echo "Not Inserted"; 
    }


}




}

if(!empty($_GET['edit'])){

    $edit="select * FROM ss_jobseekers where id='".$_GET['edit']."' ";
    $editm = $db->query($edit);	
    $eres = $editm->rows;
                                             
  
  }

  foreach($eres as $key => $row1) {   $s_name = $row1['vaccine_name'];   } 

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
                <span><i class="fa fa-angle-right" aria-hidden="true">&nbsp;&nbsp;Covid Vaccine Details</i></span>
                
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
    		$query="SELECT * FROM ss_jobseekers WHERE id=".$_SESSION["USER"]['ID']." ";
	
    		$rs = $db->query($query);
    		$foundnum = $rs->num_rows;
	
		?>
        <?php if($foundnum>0) { ?>
        <div class="rws-module">
               <!-- <div class="mtitle">Passpost Data <span class="rws-addnewitem"><a href="jobseekers-education-add.php">Add New</a></span></div>   -->
                
                <div class="mtitle">Covid Vaccine Details <span class="rws-addnewitem"></span></div>
                <div class="rws-mcontent">
                    <?php if(isset($_SESSION["GtThanksMsg"])) { echo $_SESSION["GtThanksMsg"]; unset($_SESSION["GtThanksMsg"]); }
					if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); } ?>
                    <div class="orderlist">
					
                	
                	<table class="rwsorderitems" cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<thead>
                        	<tr>
                                <th>Covid Vaccine Name</th>
                                <th>Vaccine Date [Dose-1]</th>
                                <th>Vaccine Date [Dose-1]</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$rowlist = $rs->rows;
						$j=1; foreach($rowlist as $key => $row) { 						
						?>
                        	<tr <?php echo $gtclasstr;?>>
                                <td><?php echo $row["vaccine_name"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row['vaccine1_date']));?></td>
                                <td><?php echo date('d-m-Y',strtotime($row['vaccine1_date']));?></td>
                 
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


                <div class="mtitle">Covid Vaccine Details</div>
                <br>


                	<div class="rws-fields">
                		<div class="col-sm-4">

                        <label>Select Vaccine Name</label><br/>

          				 <?php
 		              
 		                    $vaccine="SELECT * FROM vaccine_name where status='1' order by name asc";

                            $result = $db->query($vaccine);
	                        $rowlist = $result->rows;
              		    ?>

              			<select name="vaccine_name" required>
    					<option selected >-- Select Vaccine Name --</option>
    								
    					<?php
        				    foreach($rowlist as $key => $row)
	                        {
                                if($row['name']== $s_name){
            					echo "<option  value='". $row['name'] ."' selected>" .$row['name'] ."</option>"; 
                                }else{
                                    echo "<option  value='". $row['name'] ."'>" .$row['name'] ."</option>";   
                                }
        					}	
    					?>  
  						</select>

  						</div>    

  						<div class="col-sm-4">

                        <label>Covid Vaccine Date [Dose-1]</label><br/>
                        <input type="date" value="<?php  foreach($eres as $key => $row1) { echo $row1['vaccine1_date'];   } ?>" name="vaccine1_date" required/>
                        

  						</div>    


                      	<div class="col-sm-4">

                        <label>Covid Vaccine Date [Dose-2]</label><br/>
                        <input type="date" value="<?php  foreach($eres as $key => $row1) { echo $row1['vaccine2_date'];   } ?>" name="vaccine2_date"  required>
                      

  						</div>    


                    </div>

                	<!-- Row Ends -->
 
                    <div class="rws-fields row">
                      
                    </div>
            		<!-- Row Ends -->                    
                    
                </div>
            </div>
            <!-- Box Ends -->
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="submit" id="submit" class="rwsbutton width_100"  value="Submit" /> &nbsp;&nbsp; 
                 <!--   <input type="button" value="Back" onClick="document.location.href='jobseekers-education-add.php'" class="rwsbutton width_100" />    -->
                    <input type="button" value="Next" onClick="document.location.href='jobseekers-generate-cv.php'" class="rwsbutton width_100" />     
                </div>
            </div>
     </form>   
            
        </div>
      
    
    </div>
    
</div>
</div>
