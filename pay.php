<?php include("includes/config.php"); 
$home = 1;
require('razorpaypayment/razorpay-php/Razorpay.php');

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId,$keySecret);

$plan_name=$_GET['plan_name'];
$plan_price=$_GET['plan_price'];
$jobes_no=$_GET['jobes_no'];




$orderData = [
    'receipt'         => 3456,
    'amount'          =>  $plan_price* 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $plan_price;

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "teamthalassophile.com",
    "description"       => "Tron Legacy",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => "",
    "email"             => "customer@merchant.com",
    "contact"           => "9999999999",
    ],
    "notes"             => [
    "address"           => "",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);


?>
    <html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  
  
  <title>Bootstrap 5.0 Pricing Table</title>
 </head>
<body >
<?php 
$home = 1;
include("app/gtheader.php");
?>

<section class="vh-100" style="background-color: #0C4160;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong bg-white " style="padding:40px;">
          <div class="card-body p-5 ">
            <h3 class="mb-5 text-center p-4">Payment Details</h3>
            <div class="form-outline mb-4">
            <p class="text mb-1">Plan Name</p>
            <input class="form-control mb-3" type="" placeholder="Name" value=<?php echo $plan_name;?> readonly>
            </div>
            <div class="form-outline mb-4">
            <p class="text mb-1">Plan Price</p>
            <input class="form-control mb-3" type="" placeholder="Name" value=<?php echo $plan_price;?> readonly>
            </div>
            <div class="form-outline mb-4">
            <p class="text mb-1">Jobes No</p>
             <input class="form-control mb-3" type="" placeholder="Name" value=<?php echo $jobes_no;?> readonly>
            </div>
            <!-- Checkbox -->
            <div type="button" class="btn btn-primary" style="color:black; width:99%;">
                      <?php
                      require("razorpaypayment/checkout/{$checkout}.php");
                        ?>
                    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <?php include("app/gtfooter.php"); ?>  

  </body>
</html>
