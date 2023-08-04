<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    </head>
<body>
    


<?php include("includes/config.php"); 
$home = 1;
include("app/gtheader.php");

    $query="SELECT * FROM jobseeker_plan"; 
    $rs = $db->query($query);

    
   
?>
<div class="container-fluid" style="background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);">
 <div class="container p-5" style="margin-top:150px; margin-bottom: 110px;">
   <div class="row">
         <h1 style="text-align:center ";>Get the complete developer platform.</h1><br>
          <h2 style="text-align:center ";>How often do you want to pay?</h2><br><br>
            </div>
      <?php 
   $rowlist = $rs->rows;
    $j=1; 

  foreach($rowlist as $key => $row) {
      ?>
    <div class="col-lg-4 col-md-12 mb-4">
             <div class="card h-100">
            <div class="card-body shadow-lg p-3 mb-5 bg-body-tertiary rounded bg-white" style="border-radius: 2rem; padding: 10px 50px; ">
               <div class="text-center p-3">
                     <h3 class="card-title"><?php echo $row['plan_name']; ?></h3>
                     <span class="h2"><?php echo $row['plan_price']; ?></span>/month
                     <br><br>
                </div>
                <P>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <ul class="list-group list-group-flush">
               <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i><?php echo $row['plan_name']; ?> </li>
                <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i><?php echo $row['jobes_no']; ?> </li>
                <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i>Vestibulum at eros</li>
              </ul>
               <div class="card-body text-center">
              <button class="btn" style="border-radius:70px;color:black;"><a type="submit" id="pay"  href="razorpaymaster/pay.php?plan_name=<?php echo  $row['plan_name']?>&&plan_price=<?php echo $row['plan_price']?>&&jobes_no=<?php echo  $row['jobes_no']?>">Sign Up</a></button>
               </div>
               </div>
              </div>
            </div>
            <?php } ?> 
          </div>
         </div>
         </div>
        </div>
      <?php include("app/gtfooter.php"); ?>  
  </body>
  </html>