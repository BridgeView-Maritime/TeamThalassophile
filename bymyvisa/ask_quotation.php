<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
</head>
<style> 
 
.quotation_form {
  /* margin-top:50px; */
  font-size: 18px;
    margin-top: 5PX;
    padding-top: 10px;
    text-align: left;
    
}
.quotation_form span, .quotation_form {
  color:white;
}

.contact-form-wrap {
    text-align: center;
}

section{
  margin: 70PX 0;
}
.contact-block {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
}

.contact-block .contact-info{
    -webkit-box-flex: 0;
    -ms-flex: 0 0 300px;
    flex: 0 0 300px;
    text-align: center;
    padding: 10px;
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
}
.contact-block .contact-info .icon {
    margin-bottom: 20px;
}
.contact-block .contact-info ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
.contact-block .contact-info ul li {
    /* font-size: 1.5rem; */
    font-weight: 400;
    color: #546274;
    font-family: "Roboto", sans-serif;
}
.contact-block .contact-info:last-child {
    border-right: 0;
}
.contact-block .contact-info {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 300px;
    flex: 0 0 300px;
    text-align: center;
    padding: 10px;
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
}
.btn_blue{
  background-color: var(--blue);
}





  </style>
<body>
<?php include('includes/header.php');?>

 

  <!-- <div class="row justify-content-end  "> 
    <div class="col"></div>
    <div class="rounded col-6 md-4 p-4 bg-light quotaion_form mt-4">
      <h2 class=" fw-bold">QUOTATION</h2>
      <form class="">
        <div class=" ">
          <div class="">
            <label for="inputEmail4" class="form-label"> FULL NAME</label>
            <input type="FULL NAME" class="form-control" id="inputEmail4">
          </div>
          <div class="">
            <label for="inputPassword4" class="form-label">EMAIL ADDRESS</label>
            <input type="EMAIL ADDRESS" class="form-control" id="inputPassword4">
          </div>
          <div class="">
            <label for="inputAddress" class="form-label">PHONE NO</label>
            <input type="" class="form-control" id="inputAddress" placeholder="1234 ">
          </div>
          <div class="">
            <label for="inputAddress2" class="form-label">Address </label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
          </div>
          <br>
          <div class="">
             <button type="submit" class="btn btn-primary">submit</button>
          </div>
 
        </div>
      </form>
    </div>
  </div>
</div> -->

<section>


<div class="container ">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="contact-form-wrap centered dfw-bol fw-bold shadow-lg p-3 mb-5 bg-body rounded">
                <h2>QUOTATION FORM</h2>
                
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
                  <div class="row my-4">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="contact no">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="alternate phone no">
                      </div>
                    </div>
                  </div>

                  
                  <div class="row my-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="state">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Distict">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="city">
                      </div>
                    </div>
                  </div>
                  

                  <button class="btn btn_blue">Send </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
</section>





  <?php include('includes/footer.php');?>


</body>

</html>