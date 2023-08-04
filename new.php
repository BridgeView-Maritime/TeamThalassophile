<?php include("includes/config.php"); 

// $db = new mysqli($servername, $username, $password, $dbname);
$query="SELECT * FROM `jobseeker_plan` ";
$result = $db->query($query);

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Bootstrap 5.0 Pricing Table</title>

  <style>
    .card {
      border:none;
      padding: 10px 50px;
    }

    .card::after {
      position: absolute;
      z-index: -1;
      opacity: 0;
      -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
      transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .card:hover {


      transform: scale(1.02, 1.02);
      -webkit-transform: scale(1.02, 1.02);
      backface-visibility: hidden; 
      will-change: transform;
      box-shadow: 0 1rem 3rem rgba(0,0,0,.75) !important;
    }

    .card:hover::after {
      opacity: 1;
    }

    .card:hover .btn-outline-primary{
      color:white;
      background:#007bff;
    }
    @media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
    }
  </style>
</head>
<body>
<?php 
include("app/gtheader.php");
?>  
           
           <div class="container-fluid" style="background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);">
    <div class="container p-5">
      <div class="row">
      <?php
     if (mysqli_num_rows($result) > 0) {
 
         while($data = mysqli_fetch_assoc($result)) {
    
           ?> 
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card h-100 shadow-lg">
            <div class="card-body">
              <div class="text-center p-3">
                  <h5 class="card-title"><?php echo $data['plan_name']; ?></h5>
                     <span class="h2"><?php echo $data['plan_price']; ?></span>/month
                <br><br>
              </div>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
               
              <?php echo $data['plan_name']; ?> </li>
              <li class="list-group-item">
               
              <?php echo $data['jobes_no']; ?> </li>
              <li class="list-group-item">
               
              Vestibulum at eros</li>
            </ul>
            <div class="card-body text-center">
            <button class="btn btn-outline-primary btn-lg"  style="border-radius:30px"><a type="submit" id="pay" class="btn" href="razorpaypayment/pay.php?plan_name=<?php echo  $data['plan_name']?>&&plan_price=<?php echo  $data['plan_price']?>&&jobes_no=<?php echo  $data['jobes_no']?>">Sign Up</a></button>
            </div>
          </div>
        </div>
        <?php
     $sn++;}} else { ?>
        </div>    
    </div>
  </body>


      
    <tr>
     <li colspan="8">No data found</li>
    </tr>
    <?php } ?>
           
    <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
  </html>


