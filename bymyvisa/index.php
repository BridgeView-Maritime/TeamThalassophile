<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
   .heroimg{
    background-image: url("image/pic1.jpg");
    background-color: #cccccc; /* Used if the image is unavailable */
  height:100vh; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
  opacity: 9.5;

   }
   .centered {
  position: absolute;
  width:35%;
  top: 40%;
  left: 50%;
  transform:translate(-50%,-50%);
  color:black;
}



.card1:hover {
      background:#00ffb6;
      border:1px solid #00ffb6;
    }

    .card1:hover .list-group-item{
      background:#00ffb6 !important
    }


    


    .card2:hover {
      background:#00C9FF;
      border:1px solid #00C9FF;
    }

    .card2:hover .list-group-item{
      background:#00C9FF !important
    }


    .card3:hover {
      background:#ff95e9;
      border:1px solid #ff95e9;
    }

    .card3:hover .list-group-item{
      background:#ff95e9 !important
    }


    .card:hover .btn-outline-dark{
      color:white;
      background:#212529;
    }




    
  </style>
  
<body>
    <?php include('includes/header.php');?>
   
    <div class="heroimg"></div>
  <!-- <img src="image/pic1.jpg" style="width:100%;"> -->
  <h1><div class="centered dfw-bol fw-bold shadow p-3 mb-5 bg-body rounded">  <marquee>WELCOME TO BUY MY VISA </marquee></div></h1>
  
   <section>




   <div class="container-fluid">
    <div class="container p-5">
      <div class="row">
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card1 h-100">
            <div class="card-body">
             
              <h5 class="card-title">Basic</h5>
              <small class='text-muted'>Individual</small>
              <br><br>
              <span class="h2">$8</span>/month
              <br><br>
              <div class="d-grid my-3">
                <button class="btn btn-outline-dark btn-block">Select</button>
              </div>
              <ul>
                <li>Cras justo odio</li>
                <li>Dapibus ac facilisis in</li>
                <li>Vestibulum at eros</li>
                
              </ul>
            </div>

            
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card2 h-100">
            <div class="card-body">
             
              <h5 class="card-title">Standard</h5>
              <small class='text-muted'>Small Business</small>
              <br><br>
              <span class="h2">$20</span>/month
              <br><br>
              <div class="d-grid my-3">
                <button class="btn btn-outline-dark btn-block">Select</button>
              </div>
              <ul>
                <li>Cras justo odio</li>
                <li>Dapibus ac facilisis in</li>
                <li>Vestibulum at eros</li>
                
              </ul>
            </div>

            
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card3 h-100">
            <div class="card-body">
             
              <h5 class="card-title">Premium</h5>
              <small class='text-muted'>Large Company</small>
              <br><br>
              <span class="h2">$40</span>/month
              <br><br>
              <div class="d-grid my-3">
                <button class="btn btn-outline-dark btn-block">Select</button>
              </div>
              <ul>
                <li>Cras justo odio</li>
                <li>Dapibus ac facilisis in</li>
                <li>Vestibulum at eros</li>
                
              </ul>
            </div>

            
          </div>
        </div>
      </div>    
    </div>
  </body>

   </section>
  <section>
  <div class="container">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
  <div class="contact-form-wrap contact_m text-center">
                <h2>CONTACT US</h2>
                <p>We always want to hear from you! Let us know how we can best help you and we'll do our very best.</p>
                <form action="#">
                  <div class="row my-4">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email address">
                      </div>
                    </div>
                  </div>
                  <div class="form-group my-2">
                    <textarea class="form-control" placeholder="Tell us a few words"></textarea>
                  </div>
                  <button class="btn btn btn-primary my-4 btn_blue">Send Your Message</button>
                </form>
              </div>
            </div>
          </div>
        </div>
  </section>
  


  
<?php include('includes/footer.php');?>

  
</body>
</html>