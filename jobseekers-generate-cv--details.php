




<style>
    table {

        font-family: arial, sans-serif;

        border-collapse: collapse;

        width: 100%;

    }
 
 
 .demo td, th {

        border: 1px solid #dddddd;

        text-align: left;

        padding: 8px;

        width:130px;

  }


  .demo tr:nth-child(even) {

  background-color: #dddddd;

}


</style>

<?php  //include("includes/config.php"); 
// Get the jobseekers personal info
$select_query 		= 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowut 				= $select_result->row;

// Get the jobseekers availability info
$select_query 		= 'SELECT * FROM `ss_jobseekers_availability` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowavlist 			= $select_result->rows;
$avlisttotal 		= $select_result->num_rows;


// Get the jobseekers employment history info
$select_query 		= 'SELECT * FROM `ss_jobseekers_employment` WHERE  js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowemplist 		= $select_result->rows;
$emplisttotal 		= $select_result->num_rows;


// Get the education info
$select_query 		= 'SELECT * FROM `ss_jobseekers_education` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowedulist 		= $select_result->rows;
$edulisttotal 		= $select_result->num_rows;


// Get the COC certificate info
$select_query 		= 'SELECT * FROM `ss_addcoc` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowcoclist 		= $select_result->rows;
$coctotal 		    = $select_result->num_rows;

      // Get the offshore certificate info
$select_query 		= 'SELECT * FROM `addoffshore` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowofflist 		= $select_result->rows;
$offtotal 		    = $select_result->num_rows;

      // Get the Other certificate info
$select_query 		= 'SELECT * FROM `addothers` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowotherlist 		= $select_result->rows;
$othertotal 		    = $select_result->num_rows;

      // Get the STCW certificate info
$select_query 		= 'SELECT * FROM `addstcw` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
$select_result 		= $db->query($select_query);
$rowstcwlist 		= $select_result->rows;
$stcwtotal 		    = $select_result->num_rows;

  // Get the passport info
  $select_query 		= 'SELECT * FROM `ss_jobseekers_passport` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
  $select_result 		= $db->query($select_query);
  $rowpasslist 		= $select_result->rows;
  $passporttotal 		= $select_result->num_rows;

      // Get the cdc info
  $select_query 		= 'SELECT * FROM `ss_jobseekers_cdc` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
  $select_result 		= $db->query($select_query);
  $rowcdclist 		= $select_result->rows;
  $cdctotal 		   = $select_result->num_rows;

     // Get the visa info
  $select_query 		= 'SELECT * FROM `ss_jobseekers_visa` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
  $select_result 		= $db->query($select_query);
  $rowvisalist 		= $select_result->rows;
  $visatotal 		    = $select_result->num_rows;

    // Get the NOK info
  $select_query 		= 'SELECT * FROM `nokdetails` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
  $select_result 		= $db->query($select_query);
  $rownoklist 		= $select_result->rows;
  $noktotal 		    = $select_result->num_rows;
			
?>

<div style="font-family:Verdana, Geneva, sans-serif; font-size:14px;">

    

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
<tr> 
  <td  align="left" valign="top" style="width:250px; border: none;">
   
<?php if(!empty($rowut['profile_pic'])) { echo '<img  src="'.$baseurl.$rowut['profile_pic'].'"  style="height:300px;width:200px;float:right; border: 2px solid black; margin-top:2px;" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
  
  </td>

  <td style="margin-left:100px;">

<h3 style="margin:0 0 10px 0;">Name : <?php echo $rowut['fullname'];?></h3>
 <!--  <p class="nomargin"><em>Name :</em>&nbsp;&nbsp;<?php  echo $rowut['fullname'];?></p>   -->
    <p class="rwscontactinfo nomargin"><em>Email :</em>&nbsp;&nbsp;<i class="far fa-envelope"></i> <?php echo $rowut['email'];?> </p>
    <p class="rwslocation nomargin"><em>Location :</em>&nbsp;&nbsp;<i class="fas fa-map-marker-alt"></i> <?php echo $rowut['location'];?>, <?php echo $rowut['country'];?></p>
    <p class="rwscontactinfo nomargin"><em>Mobile No :</em> <?php echo $rowut['mobile'];?></p>
    <p class="rwscontactinfo nomargin"><em>DOB :&nbsp;&nbsp; </em><?php echo $rowut['dateofbirth'];?></p>
    <p class="rwscontactinfo nomargin"><em>Rank Applied For :</em>&nbsp;&nbsp; <?php echo $rowut['applied_rank'];?></p>
    <p class="rwscontactinfo nomargin"><em>Last Rank :&nbsp;&nbsp;</em> <?php echo $rowut['rankname'];?></p>
    <p class="rwscontactinfo nomargin"><em>Availability From :&nbsp;&nbsp;</em> <?php echo date('d-m-Y',strtotime($rowut['availability_1_from']));?></p>
    <p class="rwscontactinfo nomargin"><em>Availability To :&nbsp;&nbsp; </em><?php echo date('d-m-Y',strtotime($rowut['availability_1_to']));?></p> 
      

    </td>
</tr>

</table>
   



<?php if(!empty($rowut['additional_skills'])) { ?>
<div class="rws-generalcvinfo">
    <h4>Additional Skills</h4>
    <?php echo $rowut['additional_skills']; ?>
</div>
<?php } ?>

<?php if(!empty($rowut['client_work_with'])) { ?>
<div class="rws-generalcvinfo">
    <h3>Client you worked with</h3>
    <?php echo $rowut['client_work_with']; ?>
</div>
<?php } ?>

<?php if(!empty($rowut['short_bio'])) { ?>
<div class="rws-generalcvinfo">
    <h4>Carrer Summary</h4>
    <?php echo $rowut['short_bio']; ?>
</div>
<?php } ?>

<!-- Availability -->
<?php if($avlisttotal>0) { ?>
<div class="rws-generalcvinfo">
  <h2>Availability</h2>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <?php foreach($rowavlist as $key_av=>$val_av)  { ?>
      <tr>
        <td align="left" valign="top"><em style="color: #1ba4dd;">From:</em> <?php echo toshowdateformated($val_av["start_date"]); ?></td>
        <td align="left" valign="top"><em style="color: #1ba4dd;">To:</em> <?php echo toshowdateformated($val_av["end_date"]); ?></td>
      </tr>
      <?php } ?>
    </table>
</div>
<?php } ?>	
<!-- Availability --> 


<!--------start---------new code(Sea Services Details)-------------------------->

<h2>Sea Services Details</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:110px;  color:white; background-color:#5b9cd6;">Company </th>              

                    <th style="width:110px;  color:white; background-color:#5b9cd6;">Ship Name</th>

                    <th style="width:110px;  color:white; background-color:#5b9cd6;">Ship Type</th>

                    <th style="width:110px;  color:white; background-color:#5b9cd6;">Sign On</th>           

                    <th style="width:110px;  color:white; background-color:#5b9cd6;">Sign Off</th>

                    <th style="width:110px;  color:white; background-color:#5b9cd6;">Total Days</th>

                

                   

                </tr>

                <?php

        $_SESSION['myForm']=array();

          $select_query = 'SELECT * FROM `ss_jobseekers_employment_details` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
          $select_result = $db->query($select_query);
          $empitems = $select_result->rows;
          $emptotal = $select_result->num_rows;

          if($emptotal>0)
          {
              foreach($empitems as $key => $rowemp) { 
                  $_SESSION['myForm']['company'][]			    = $rowemp["company"];
                  $_SESSION['myForm']['ship_name'][] 			= $rowemp["ship_name"];
                  $_SESSION['myForm']['ship_type'][] 			= $rowemp["ship_type"];
                  $_SESSION['myForm']['dp_system'][] 			= $rowemp["dp_system"];
                  $_SESSION['myForm']['grt'][] 				    = $rowemp["grt"];
                  $_SESSION['myForm']['kw'][] 				    = $rowemp["kw"];
                  $_SESSION['myForm']['position'][] 			= $rowemp["position"];
                  $_SESSION['myForm']['sign_on'][] 			    = toshowdateformated($rowemp["sign_on"]);
                  $_SESSION['myForm']['sign_off'][] 			= toshowdateformated($rowemp["sign_off"]);
                  $_SESSION['myForm']['total_days'][] 			= $rowemp["total_days"];
              }
          }

            
          if($emptotal>0) {

                  $ier=0;
                  foreach($_SESSION['myForm']["ship_name"] as $key_emp=>$val_emp) 
                  { 

                ?>

                <tr>

                <td style="width:110px;"><?php echo $_SESSION['myForm']['company'][$ier];?></td>  
      
                <td style="width:110px;"><?php echo $_SESSION['myForm']["ship_name"][$ier];?></td>

                <td style="width:110px;"> <?php echo $_SESSION['myForm']['ship_type'][$ier]; ?></td>

                <td style="width:110px;"><?php echo $_SESSION['myForm']['sign_on'][$ier]; ?></td>

                <td style="width:110px;">	<?php echo $_SESSION['myForm']['sign_off'][$ier]; ?></td>

                <td style="width:110px;">	<?php echo $_SESSION['myForm']['total_days'][$ier]; ?></td>


                </tr>

                  <?php $ier++; }  } ?>

        

          </table>



<!--------end-------------------------------------------------------------->


<!--------start---------new code(Education Details)-------------------------->

<h2>Education Details</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">University </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Degree</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Start Year</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">End Year</th>

                

                   

                </tr>

                <?php
           
                foreach($rowedulist as $key_edu=>$val_edu)  { 

                ?>

                <tr>

                <td style=" width:270px;"><?php echo $val_edu['school'];?></td>

                <td style=" width:130px;"><?php echo $val_edu['degree'];?></td>

                <td style=" width:130px;"><?php echo date('d-m-Y',strtotime($val_edu['start_year']));?></td>

                <td style=" width:130px;"><?php echo date('d-m-Y',strtotime($val_edu['end_year']));?></td>

                </tr>

                  <?php }  ?>

        

          </table>



<!--------end-------------------------------------------------------------->



<!--------start---------new code(Certificate COC)-------------------------->

<?php if($coctotal>0) { ?>

<h2>Certificates COC</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Certificate </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Certificate No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
           
                       foreach($rowcoclist as $key_cer=>$val_cer) { 

                ?>

                <tr>

                    <td  style="width:270px;" >	<?php echo $val_cer["cocname"]; ?></td>

                    <td  style="width:130px;" >	<?php echo $val_cer["cocnumber"]; ?></td>
                    
                    <td  style="width:130px;">	<?php echo date('d-m-Y',strtotime($val_cer["cocissue"])); ?></td>

                    <td  style="width:130px;">  <?php echo date('d-m-Y',strtotime($val_cer["cocexp"])); ?></td>


                </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->



<!--------start---------new code(Certificate OFFSHORE)-------------------------->

<?php if($offtotal>0) { ?>

<h2>Certificates Offshore</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Certificate </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Certificate No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
           
                      foreach($rowofflist as $key_cer=>$val_off)   { 

                ?>

                <tr>

                <td  style="width:270px;" >	<?php echo $val_off["certificate"]; ?></td>

                <td  style="width:130px;" >	<?php echo $val_off["number"]; ?></td>
                
                <td  style="width:130px;" >	<?php echo date('d-m-Y',strtotime($val_off["issuedate"])); ?></td>

                <td  style="width:130px;" >  <?php echo date('d-m-Y',strtotime($val_off["expdate"])); ?></td>
                 

                </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->



<!--------start---------new code(Certificate OTHER)-------------------------->

<?php if($othertotal>0) { ?>

<h2>Certificates Other</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Certificate </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Certificate No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
           
                       foreach($rowotherlist as $key_cer=>$val_other)   { 

                ?>

                <tr>


                <td  style="width:270px;" >	<?php echo $val_other["certificate"]; ?></td>

                <td  style="width:130px;" >	<?php echo $val_other["number"]; ?></td>

                <td  style="width:130px;" >	<?php echo date('d-m-Y',strtotime($val_other["issuedate"])); ?></td>

                <td  style="width:130px;" > <?php echo date('d-m-Y',strtotime($val_other["expdate"])); ?></td>

            
                </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->


<!--------start---------new code(Certificate STCW)-------------------------->

<?php if($stcwtotal>0) { ?>

<h2>Certificates STCW</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Certificate </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Certificate No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
            
                   foreach($rowstcwlist as $key_cer=>$val_stcw)   { 

                ?>

                <tr>


                <td  style="width:270px;" >	<?php echo $val_stcw["certificate"]; ?></td>

                <td  style="width:130px;" >	<?php echo $val_stcw["number"]; ?></td>
                
                <td  style="width:130px;" >	<?php echo date('d-m-Y',strtotime($val_stcw["issuedate"])); ?></td>

                <td  style="width:130px;" > <?php echo date('d-m-Y',strtotime($val_stcw["expdate"])); ?></td>

            
                </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->

<!--------start---------new code(Passport Details)-------------------------->

<?php if($passporttotal>0) { ?>

<h2>Passport Details</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Country </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Passport No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
            
                    foreach($rowpasslist as $key_pass=>$val_pass)   { 

                ?>

                <tr>


                <td  style="width:270px;" ><?php echo $val_pass["country"]; ?></td>

                <td  style="width:130px;" >	<?php echo $val_pass["passport_number"]; ?></td>

                <td  style="width:130px;" >	<?php echo date('d-m-Y',strtotime($val_pass["issue_date"])); ?></td>

                <td  style="width:130px;" ><?php echo date('d-m-Y',strtotime($val_pass["expire_date"])); ?></td>
                              
                 </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->

<!--------start---------new code(CDC Details)-------------------------->

<?php if($cdctotal>0) { ?>

<h2>CDC Details</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Country </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">CDC No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
            
                         foreach($rowcdclist as $key_cdc=>$val_cdc)   { 

                ?>

                <tr>


                <td  style="width:270px;" >	<?php echo $val_cdc["country"]; ?></td>

                <td  style="width:130px;" >	<?php echo $val_cdc["cdc_no"]; ?></td>

                <td  style="width:130px;" > <?php echo date('d-m-Y',strtotime($val_cdc["issue_date2"])); ?></td>

                <td  style="width:130px;" > <?php echo date('d-m-Y',strtotime($val_cdc["expire_date2"])); ?></td>
                                              
                 </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->


<!--------start---------new code(CDC Details)-------------------------->

<?php if($visatotal>0) { ?>

<h2>Visa Details</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:270px;  color:white; background-color:#5b9cd6;">Country </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Visa No</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Issue Date</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Expiry Date</th>

                

                   

                </tr>

                <?php
            
                          foreach($rowvisalist as $key_visa=>$val_visa)   { 

                ?>

                <tr>


                <td  style="width:270px;" >	<?php echo $val_visa["country"]; ?></td>

                <td  style="width:130px;" > <?php echo $val_visa["visa_type"]; ?></td>

                <td  style="width:130px;" > <?php echo date('d-m-Y',strtotime($val_visa["issue_date1"])); ?></td>

                <td  style="width:130px;" > <?php echo date('d-m-Y',strtotime($val_visa["expire_date1"])); ?></td>
                                              
                 </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->


<!--------start---------new code(CDC Details)-------------------------->

<?php if($noktotal>0) { ?>

<h2>NOK Details</h2>

        

<table class="demo" style="background-image: url(images/watermark2.png); ">

                <tr>

                    <th style="width:140px;  color:white; background-color:#5b9cd6;">NOK Name </th>              

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Relation</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Contact</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Email</th>

                    <th style="width:130px;  color:white; background-color:#5b9cd6;">Address</th>
                       
                </tr>

                <?php
            
                        foreach($rownoklist as $key_visa=>$val_nok)   { 

                ?>

                <tr>


                <td  style="width:140px;" >	<?php echo $val_nok["nokname"]; ?></td>

                <td  style="width:130px;" ><?php echo $val_nok["nokrel"]; ?></td>

                <td  style="width:130px;" ><?php echo $val_nok["nokcontact"]; ?></td>

                <td  style="width:130px;" ><?php echo $val_nok["nok_emailid"]; ?></td>

                <td  style="width:130px;" > <?php echo $val_nok["nokaddress"]; ?></td>
                                                        
                 </tr>

                  <?php }  ?>

        

          </table>

          <?php }  ?>

<!--------end-------------------------------------------------------------->









</div>