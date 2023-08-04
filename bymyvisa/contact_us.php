<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
 .heroimg{
   background-image: url("image/pic4.jpg");
    background-color: #cccccc; /* Used if the image is unavailable */
    height:50vh; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
  opacity: 9.5;
 }
  .pt{
    font-size: 18px;
    margin-top: 50PX;
    padding-top: 30px;
    text-align: left;
    color: WHITESMOKE;
}
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

.contact_m{
  color: black;
}


</style>
<body>
   


    
<?php include('includes/header.php');?>
<!-- <section>


  <div class=" heroimg">

  <div class="container">




  
  <div class="row">
      <div class=col-6>
        
        <div class="quotation_form">
       
        <i class="fa-solid fa-location-dot"> </i> <h4>location<h4>
          <span>   
                B-Wing,The Great Eastern Summit, Sector-15, Plot-602, <br>CBD Belapur, 
                Navi Mumbai-400614 India.</span>            
               </div>
</div>
</div>
<div class=col-6> 
  <div class="row justify-content-end  ">
    
    <div class="rounded col-6 md-4 p-4 bg-dark quotation_form mt-4">
      <h2 class=" fw-bold">CONTACT US</h2>
      <form class="">
        <div class=" ">
          <div class="">
            <label for="inputEmail4" class="form-label"> EMAIL ID</label>
            <input type="FULL NAME" class="form-control" id="inputEmail4">
          </div>
          <div class="">
            <label for="inputPassword4" class="form-label">PASSWORD</label>
            <input type="EMAIL ADDRESS" class="form-control" id="inputPassword4">
          </div>
         
          <br>
          <div class="">
             <button type="submit" class="btn btn-primary">submit</button>
          </div>
</div>
  </div>
</div>
       
      </form>
    </div>
  </div>
</div>
</div>
</section> -->

<section>
<div class="container">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="contact-form-wrap contact_m">
                <h2>We’re Here to Help You</h2>
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
<section>
<div class="container">
          <div class="row">
            <div class="col">
              <div class="contact-block">
                <div class="contact-info">
                  <div class="icon">
                  <i class="fa-solid fa-location-dot fa-2xl" style="color: #15191d;"></i>
                                  </div>
                  <h4>Anfra HQ</h4>
                  <p>B-Wing,904,
The Great Eastern Summit, Sector-15, Plot-66, CBD Belapur,
Navi Mumbai-400614 India.</p>
                </div>
                <div class="contact-info ">
                  <div class="icon">
                  <i class="fa-solid fa-phone fa-2xl "></i>
                
                  </div>
                  <h4>Call Us </h4>
                  <ul class="text-center">
                    <li>Mobile: +91 22 27564962</li>
                    <li>Hotline:  +91 22 27564962</li>
                  </ul>
                </div>
                <div class="contact-info ">
                  <div class="icon">
                  <i class="fa-sharp fa-regular fa-envelope fa-2xl" style="color: #15191d;"></i>
                                  </div>
                  <h4>Mail Us</h4>
                  <ul class="text-center">
                    <li>Info:  admin@bridgeviewmaritime.com</li>
                
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>

<div class="visa_map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.2234728255335!2d73.03139127512257!3d19.009871882181177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c3a9837788ab%3A0x7d2a15e916eb7a01!2sBridgeview%20Maritime%20Private%20Limited!5e0!3m2!1sen!2sin!4v1684131512250!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>


  <?php include('includes/footer.php');?>



    



    
    
    
</body>
</html>