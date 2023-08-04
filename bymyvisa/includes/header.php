<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>

   <style>
  :root {
  --blue-dark: #1b334a;
  --blue: #1b334a;
  --blue-light: #d9d2d2;
}
  body{
    background-color:#d9d2d2;
  }
    .pratik_item{
        
         color: white!important;
        margin-top:10px;
        float:right ;
        padding-right: 40px;


    }
    .pratik1{
    color:black; 
   
    }

    .pratik_item:hover  {
  background-color: black;
  color:white !important;
  
     }
     .nav_bg{
      background-color: #1b334a!important;
     }
     .btn_blue{
  background-color: var(--blue);
  color: white;
  border: 1px solid var(--blue);
  transition: 0.5s;
}

.btn_blue:hover{
  background-color: var(--blue-light);
  color: var(--blue-dark);
  border: 1px solid var(--blue-dark);
  transition: 0.5s;
}


    
    </style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark nav_bg">
  <div class="container-fluid">
    <a class="navbar-brand pratik1 fw-bold" href="index.php">BY MY VISA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
           

          <a class="nav-link  pratik_item " aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link  active pratik_item" href="ask_quotation.php">Ask for quotation</a>
        </li>

        <li class="nav-item">
          <a class="nav-link  pratik_item" href="apply_visa.php" >apply for visa</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link pratik_item" href="contact_us.php" >contact us</a>
        </li>
      </ul>
      
    </div>
  </div></nav>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>



</body>
</html>